<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademyCourse extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'short_description',
        'description',
        'curriculum',
        'fees',
        'duration',
        'eligibility',
        'certificate',
        'image',
        'is_active',
        'is_featured',
        'sort_order',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'fees' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];
}
