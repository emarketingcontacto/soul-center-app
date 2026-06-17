<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Service extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'benefits',
        'price',
        'duration_minutes',
        'image',
        'is_active',
        'seo_description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'duration_minutes' => 'integer',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: function (?string $value) {
                if (! $value) {
                    return null;
                }

                // Si en la base de datos solo guardaste "9ee14402...webp"
                // le anteponemos la carpeta para que Filament la encuentre en el disco public
                return str_starts_with($value, 'services/') ? $value : "services/{$value}";
            }
        );
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_service');
    }

    public function faqs()
    {
        return $this->hasMany(ServiceFaq::class);
    }
}
