<?php

namespace App\Filament\Resources\ExternalServices\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ExternalServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('contacto')
                    ->required(),
                TextInput::make('whatsapp')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('title')
                    ->required(),
                FileUpload::make('image')
                    ->image(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('benefits')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('seo_title'),
                Textarea::make('seo_description')
                    ->columnSpanFull(),
            ]);
    }
}
