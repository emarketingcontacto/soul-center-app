<?php

namespace App\Filament\Resources\Appointments;

use App\Filament\Resources\Appointments\Pages\CreateAppointment;
use App\Filament\Resources\Appointments\Schemas\AppointmentForm;
use App\Filament\Resources\Appointments\Pages\EditAppointment;
use App\Filament\Resources\Appointments\Pages\ListAppointments;
use App\Filament\Resources\Appointments\Schemas\AppointmentInfolist;
use App\Filament\Resources\Appointments\Tables\AppointmentsTable;
use App\Models\Appointment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
//use App\Filament\Resources\Appointments\Pages\ViewAppointment;


class AppointmentResource extends Resource
{
    protected static string|UnitEnum|null $navigationGroup = 'Control Operativo';
    protected static ?string $model = Appointment::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Calendar;
    protected static ?string $recordTitleAttribute = 'client_name';

    public static function form(Schema $schema): Schema
    {
        // Con esto obligas tanto a la página de Crear, Editar y VER a usar el nuevo diseño de 6 campos
        return AppointmentForm::configure($schema);
    }


    public static function infolist(Schema $schema): Schema
    {
        return AppointmentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AppointmentsTable::configure($table);
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
            'index' => ListAppointments::route('/'),
            'create' => CreateAppointment::route('/create'),
            //'view' => ViewAppointment::route('/{record}'),
            'edit' => EditAppointment::route('/{record}/edit'),
        ];
    }
}
