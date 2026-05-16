<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ContactContent extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'hero_title',
        'contact_info_title',
        'contact_items',
        'form_title',
        'form_labels',
        'service_options',
        'button_labels',
    ];

    protected function casts(): array
    {
        return [
            'hero_title' => 'array',
            'contact_info_title' => 'array',
            'contact_items' => 'array',
            'form_title' => 'array',
            'form_labels' => 'array',
            'service_options' => 'array',
            'button_labels' => 'array',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero_background')->singleFile();
    }
}
