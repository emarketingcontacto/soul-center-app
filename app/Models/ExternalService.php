<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExternalService extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'benefits',
        'image',
        'contacto',
        'whatsapp',
        'seo_description',
        'seo_title',
        'is_active',
    ];

    public function faqs(): HasMany
    {
        return $this->hasMany(ServiceFaq::class, 'external_service_id');
    }
}
