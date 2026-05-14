<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class VisionMissionContent extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'hero_title',
        'vision_kicker',
        'vision_text',
        'mission_kicker',
        'mission_items',
    ];

    protected function casts(): array
    {
        return [
            'hero_title' => 'array',
            'vision_kicker' => 'array',
            'vision_text' => 'array',
            'mission_kicker' => 'array',
            'mission_items' => 'array',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero_background')->singleFile();
    }
}
