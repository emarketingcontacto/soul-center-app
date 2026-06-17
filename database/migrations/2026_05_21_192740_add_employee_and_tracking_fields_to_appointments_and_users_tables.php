<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
            Schema::table('appointments_and_users_tables', function (Blueprint $table) {
                // 1. Modificamos la tabla de Users para agregar el rol
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'role')) {
                    $table->string('role')->default('staff')->after('password'); // admin o staff
                }
            });

            // 2. Modificamos la tabla de Appointments para asignar empleada y rastrear quién la creó
            Schema::table('appointments', function (Blueprint $table) {
                // Empleada (asistente) que atenderá la cita
                $table->unsignedBigInteger('employee_id')->nullable()->after('service_id');

                // Usuario que registró la cita (Karina o la asistente en turno)
                $table->unsignedBigInteger('created_by')->nullable()->after('origin');

                // Agregamos las llaves foráneas apuntando a la tabla users
                $table->foreign('employee_id')->references('id')->on('users')->onDelete('set null');
                $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropForeign(['created_by']);
            $table->dropColumn(['employee_id', 'created_by']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
