<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class OutsourcingContent extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'hero_title',
        'hero_background_mode',
        'hero_cards',
        'offer_cards',
        'selection_kicker',
        'selection_title',
        'benefit_items',
    ];

    protected function casts(): array
    {
        return [
            'hero_title' => 'array',
            'hero_cards' => 'array',
            'offer_cards' => 'array',
            'selection_kicker' => 'array',
            'selection_title' => 'array',
            'benefit_items' => 'array',
            'hero_background_mode' => 'string',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero_background')->singleFile();
    }
}
