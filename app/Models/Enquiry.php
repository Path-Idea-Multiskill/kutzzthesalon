<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'type',
        'subject',
        'message',
        'status',
        'source',
        'admin_notes',
        'follow_up_at',
    ];

    protected $casts = [
        'follow_up_at' => 'datetime',
    ];
}
