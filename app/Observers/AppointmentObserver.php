<?php

namespace App\Observers;

use App\Models\Appointment;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;


class AppointmentObserver
{
    protected string $timezone;

    public function __construct()
    {
        try{
            $this->timezone = config('app.timezone', 'America/Mexico_City');
        }
        catch(\Exception $e){
              logger()->error('Error al inicializar Timezone en el Observer: ' . $e->getMessage());
              // Asignamos datos de respaldo
              $this->timezone = 'America/Mexico_City';
        }
    }


    public function created(Appointment $appointment): void
    {
        try {
            //Entrada del observer
            $appointment->loadMissing(['customer', 'service', 'employee']);

            $event = new Event;
            $event->name = $this->buildEventName($appointment);

            // Calcular tiempos dinámicos
            $startTime =Carbon::parse($appointment->appointment_date,$this->timezone);
            $endTime = clone $startTime;
            $durationMinutes = $appointment->service ? $appointment->service->duration_minutes : 60;
            $endTime->addMinutes($durationMinutes);

            $event->startDateTime = $startTime;
            $event->endDateTime = $endTime;

            // Descripción idéntica a tu versión con todos los datos clave
            $event->description = $this->buildDescription($appointment, $durationMinutes);

            // Asignar el color de Google según el estatus real de Filament
            $event->colorId = $this->getGoogleColorId($appointment->status);

            // Guardamos el evento en la API de Google
            $newEvent = $event->save();

            // Súper importante: Guardamos el ID retornado en la base de datos de Laragon silenciosamente
            $appointment->timestamps = false;
            $appointment->updateQuietly(['google_event_id' => $newEvent->id]);

        } catch (\Exception $e) {
            logger()->error('Error al crear cita en Google Calendar: ' . $e->getMessage());
        }
    }

    /**
     * Al ACTUALIZAR la cita (Cambios de hora, fecha, personal o estatus)
     */
    public function updated(Appointment $appointment): void
    {
        if (!$appointment->google_event_id) {
            return;
        }

        try {
            $appointment->loadMissing(['customer', 'service', 'employee']);

            // Buscamos el bloque existente en el Google Calendar de Karina
            $event = Event::find($appointment->google_event_id);

            if ($event) {
                $event->name = $this->buildEventName($appointment);

                // Recalcular tiempos por si se movió en el calendario de Filament
                $startTime = Carbon::parse($appointment->appointment_date, $this->timezone);
                $endTime = clone $startTime;
                $durationMinutes = $appointment->service ? $appointment->service->duration_minutes : 60;
                $endTime->addMinutes($durationMinutes);

                $event->startDateTime = $startTime;
                $event->endDateTime = $endTime;

                // Actualizar la descripción completa
                $event->description = $this->buildDescription($appointment, $durationMinutes);

                // CAMBIO DE COLOR EN TIEMPO REAL SEGÚN EL STATUS ACTUALIZADO
                $event->colorId = $this->getGoogleColorId($appointment->status);

                // Sincronizar los cambios
                $event->save();
            }
        } catch (\Exception $e) {
            logger()->error('Error al actualizar cita en Google Calendar: ' . $e->getMessage());
        }
    }

    /**
     * Al ELIMINAR la cita de Filament
     */
    public function deleted(Appointment $appointment): void
    {
        if (!$appointment->google_event_id) {
            return;
        }

        try {
            $event = Event::find($appointment->google_event_id);
            if ($event) {
                $event->delete();
            }
        } catch (\Exception $e) {
            logger()->error('Error al eliminar cita en Google Calendar: ' . $e->getMessage());
        }
    }

    /**
     * Helper: Construir título del evento
     */
    private function buildEventName(Appointment $appointment): string
    {
        $customerName = $appointment->customer ? $appointment->customer->name : 'Cliente';
        $serviceName = $appointment->service ? $appointment->service->name : 'Servicio Spa';
        return "Cita: {$customerName} - {$serviceName}";
    }

    /**
     * Helper: Construir la descripción detallada idéntica a tu versión
     */
    private function buildDescription(Appointment $appointment, int $durationMinutes): string
    {
        $customerName = $appointment->customer ? $appointment->customer->name : 'Cliente';
        $serviceName = $appointment->service ? $appointment->service->name : 'Servicio Spa';
        $employeeName = $appointment->employee ? $appointment->employee->name : 'No asignado';

        $description = "📋 **Detalles de la Cita Soul Center**\n\n";
        $description .= "👤 **Cliente:** {$customerName}\n";
        $description .= "💆 **Servicio:** {$serviceName} (⏱️ {$durationMinutes} min)\n";
        $description .= "👩‍⚕️ **Atiende:** {$employeeName}\n";
        $description .= "🚦 **Estatus Interno:** " . strtoupper($appointment->status) . "\n";
        $description .= "💰 **Monto:** \${$appointment->amount_paid} ({$appointment->payment_status})\n";
        $description .= "🌐 **Origen:** {$appointment->origin}\n";

        if (!empty($appointment->notes)) {
            $description .= "\n📝 **Notas:** {$appointment->notes}";
        }

        return $description;
    }

    /**
     * Helper: Mapear el estatus de Filament con la paleta de ID de Google
     */
    private function getGoogleColorId(string $status): string
    {
        return match ($status) {
            'pending'   => '5',  // Amarillo (Banana) 🟡
            'confirmed' => '10', // Verde Oscuro (Basil) 🟢
            'completed' => '7',  // Azul Turquesa (Peacock) 🔵
            'cancelled' => '11', // Rojo (Tomato) 🔴
            'no-show'   => '8',  // Gris (Graphite) ⚫
            default     => '5',  // Respaldo en amarillo
        };
    }
}
