<?php

namespace App\Filament\Resources\Appointments\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AppointmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detalles de la Cita')
                    ->description('Información completa del cliente, el servicio y el estado de la sesión.')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)
                            ->schema([

                                // 1. Cliente (Relación)
                                TextEntry::make('customer.name')
                                    ->label('Cliente'),

                                // 2. Servicio (Relación)
                                TextEntry::make('service.name')
                                    ->label('Servicio Realizado'),

                                // 3. Fecha y Hora formateada de forma premium
                                TextEntry::make('appointment_date')
                                    ->label('Fecha y Hora')
                                    ->dateTime('d/m/Y g:i A'),

                                // 4. Origen de la cita (con los mismos colores del Badge que la tabla)
                                TextEntry::make('origin')
                                    ->label('Origen')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'web' => 'success',
                                        'direct' => 'info',
                                        default => 'gray',
                                    })
                                    ->formatStateUsing(fn (string $state): string => match ($state) {
                                        'web' => 'Web',
                                        'direct' => 'Directa',
                                        default => $state,
                                    }),

                                // 5. Estatus de la Cita (con tus colores aprobados)
                                TextEntry::make('status')
                                    ->label('Estatus')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'pending' => 'warning',
                                        'confirmed' => 'success',
                                        'completed' => 'info',
                                        'cancelled' => 'danger',
                                        'no-show' => 'gray',
                                        default => 'warning',
                                    })
                                    ->formatStateUsing(fn (string $state): string => match ($state) {
                                        'pending' => 'Programada',
                                        'confirmed' => 'Confirmada',
                                        'completed' => 'Completada',
                                        'cancelled' => 'Cancelada',
                                        'no-show' => 'No llegó',
                                        default => $state,
                                    }),
                            ]),

                        // Notas específicas de la cita abajo ocupando todo el ancho
                        TextEntry::make('notes')
                            ->label('Notas específicas para esta cita')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
