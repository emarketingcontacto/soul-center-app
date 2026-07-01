<?php

namespace App\Filament\Resources\Appointments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AppointmentForm
{
    public static function configure(Schema $schema): Schema
    {
       return $schema
            ->components([
                Section::make('Detalles de la Cita')
                    ->description('Asigna el cliente, el servicio y el horario para la sesión.')
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)
                            ->schema([

                                // 1. Nuevo selector del Cliente (Relación)
                                Select::make('customer_id')
                                    ->label('Cliente')
                                    ->relationship('customer', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                // 2. Horario de la Cita
                                DateTimePicker::make('appointment_date')
                                    ->label('Fecha y Hora')
                                    ->native(false)
                                    ->displayFormat('d/m/Y g:i A')
                                    ->minutesStep(15)
                                    ->required(),

                                // 3. Filtro Reactivo de Categorías (Estilo v4 sin imports)
                                Select::make('category_id')
                                    ->label('Filtrar por Categoría (Opcional)')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->live()
                                    ->afterStateUpdated(function ($set) {
                                        $set('service_id', null);
                                        $set('employee_id', null); // Limpiamos también la asistente si cambian la categoría
                                    }),

                                // 4. Selector del Servicio inteligente
                                Select::make('service_id')
                                    ->label('Servicio a Realizar')
                                    ->relationship(
                                        name: 'service',
                                        titleAttribute: 'name',
                                        modifyQueryUsing: function ($get, $query) {
                                            $categoryId = $get('category_id');
                                            return $query->when($categoryId, fn ($q) => $q->where('category_id', $categoryId));
                                        }
                                    )
                                    ->searchable()
                                    ->preload()
                                    ->live() // 🌟 IMPORTANTE: Hace que el formulario reaccione en tiempo real al elegir el servicio
                                    ->afterStateUpdated(fn ($set) => $set('employee_id', null)) // Limpia la asistente si cambian el servicio
                                    ->required(),

                                // 5. Selector de la empleada/asistente filtrado por Servicio seleccionado
                                Select::make('employee_id')
                                    ->label('Asistente que Atiende')
                                    ->placeholder(fn ($get) => $get('service_id')
                                        ? 'Selecciona a la terapeuta'
                                        : '⚠️ Selecciona un servicio primero...'
                                    )
                                    ->disabled(fn ($get) => ! $get('service_id')) // Bloqueado hasta que elijan un servicio
                                    ->relationship(
                                        name: 'employee',
                                        titleAttribute: 'name',
                                        modifyQueryUsing: function ($get, $query) {
                                            $serviceId = $get('service_id');

                                            // Filtramos primero por rol administrativo/staff
                                            $query->whereIn('role', ['staff', 'admin']);

                                            // 🌟 MAGIA DE ELOQUENT: Si hay un servicio seleccionado, solo trae las terapeutas asociadas a él a través de la tabla pivote user_service
                                            return $query->when($serviceId, function ($q) use ($serviceId) {
                                                return $q->whereHas('services', fn ($subQuery) => $subQuery->where('services.id', $serviceId));
                                            });
                                        }
                                    )
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                // 6. Estatus de la Cita homologado
                                Select::make('status')
                                    ->label('Estatus de la Cita')
                                    ->options([
                                        'pending' => 'Programada',
                                        'confirmed' => 'Confirmada',
                                        'completed' => 'Completada',
                                        'cancelled' => 'Cancelada',
                                        'no-show' => 'No llegó',
                                    ])
                                    ->default('pending')
                                    ->native(false)
                                    ->required(),

                                // 7. Origen de la Cita (Cierra la cuadrícula de forma perfecta)
                                Select::make('origin')
                                    ->label('Origen de la cita')
                                    ->options([
                                        'web' => 'Web',
                                        'direct' => 'Directa',
                                    ])
                                    ->default('direct')
                                    ->native(false)
                                    ->required(),
                            ]),

                        // Notas/Comentarios ocupando el ancho completo inferior
                        Textarea::make('notes')
                            ->label('Notas específicas para esta cita')
                            ->placeholder('Ej: Solicito la cabina del fondo o requiere técnica de relajación extra.')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
