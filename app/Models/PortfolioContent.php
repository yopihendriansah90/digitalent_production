<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PortfolioContent extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'hero_title',
        'hero_cards',
        'clients_kicker',
        'gallery_heading',
        'client_logos',
        'gallery_items',
    ];

    protected function casts(): array
    {
        return [
            'hero_title' => 'array',
            'hero_cards' => 'array',
            'clients_kicker' => 'array',
            'gallery_heading' => 'array',
            'client_logos' => 'array',
            'gallery_items' => 'array',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero_background')->singleFile();
    }
}
