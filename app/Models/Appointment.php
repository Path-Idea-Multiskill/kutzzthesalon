<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $fillable = [
        'service_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'appointment_at',
        'duration_minutes',
        'status',
        'notes',
        'booking_source',
    ];

    protected $casts = [
        'appointment_at' => 'datetime',
        'duration_minutes' => 'integer',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
