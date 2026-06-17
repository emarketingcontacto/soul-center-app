<?php

namespace App\Filament\Widgets;

//use Filament\Widgets\Widget;
use App\Models\Appointment;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
//use Illuminate\Contracts\Support\Htmlable;

class CalendarWidget extends FullCalendarWidget
{
    protected static ?int $sort = 2;
    protected static bool $isCard = true;

    public function getHeading(): string
    {
        return 'Citas del Mes';
    }

    public function config(): array
    {
        return [
            'headerToolbar' => [
                'start' => 'prev,next today',
                'center' => 'title', // Esto muestra la fecha del mes dinámico (ej: "junio de 2026")
                'end' => 'dayGridMonth,timeGridWeek,timeGridDay'
            ],
            'initialView' => 'dayGridMonth',
        ];
    }

    public function fetchEvents(array $fetchInfo): array
    {
        return Appointment::query()
            ->where('appointment_date', '>=', $fetchInfo['start'])
            ->where('appointment_date', '<=', $fetchInfo['end'])
            ->with(['customer', 'service']) // Eager loading para cuidar el rendimiento
            ->get()
            ->map(function (Appointment $appointment) {

                // Colores premium según el estatus de la cita
                $color = match ($appointment->status) {
                    'pending' => '#eab308',   // Amarillo (warning)
                    'confirmed' => '#22c55e', // Verde (success)
                    'completed' => '#06b6d4', // Cian (info)
                    'cancelled' => '#ef4444', // Rojo (danger)
                    'no-show' => '#71717a',   // Gris (gray)
                    default => '#eab308',
                };

                return [
                    'id' => $appointment->id,
                    // Estructura visual del bloque: Cliente - Masaje/Facial
                    'title' => "{$appointment->customer->name} - {$appointment->service->name}",
                    // Convertimos la fecha de Carbon a formato ISO estándar para FullCalendar
                    'start' => $appointment->appointment_date->toIso8601String(),
                    // Estimamos 1 hora de duración para la demo visual
                    'end' => $appointment->appointment_date->addHours(1)->toIso8601String(),
                    'backgroundColor' => $color,
                    'borderColor' => $color,
                    'textColor' => '#ffffff',
                    // Al dar clic te manda directo a la vista de la cita que unificamos ayer
                    //'url' => route('filament.admin.resources.appointments.view', ['record' => $appointment->id]),
                    'url' => route('filament.admin.resources.appointments.edit', ['record' => $appointment->id]),
                ];
            })
            ->toArray();
    }

    //protected string $view = 'filament.widgets.calendar-widget';
}
