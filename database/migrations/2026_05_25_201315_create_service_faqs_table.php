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
        Schema::create('service_faqs', function (Blueprint $table) {
            $table->id();
            // Relación con la tabla de servicios
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            // Campos para la pregunta y la respuesta
            $table->string('question');
            $table->text('answer');
            // Orden opcional por si Karina quiere moverlas de lugar arriba/abajo
            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_faqs');
    }
};
