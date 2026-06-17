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
        Schema::create('external_services', function (Blueprint $table) {
            $table->id();

            // Datos de Contacto y Control
            $table->string('contacto');          // Nombre del especialista (ej: Nutrióloga Mariana de la Rosa)
            $table->string('whatsapp');          // Teléfono a 10 dígitos limpios (para el helper de redirección)[cite: 1, 2]
            $table->string('slug')->unique();    // URL limpia (ej: nutricion-control-de-peso)
            // Contenido Visual y Textos
            $table->string('title');             // Título público del servicio
            $table->string('image')->nullable(); // Foto principal del servicio (manejada por Filament v4)
            $table->text('description');         // Explicación detallada de qué trata
            $table->text('benefits');            // Viñetas o texto con los beneficios clave
            // Variables para Optimización SEO Avanzada
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('external_services');
    }
};
