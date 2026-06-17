<?php

namespace App\Filament\Resources\BusinessSettings;

use App\Filament\Resources\BusinessSettings\Pages\CreateBusinessSetting;
use App\Filament\Resources\BusinessSettings\Pages\EditBusinessSetting;
use App\Filament\Resources\BusinessSettings\Pages\ListBusinessSettings;
use App\Models\BusinessSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\KeyValue;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use UnitEnum;
//use Filament\Actions\Action;
//use App\Filament\Resources\BusinessSettings\Schemas\BusinessSettingForm;
//use App\Filament\Resources\BusinessSettings\Tables\BusinessSettingsTable;
class BusinessSettingResource extends Resource
{
    protected static string|UnitEnum|null $navigationGroup = 'Configuración';
    protected static ?string $model = BusinessSetting::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog8Tooth;
    protected static ?string $recordTitleAttribute = 'name';


    public static function form(Schema $schema): Schema
    {
        return $schema
        ->components([
            Section::make('Datos Generales del NAP')
                    ->description('Información básica esencial para el SEO Local en León.')
                     ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre del Negocio')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('address')
                            ->label('Dirección Física')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('Teléfono de Contacto')
                            ->tel()
                            ->required()
                            ->maxLength(10)
                            ->helperText('Sin espacios ni guiones.'),
                        TextInput::make('whatsapp')
                            ->label('WhatsApp (Solo 10 números)')
                            ->required()
                            ->maxLength(10)
                            ->helperText('Sin espacios ni guiones. Se usará el prefijo 52 en el enlace.'),

                        Textarea::make('google_maps_url')
                            ->label('URL de Google Maps (Ficha de Negocio)')
                            ->rows(2)
                            ->columnSpanFull(),

                        // 🌟 Tu genialidad hecha componente: Estructura Clave - Valor para las redes sociales
                        KeyValue::make('social_media')
                            ->label('Redes Sociales Activas')
                            ->keyLabel('Red Social (ej: facebook, instagram, x)')
                            ->valueLabel('Enlace de la página (URL completa)')
                            ->addButtonLabel('Añadir Red Social')
                            ->columnSpanFull(),
                    ]),
        ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Negocio'),
                TextColumn::make('phone')->label('Teléfono'),
                TextColumn::make('updated_at')->label('Última Actualización')->dateTime(),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBusinessSettings::route('/'),
            'create' => CreateBusinessSetting::route('/create'),
            'edit' => EditBusinessSetting::route('/{record}/edit'),
        ];
    }
}
