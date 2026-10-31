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

    /**
     * Generate embed URL based on video platform.
     *
     * YouTube  -> youtube-nocookie.com/embed/VIDEO_ID
     * Instagram Reel -> instagram.com/reel/SHORTCODE/embed/
     * Instagram Post -> instagram.com/p/SHORTCODE/embed/
     */
    public function getEmbedUrlAttribute(): string
    {
        if ($this->platform === 'youtube') {
            return 'https://www.youtube-nocookie.com/embed/'
                . rawurlencode((string) $this->video_id);
        }

        if ($this->platform === 'instagram') {

            $path = parse_url($this->video_url, PHP_URL_PATH) ?: '';

            $type = preg_match('~^/(reel|reels)/~i', $path)
                ? 'reel'
                : 'p';

            return 'https://www.instagram.com/'
                . $type . '/'
                . rawurlencode((string) $this->video_id)
                . '/embed/';
        }

        return '';
    }
}
