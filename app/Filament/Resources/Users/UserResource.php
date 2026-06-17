<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Models\User;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Support\Facades\Hash;
//use App\Filament\Resources\Users\Schemas\UserForm;
//use App\Filament\Resources\Users\Tables\UsersTable;
class UserResource extends Resource
{
    protected static string|UnitEnum|null $navigationGroup = 'Configuración';
    protected static ?string $model = User::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::User;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Users';
    protected static ?string $modelLabel = 'Usuario';
    protected static ?string $pluralModelLabel = 'Usuarios del Sistema';

    public static function form(Schema $schema): Schema
    {
       return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre Completo')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('whatsapp')
                            ->label('WhatsApp')
                            ->tel()
                            ->minLength(10)
                            ->maxLength(10) // Política de 10 dígitos
                            ->regex('/^[0-9]{10}$/') // Cero símbolos o letras
                            ->helperText('Ingresa los 10 dígitos numéricos sin espacios ni guiones.')
                            ->placeholder('4771234567'),

                        // El selector del rol clave que creamos en la migración
                        Select::make('role')
                            ->label('Rol en el Spa')
                            ->options([
                                'admin' => 'Administrador',
                                'staff' => 'Asistente',
                            ])
                            ->default('staff')
                            ->native(false)
                            ->required(),

                        // Contraseña inteligente: requerida al crear, opcional al editar
                        TextInput::make('password')
                            ->label('Contraseña')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->maxLength(255),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Correo Electrónico')
                    ->searchable(),

                // Mostramos el rol con un Badge limpio para identificar quién es quién
                TextColumn::make('role')
                    ->label('Rol')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',  // Rojo para administrador
                        'staff' => 'info',    // Azul/Cian para asistentes
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'admin' => 'Administrador',
                        'staff' => 'Asistente / Personal',
                        default => $state,
                    })
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Fecha de Registro')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filtros opcionales en el futuro
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
