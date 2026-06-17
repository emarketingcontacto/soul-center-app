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
        Schema::table('service_faqs', function (Blueprint $table) {
            // Relación al servicio externo como nullable (opcional)
            $table->foreignId('external_service_id')
                ->nullable()
                ->after('service_id')
                ->constrained('external_services')
                ->cascadeOnDelete(); // Si se borra el servicio externo, se limpian sus FAQs
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_faqs', function (Blueprint $table) {
            // Eliminamos la llave foránea y la columna si hacemos rollback
            $table->dropForeign(['external_service_id']);
            $table->dropColumn('external_service_id');
        });
    }
};
