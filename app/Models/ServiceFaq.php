<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceFaq extends Model
{
    protected $fillable = [
        'service_id',
        'external_service_id',
        'question',
        'answer',
        'sort_order'
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function externalService(): BelongsTo
    {
        return $this->belongsTo(ExternalService::class, 'external_service_id');
    }
}
