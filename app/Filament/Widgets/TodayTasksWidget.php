<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Widgets\TableWidget as BaseWidget;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class TodayTasksWidget extends BaseWidget
{
    // Título
    protected static ?string $heading = 'Centro de Operaciones: Tareas y Confirmaciones del Día';
    // Hace que ocupe todo el ancho de la pantalla abajo del calendario
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Appointment::query()
                    ->where(function (Builder $query) {
                        // Grupo 1: TODAS las programadas (pending) sin importar la fecha
                        $query->where('status', 'pending')

                        // Grupo 2: Las confirmadas que cumplen con los días exactos (Solo 3 o 1 día antes 🌟)
                        ->orWhere(function (Builder $subQuery) {
                            $subQuery->where('status', 'confirmed')
                                ->where(function (Builder $dateQuery) {
                                    $dateQuery->whereDate('appointment_date', Carbon::today()->addDays(3))
                                        ->orWhereDate('appointment_date', Carbon::today()->addDays(1));
                                });
                        });
                    })
                    ->orderBy('appointment_date', 'asc')
            )
            ->columns([
                TextColumn::make('appointment_date')
                    ->label('Fecha y Hora de la Cita')
                    ->dateTime('d/m/Y g:i A')
                    ->sortable(),

                TextColumn::make('customer.name')
                    ->label('Cliente')
                    ->searchable(),

                TextColumn::make('service.name')
                    ->label('Servicio'),

                // Columna dinámica limpia para las tareas requeridas de 3 y 1 día
                TextColumn::make('tarea_tipo')
                    ->label('Acción Requerida')
                    ->badge()
                    ->state(function (Appointment $record): string {
                        if ($record->status === 'pending') {
                            return 'Por Confirmar';
                        }

                        // Si está confirmada, calculamos a cuántos días está
                        $diasRestantes = Carbon::today()->diffInDays($record->appointment_date->startOfDay(), false);

                        return match ($diasRestantes) {
                            3 => 'Recordatorio 3 días',
                            1 => 'Recordatorio 1 día',
                            default => 'Recordatorio',
                        };
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'Por Confirmar' => 'warning',
                        'Recordatorio 3 días' => 'primary',
                        'Recordatorio 1 día' => 'danger', // Rojo porque ya urge mandar
                        default => 'gray',
                    }),
            ])
            ->recordActions([
                // BOTÓN 1: ENVIAR MENSAJE DE CONFIRMACIÓN (Estatus: Programada)
                Action::make('enviar_confirmacion')
                    ->label('Confirmar por WA')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('warning')
                    ->visible(fn (Appointment $record) => $record->status === 'pending')
                    ->action(function (Appointment $record) {
                        // Cambia a confirmada inmediatamente al darle clic
                        $record->update(['status' => 'confirmed']);
                    })
                    ->url(function (Appointment $record) {
                        $fechaHora = $record->appointment_date->format('d/m/Y a las g:i A');
                        $mensaje = urlencode("Hola *{$record->customer->name}*! Tenemos una cita para ti el día *{$fechaHora}* para tu servicio de *{$record->service->name}* y queremos confirmar tu asistencia. ¡Saludos! ✨");

                        return "https://wa.me/{$record->customer->phone}?text={$mensaje}";
                    })
                    ->openUrlInNewTab(),

                // BOTÓN 2: ENVIAR RECORDATORIOS (Estatus: Confirmada a 3 o 1 día)
                Action::make('enviar_recordatorio')
                    ->label('Mandar Recordatorio')
                    ->icon('heroicon-o-bell')
                    ->color('success')
                    ->visible(fn (Appointment $record) => $record->status === 'confirmed')
                    ->url(function (Appointment $record) {
                        $fechaHora = $record->appointment_date->format('d/m/Y a las g:i A');
                        $mensaje = urlencode("Hola *{$record->customer->name}*! Solo para recordarte que tenemos una cita para *{$fechaHora}* para tu servicio de *{$record->service->name}*. ¡Te esperamos! 🌸");

                        return "https://wa.me/{$record->customer->phone}?text={$mensaje}";
                    })
                    ->openUrlInNewTab(),

                // BOTÓN 3: EL SALVAVIDAS QUE PROPUSISTE (Siempre visible)
                Action::make('editar_cita')
                    ->label('Editar Cita')
                    ->icon('heroicon-o-pencil-square')
                    ->color('gray')
                    ->url(fn (Appointment $record) => route('filament.admin.resources.appointments.edit', ['record' => $record->id])),
            ]);
    }
}
