<?php

namespace App\Filament\Resources\Categories;

use App\Filament\Resources\Categories\Pages\CreateCategory;
use App\Filament\Resources\Categories\Pages\EditCategory;
use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Filament\Resources\Categories\Tables\CategoriesTable;
use App\Models\Category;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Str;
use UnitEnum;
//use Filament\Schemas\Support\Set;
//use App\Filament\Resources\Categories\Schemas\CategoryForm;
//use Filament\Schemas\Components\Toggle;


class CategoryResource extends Resource
{
    protected static string|UnitEnum|null $navigationGroup = 'Configuración';
    protected static ?string $model = Category::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::PuzzlePiece;
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $form): Schema
    {
        return $form
            ->components([
                TextInput::make('name')
                    ->label('Nombre de la Categoría')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($set, ?string $state) {
                $set('slug', Str::slug($state));
            }),

                TextInput::make('slug')
                    ->label('URL Amigable (Slug)')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true) // Evita que se repitan slugs en la BD
                    ->disabled() // Lo dejamos deshabilitado para que no lo arruinen sin querer
                    ->dehydrated(), // Asegura que se guarde en la BD a pesar de estar deshabilitado

                    Toggle::make('is_active')
                    ->label('¿Categoría Activa?')
                    ->helperText('Determina si esta categoría y sus servicios serán visibles en el sitio web')
                    ->default(true)
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->label('Descripción para SEO')
                    ->rows(3)
                    ->maxLength(160)
                    ->live(onBlur:false)
                    ->helperText(fn($state) => 'Caracteres: ' . strlen($state) . ' /160 (Descripción SEO)')
                    ->placeholder('Descripción SEO entre 140 y 160 caracteres')
                    ->columnSpanFull(),
        ]);
    }


    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
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
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
