<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'city',
        'state',
        'pincode',
        'address',
        'phone',
        'alternate_phone',
        'email',
        'google_maps_url',
        'opening_time',
        'closing_time',
        'working_days',
        'image',
        'is_active',
        'is_primary',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];
}
