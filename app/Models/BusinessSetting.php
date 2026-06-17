<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessSetting extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'whatsapp',
        'google_maps_url',
        'social_media', // Array dinámico
    ];

    protected $casts = [
        'social_media' => 'array',
    ];
}
