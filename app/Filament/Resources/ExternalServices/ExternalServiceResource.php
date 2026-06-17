<?php

namespace App\Filament\Resources\ExternalServices;

use App\Filament\Resources\ExternalServices\Pages\CreateExternalService;
use App\Filament\Resources\ExternalServices\Pages\EditExternalService;
use App\Filament\Resources\ExternalServices\Pages\ListExternalServices;
//use App\Filament\Resources\ExternalServices\Schemas\ExternalServiceForm;
use App\Filament\Resources\ExternalServices\Tables\ExternalServicesTable;
use App\Models\ExternalService;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
// Components
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Grid;
// Componentes de formulario
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Str;
use Filament\Forms\Components\Toggle;

// Images
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;


class ExternalServiceResource extends Resource
{
    protected static ?string $model = ExternalService::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::SquaresPlus;
    protected static ?string $recordTitleAttribute = 'title';
    protected static string|UnitEnum|null $navigationGroup = 'Configuración';

    public static function form(Schema $schema): Schema
    {
       return $schema
            ->components([
                Tabs::make('Servicio Externo')
                    ->tabs([

                        // PESTAÑA 1: DETALLES Y CONTACTO
                        Tabs\Tab::make('Detalles del Colaborador')
                            ->icon('heroicon-o-information-circle')
                            ->schema([


                                Toggle::make('is_active')
                                    ->label('Servicio Activo')
                                    ->helperText('Si se desactiva, se ocultará de la barra de navegación y de la web.')
                                    ->default(true)
                                    ->required(),

                                Grid::make(2)->schema([
                                    TextInput::make('title')
                                        ->label('Título del Servicio')
                                        ->placeholder('Ej: Nutrición Integral y Control de Peso')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn ($set, ?string $state) => $set('slug', Str::slug($state))),

                                    TextInput::make('slug')
                                        ->label('URL Amigable (Slug)')
                                        ->unique(ignoreRecord: true)
                                        ->disabled()
                                        ->dehydrated()
                                        ->required(),
                                ]),

                                Grid::make(2)->schema([
                                    TextInput::make('contacto')
                                        ->label('Nombre del Especialista')
                                        ->placeholder('Ej: Nutrióloga Mariana de la Rosa')
                                        ->required(),

                                    TextInput::make('whatsapp')
                                        ->label('WhatsApp (10 dígitos)')
                                        ->placeholder('Ej: 4771234567')
                                        ->required()
                                        ->tel()
                                        ->maxLength(10)
                                        ->helperText('Sin espacios ni guiones. Se usará el prefijo 52 en el enlace.'),
                                ]),

                                RichEditor::make('description')
                                    ->label('Descripción Completa (Para la Web)')
                                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList', 'undo', 'redo'])
                                    ->required(),

                                RichEditor::make('benefits')
                                    ->label('Beneficios del Servicio')
                                    ->placeholder('Ej: • Reduce el estrés • Mejora la piel...')
                                    ->toolbarButtons(['bulletList', 'bold'])
                                    ->required(),


                                // REPEATER ANIDADO DE FAQS PARA EL EXTERNO
                                Repeater::make('faqs')
                                    ->relationship('faqs')
                                    ->label('Preguntas Frecuentes del Servicio Externo')
                                    ->itemLabel(fn (array $state): ?string => $state['question'] ?? 'Nueva Pregunta')
                                    ->collapsible()
                                    ->cloneable()
                                    ->defaultItems(0)
                                    ->reorderable('sort_order')
                                    ->orderColumn('sort_order')
                                    ->schema([
                                        Hidden::make('sort_order'),

                                        TextInput::make('question')
                                            ->label('Pregunta')
                                            ->placeholder('Ej: ¿Qué incluye la consulta?')
                                            ->required()
                                            ->columnSpanFull(),

                                        Textarea::make('answer')
                                            ->label('Respuesta')
                                            ->placeholder('Escribe la respuesta clara...')
                                            ->required()
                                            ->rows(2)
                                            ->columnSpanFull(),
                                    ])
                                    ->addActionLabel('➕ Añadir Pregunta Frecuente')
                            ]),

                        // PESTAÑA 2: FOTO PRINCIPAL
                        Tabs\Tab::make('Imagen del Servicio')
                            ->icon('heroicon-o-camera')
                            ->schema([
                                FileUpload::make('image')
                                ->label('Imagen Principal')
                                ->image()
                                ->disk('public')
                                ->dehydrateStateUsing(function ($state) {
                                    return $state;
                                })
                                ->saveUploadedFileUsing(function ($file) {
                                    // Usamos Intervention Image v3 para procesar y optimizar la imagen
                                    $manager = new ImageManager(new Driver());
                                    $image = $manager->read($file);
                                    // Recortamos a formato cover 800x600 y convertimos a WebP con 80% de calidad
                                    $encoded = $image->cover(800, 600)->toWebp(80);
                                    // Generamos un nombre único con UUID para evitar colisiones
                                    $filename = Str::uuid() . '.webp';
                                    // Lo guardamos en su propia carpeta independiente
                                    $fullPath = 'external-services/' . $filename;
                                    // Guardamos en el disco público
                                    Storage::disk('public')->put($fullPath, (string) $encoded);

                                    return $fullPath;
    })
    ->columnSpanFull(),
                            ]),

                        // PESTAÑA 3: ESTRATEGIA MARKETING SEO
                        Tabs\Tab::make('Marketing (SEO)')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                TextInput::make('seo_title')
                                    ->label('Meta Título para Google')
                                    ->placeholder('El título ideal que aparecerá en los buscadores')
                                    ->maxLength(60),

                                Textarea::make('seo_description')
                                    ->label('Meta Descripción para Google')
                                    ->rows(3)
                                    ->maxLength(160)
                                    ->live()
                                    ->helperText(fn ($state) => 'Caracteres: ' . strlen($state) . ' / 160')
                                    ->placeholder('Escribe un resumen atractivo para los resultados de búsqueda...'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return ExternalServicesTable::configure($table);
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
            'index' => ListExternalServices::route('/'),
            'create' => CreateExternalService::route('/create'),
            'edit' => EditExternalService::route('/{record}/edit'),
        ];
    }
}
