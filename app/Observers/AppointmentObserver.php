<?php

namespace App\Observers;

use App\Models\Appointment;
use Carbon\Carbon;
//use Illuminate\Support\Facades\Log;
use Spatie\GoogleCalendar\Event;

class AppointmentObserver
{
    /**
     * Handle the Appointment "created" event.
     */
    public function created(Appointment $appointment): void
    {
        //Entrada del observer
        logger('¡ENTRANDO AL OBSERVER DE CITAS!');
        // Cargamos las relaciones necesarias
        $appointment->loadMissing(['customer', 'service', 'employee']);

        $event = new Event;

        // Título dinámico
        $customerName = $appointment->customer ? $appointment->customer->name : 'Cliente';
        $serviceName = $appointment->service ? $appointment->service->name : 'Servicio Spa';
        $event->name = "Cita: {$customerName} - {$serviceName}";

        // Tiempos de inicio y fin
        $startTime = $appointment->appointment_date;
        $endTime = clone $startTime;
        $durationMinutes = $appointment->service ? $appointment->service->duration_minutes : 60;
        $endTime->addMinutes($durationMinutes);

        $event->startDateTime = $startTime;
        $event->endDateTime = $endTime;

        // Descripción
        $employeeName = $appointment->employee ? $appointment->employee->name : 'No asignado';
        $description = "📋 **Detalles de la Cita Soul Center**\n\n";
        $description .= "👤 **Cliente:** {$customerName}\n";
        $description .= "💆 **Servicio:** {$serviceName} (⏱️ {$durationMinutes} min)\n";
        $description .= "👩‍⚕️ **Atiende:** {$employeeName}\n";
        $description .= "💰 **Monto:** \${$appointment->amount_paid} ({$appointment->payment_status})\n";
        $description .= "🌐 **Origen:** {$appointment->origin}\n";

        if (!empty($appointment->notes)) {
            $description .= "\n📝 **Notas:** {$appointment->notes}";
        }

        $event->description = $description;

        // Forzar el guardado (Si esto falla, Laravel va a tronar y nos dirá por qué)
        $event->save();
    }

    /**
     * Handle the Appointment "updated" event.
     */
    public function updated(Appointment $appointment): void
    {
        //
    }

    /**
     * Handle the Appointment "deleted" event.
     */
    public function deleted(Appointment $appointment): void
    {
        //
    }

    /**
     * Handle the Appointment "restored" event.
     */
    public function restored(Appointment $appointment): void
    {
        //
    }

    /**
     * Handle the Appointment "force deleted" event.
     */
    public function forceDeleted(Appointment $appointment): void
    {
        //
    }
}
