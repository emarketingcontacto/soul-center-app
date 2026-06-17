<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessData extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'whatsapp',
        'google_maps_link',
        'schedule',
        'social_media',
    ];

    protected $casts = [
        'schedule' => 'array',
        'social_media' => 'array',
    ];
}
