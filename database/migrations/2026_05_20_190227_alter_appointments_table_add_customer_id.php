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
        Schema::table('appointments', function (Blueprint $blueprint) {
            // 1. Eliminamos los campos planos viejos
            $blueprint->dropColumn(['client_name', 'client_phone']);

            // 2. Agregamos la llave foránea apuntando a la tabla customers
            $blueprint->foreignId('customer_id')
                ->after('service_id')
                ->constrained('customers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $blueprint) {
            $blueprint->dropForeign(['customer_id']);
            $blueprint->dropColumn('customer_id');

            $blueprint->string('client_name')->after('service_id');
            $blueprint->string('client_phone')->after('client_name');
        });
    }
};
