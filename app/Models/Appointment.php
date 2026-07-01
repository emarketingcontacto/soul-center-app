<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
        protected $fillable = [
            'customer_id',
            'service_id',
            'employee_id',
            'appointment_date',
            'origin',
            'status',
            'created_by',
            'payment_status',
            'amount_paid',
            'google_event_id',
            'stripe_payment_id',
            'notes',
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
        'amount_paid' => 'decimal:2',
    ];

    /**
     * Relación: Una cita pertenece a un servicio.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
 * Relación indirecta: Una cita tiene una categoría a través de su servicio.
 */
    public function category(): BelongsTo
    {
        // Usamos el modelo Service como puente para obtener la categoría
        return $this->belongsTo(Category::class, 'service_id');
    }

    // Relación con la empleada que atiende
    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    // Relación con el usuario que creó la cita
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function booted(): void
    {
        static::observe(\App\Observers\AppointmentObserver::class);
    }
}
