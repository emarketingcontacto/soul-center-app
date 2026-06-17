<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'whatsapp',
        'email',
        'birthday',
        'internal_notes',
    ];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class)->orderBy('appointment_date', 'desc');
    }

    protected function whatsapp(): Attribute
    {
        return Attribute::make(
            // Al guardar (Set), limpiamos el texto dejando solo números
            set: function (string $value) {
                return preg_replace('/[^0-9]/', '', $value);
            }
        );
    }
}
