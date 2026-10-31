<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title',
        'platform',
        'video_url',
        'video_id',
        'thumbnail',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getEmbedUrlAttribute(): string
    {
        if ($this->platform === 'youtube') {
            return 'https://www.youtube-nocookie.com/embed/'
                . $this->video_id;
        }

        return 'https://www.instagram.com/p/'
            . $this->video_id . '/embed/';
    }
}