<?php

namespace App\Filament\Resources\Customers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
//Exporter
use App\Filament\Exports\CustomerExporter;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\Exports\Enums\ExportFormat;
//use Filament\Tables\Actions\ExportBulkAction;
//use Filament\Tables\Actions\ExportAction;

use Filament\Tables\Columns\TextColumn;

class CustomersTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->columns([
                TextColumn::make('name')
                ->label('Cliente')
                ->searchable()
                ->sortable(),

                TextColumn::make('whatsapp')
                    ->label('WhatsApp')
                    ->searchable()
                    ->url(fn ($record) => $record->whatsapp ? "https://wa.me/52{$record->whatsapp}" : null)
                    ->openUrlInNewTab()
                    ->color('success')
                    ->icon('heroicon-m-chat-bubble-left-right')
                    ->tooltip('Dar clic para enviar WhatsApp'),

                TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable(),

                TextColumn::make('birthday')
                    ->label('Cumpleaños')
                    ->date('d \d\e F') //oculta el año
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Registrado el')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                ExportAction::make()
                ->exporter(CustomerExporter::class)
                ->label('Descargar Clientes')
                ->formats([
                    ExportFormat::Xlsx,
                    ExportFormat::Csv
                ]),
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
                    ExportBulkAction::make()
                        ->exporter(CustomerExporter::class)
                        ->label('Exportar Seleccionados')
                        ->formats([
                            ExportFormat::Xlsx,
                            ExportFormat::Csv,
                        ])
                ]),
            ]);
    }
}
