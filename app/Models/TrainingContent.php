<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TrainingContent extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'hero_title',
        'hero_background_mode',
        'show_domain_numbering',
        'hero_cards',
        'domains',
    ];

    protected function casts(): array
    {
        return [
            'hero_title' => 'array',
            'show_domain_numbering' => 'boolean',
            'hero_cards' => 'array',
            'domains' => 'array',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero_background')->singleFile();
    }
}
