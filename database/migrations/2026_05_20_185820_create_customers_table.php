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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('whatsapp')->unique(); // El teléfono nos servirá para identificarlo si agenda por WhatsApp/Web
            $table->date('birthday')->nullable(); // Campo clave para las promociones de cumpleaños
            $table->text('internal_notes')->nullable(); // Notas fijas (Ej: "Alergia al aceite de almendras")
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
