<?php

namespace App\Filament\Resources\Appointments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;




class AppointmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Nombre del cliente traído a través de la relación
            TextColumn::make('customer.name')
                ->label('Cliente')
                ->searchable()
                ->sortable(),

            // 2. Selector de Servicio Inteligente
            TextColumn::make('service.name')
                ->label('Servicio')
                ->searchable()
                ->sortable(),


            // Fecha y hora formateada de forma muy legible
            TextColumn::make('appointment_date')
                ->label('Fecha y Hora')
                ->dateTime('d/m/Y g:i A')
                ->sortable(),

            //Atendido por:
            TextColumn::make('employee.name')
                ->label('Atiende')
                ->searchable()
                ->sortable()
                ->placeholder('Sin asignar'),

            // Estatus formateado como Badge de color animado
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
                })
                ->sortable(),

            TextColumn::make('origin')
                ->label('Origen')
                ->sortable()
                ->color(fn (string $state): string => match ($state){
                    'web' => 'success',
                    'direct' => 'info',
                    default => 'gray',
                })
                ->formatStateUsing(fn(string $state): string => match ($state){
                    'web' => 'Web',
                    'direct' => 'Directa'
                }),

                // Cita registrada por
                TextColumn::make('creator.name')
                    ->label('Registró')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('Sin asignar'),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
