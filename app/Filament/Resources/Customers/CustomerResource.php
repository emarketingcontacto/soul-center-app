<?php

namespace App\Filament\Resources\Customers;

use App\Filament\Resources\Customers\Pages\CreateCustomer;
use App\Filament\Resources\Customers\Pages\EditCustomer;
use App\Filament\Resources\Customers\Pages\ListCustomers;
use App\Filament\Resources\Customers\Pages\ViewCustomer;
use App\Filament\Resources\Customers\Schemas\CustomerInfolist;
use App\Filament\Resources\Customers\Tables\CustomersTable;
use App\Models\Customer;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Resources\Customers\RelationManagers\AppointmentsRelationManager;
use UnitEnum;

class CustomerResource extends Resource
{
    protected static string|UnitEnum|null $navigationGroup = 'Control Operativo';
    protected static ?string $model = Customer::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;
    protected static ?string $recordTitleAttribute = 'name';



    public static function form(Schema $schema): Schema
    {
        return $schema
        ->components([
            Tabs::make('Cliente')
                ->tabs([

                    // PESTAÑA 1: DATOS DE CONTACTO
                    Tabs\Tab::make('Información Personal')
                        ->icon('heroicon-o-user')
                        ->schema([
                            Grid::make(2)->schema([
                                TextInput::make('name')
                                    ->label('Nombre del Cliente')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Ej: María Carmen López'),

                                TextInput::make('whatsapp')
                                    ->label('WhatsApp')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->tel()
                                    ->prefix('+52')
                                    ->minLength(10) // Evita que guarde números incompletos
                                    ->maxLength(10) // Evita que se pase de 10 dígitos
                                    ->placeholder('4771234567'),

                                TextInput::make('email')
                                    ->label('E-mail')
                                    ->email()
                                    ->maxLength(255),

                                DatePicker::make('birthday')
                                    ->label('Fecha de Cumpleaños')
                                    ->native(false)
                                    ->displayFormat('d/m/Y')
                                    ->placeholder('Selecciona la fecha'),
                            ]),
                        ]),

                    // PESTAÑA 2: NOTAS INTERNAS
                    Tabs\Tab::make('Notas Internas')
                        ->icon('heroicon-o-clipboard-document-list')

                        ->schema([
                            Textarea::make('internal_notes')
                                ->label('Notas Internas:')
                                ->rows(4)
                                ->placeholder('Ej: Alérgica al aceite de almendras. Prefiere masajes con presión media y música suave.'),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }



    public static function infolist(Schema $schema): Schema
    {
        return CustomerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CustomersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            AppointmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCustomers::route('/'),
            'create' => CreateCustomer::route('/create'),
            'view' => ViewCustomer::route('/{record}'),
            'edit' => EditCustomer::route('/{record}/edit'),
        ];
    }
}
