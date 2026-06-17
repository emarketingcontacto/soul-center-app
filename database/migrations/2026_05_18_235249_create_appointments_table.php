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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->string('client_name');
            $table->string('client_phone');
            $table->dateTime('appointment_date');
            // Valores sugeridos: web, backoffice, local
            $table->string('origin')->default('web');
            // Estado operativo de la cita
            $table->string('status')->default('pending');
            // Control Financiero
            $table->string('payment_status')->default('unpaid');
            $table->decimal('amount_paid', 8, 2)->default(0.00);
            $table->string('stripe_payment_id')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
