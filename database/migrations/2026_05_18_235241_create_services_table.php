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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            // Relación con categorías: Si se borra la categoría, se borran sus servicios
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique(); // Aquí se guardará "masajes-relajantes-en-leon"
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->integer('duration_minutes'); // Duración del servicio para bloquear la agenda
            $table->string('image')->nullable(); // Ruta de la imagen ya procesada
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
