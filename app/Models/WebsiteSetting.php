<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'site_tagline',
        'email',
        'phone',
        'address',
        'primary_color',
        'secondary_color',
        'light_color',
        'heading_font',
        'body_font',
    ];
}
