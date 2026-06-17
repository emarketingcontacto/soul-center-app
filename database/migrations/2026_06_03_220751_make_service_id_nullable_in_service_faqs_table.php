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
            // 1. Tumbamos la llave foránea actual para que MySQL nos deje trabajar
            $table->dropForeign('service_faqs_service_id_foreign');
            // 2. Modificamos la columna para que ahora SÍ acepte NULOS
            $table->bigInteger('service_id')->unsigned()->nullable()->change();
            // 3. Volvemos a levantar la llave foránea con sus reglas originales
            $table->foreign('service_id')
                  ->references('id')
                  ->on('services')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_faqs', function (Blueprint $table) {
            $table->dropForeign('service_faqs_service_id_foreign');
            // Revertimos: vuelve a ser obligatorio (NOT NULL)
            $table->bigInteger('service_id')->unsigned()->nullable(false)->change();

            $table->foreign('service_id')
                  ->references('id')
                  ->on('services')
                  ->onDelete('cascade');
        });
    }
};
