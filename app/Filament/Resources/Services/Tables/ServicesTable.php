<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Imagen')
                    ->disk('public')
                    ->circular(),

                TextColumn::make('category.name')
                    ->label('Categoria')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Servicio')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Precio')
                    ->money()
                    ->sortable(),

                TextColumn::make('duration_minutes')
                    ->label('Duración')
                    ->numeric()
                    ->suffix('minutos')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),

            ])
            ->filters([
                SelectFilter::make('category_id')
                ->label('Filtrar por Categoría')
                ->relationship('category', 'name')
                ->preload()
                ->searchable(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
