<?php

namespace App\Filament\Resources\Customers\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\Appointments\AppointmentResource;
//use Filament\Actions\CreateAction;
use Filament\Tables\Table;

class AppointmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'appointments';

    protected static ?string $relatedResource = AppointmentResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('appointment_date')
            ->columns([
                TextColumn::make('service.name')
                    ->label('Servicio')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('appointment_date')
                    ->label('Fecha y Hora')
                    ->dateTime('d/m/Y g:i A')
                    ->sortable(),

                // Tus colores y estatus premium homologados
                TextColumn::make('status')
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

                TextColumn::make('origin')
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
            ])
            ->filters([
                // Filtros del historial en el futuro
            ]);
    }
}
