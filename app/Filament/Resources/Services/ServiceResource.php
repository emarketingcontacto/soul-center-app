<?php

namespace App\Filament\Resources\Services;

use App\Filament\Resources\Services\Pages\CreateService;
use App\Filament\Resources\Services\Pages\EditService;
use App\Filament\Resources\Services\Pages\ListServices;
use App\Filament\Resources\Services\Tables\ServicesTable;
use App\Models\Service;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
//inputs
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Str;
use Filament\Forms\Components\RichEditor;
//images
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
// Repeater
use Filament\Forms\Components\Repeater;
use UnitEnum;
//use Filament\Forms\Components\Hidden;
//use App\Filament\Resources\Services\Schemas\ServiceForm;
//use Filament\Forms\Components\Tabs;
//use Filament\Schemas\Components\Section;

class ServiceResource extends Resource
{
    protected static string|UnitEnum|null $navigationGroup = 'Configuración';
    protected static ?string $model = Service::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Sparkles;
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $form): Schema
    {
        return $form
            ->components([
                Tabs::make('Servicio')
                    ->tabs([

                        // PESTAÑA 1: CONTENIDO PRINCIPAL
                        Tabs\Tab::make('Detalles del Servicio')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nombre del Servicio')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($set, ?string $state) => $set('slug', Str::slug($state))),

                                TextInput::make('slug')
                                    ->label('URL Amigable (Slug)')
                                    ->unique(ignoreRecord: true)
                                    ->disabled()
                                    ->dehydrated(),

                                RichEditor::make('description')
                                    ->label('Descripción Completa (Para la Web)')
                                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList', 'undo', 'redo'])
                                    ->required(),

                                RichEditor::make('benefits')
                                    ->label('Beneficios del Servicio')
                                    ->placeholder('Ej: • Reduce el estrés • Mejora la piel...')
                                    ->toolbarButtons(['bulletList', 'bold']),

                                Repeater::make('faqs')
                                    ->relationship('faqs')
                                    ->label('Preguntas Frecuentes del Servicio')
                                    ->itemLabel(fn (array $state): ?string => $state['question'] ?? 'Nueva Pregunta')
                                    ->collapsible()
                                    ->cloneable()
                                    ->defaultItems(0)

                                    // 🌟 LA MANERA NATIVA: Filament v4 se encarga de todo de forma automática
                                    ->reorderable('sort_order')
                                    ->orderColumn('sort_order') // Esto fuerza a Filament a renderizarlas siempre en el orden correcto

                                    ->schema([
                                        // En lugar de un input deshabilitado que bloquea el envío de datos,
                                        // usamos Hidden para que viaje en el payload de forma transparente.
                                        \Filament\Forms\Components\Hidden::make('sort_order'),

                                        TextInput::make('question')
                                            ->label('Pregunta')
                                            ->placeholder('Ej: ¿Qué incluye este tratamiento?')
                                            ->required()
                                            ->columnSpanFull(),

                                        Textarea::make('answer')
                                            ->label('Respuesta')
                                            ->placeholder('Escribe la respuesta clara y detallada para la clienta...')
                                            ->required()
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ])
                                    ->addActionLabel('➕ Añadir Pregunta Frecuente')


                            ]),

                        // PESTAÑA 2: CONFIGURACIÓN Y MEDIA
                        Tabs\Tab::make('Configuración y Foto')
                            ->icon('heroicon-o-camera')
                            ->schema([
                                // Aquí podemos meter un Grid pequeño para que estos campos no se vean tan largos
                                Grid::make(2)->schema([
                                    Select::make('category_id')
                                        ->relationship('category', 'name')
                                        ->label('Categoría')
                                        ->preload()
                                        ->required(),

                                    TextInput::make('price')
                                        ->label('Precio (MXN)')
                                        ->numeric()
                                        ->prefix('$')
                                        ->required(),

                                    TextInput::make('duration_minutes')
                                        ->label('Duración')
                                        ->numeric()
                                        ->suffix(' min')
                                        ->required(),

                                    Toggle::make('is_active')
                                        ->label('¿Servicio Activo?')
                                        ->default(true),

                                     Select::make('users')
                                        ->relationship('users', 'name') // Vincula directamente con la relación belongsToMany
                                        ->multiple() // Permite seleccionar varias terapeutas
                                        ->preload() // Precarga la lista para que sea rápido buscar
                                        ->searchable() // Añade un buscador interno
                                        ->label('Terapeutas Capacitadas')
                                        ->placeholder('Selecciona al personal que puede dar este servicio...'),
                                ]),

                                FileUpload::make('image')
                                    ->label('Imagen Principal')
                                    ->image()
                                    ->disk('public')
                                    ->dehydrateStateUsing(function ($state) {
                                        return $state;
                                    })

                                    ->saveUploadedFileUsing(function ($file) {
                                        $manager = new ImageManager(new Driver());
                                        $image = $manager->read($file);
                                        $encoded = $image->cover(800, 600)->toWebp(80);
                                        $filename = Str::uuid() . '.webp';
                                        $fullPath = 'services/' . $filename;

                                        Storage::disk('public')->put($fullPath, (string) $encoded);
                                        return $fullPath;
                                    })
                                    ->columnSpanFull(),

                            ]),

                        // PESTAÑA 3: ESTRATEGIA SEO
                        Tabs\Tab::make('Marketing (SEO)')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                Textarea::make('seo_description')
                                    ->label('Meta Descripción para Google')
                                    ->rows(3)
                                    ->maxLength(160)
                                    ->live()
                                    ->helperText(fn ($state) => 'Caracteres: ' . strlen($state) . ' / 160')
                                    ->placeholder('Escribe un resumen atractivo para los resultados de búsqueda...'),
                            ]),
                    ])
                    ->columnSpanFull(), // Asegura que las pestañas usen todo el ancho disponible
            ]);
    }





    public static function table(Table $table): Table
    {
        return ServicesTable::configure($table);
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
            'index' => ListServices::route('/'),
            'create' => CreateService::route('/create'),
            'edit' => EditService::route('/{record}/edit'),
        ];
    }
}
