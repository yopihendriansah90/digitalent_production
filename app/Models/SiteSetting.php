<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SiteSetting extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'company_name',
        'tagline',
        'email',
        'phone',
        'whatsapp',
        'address',
        'instagram_url',
        'linkedin_url',
        'website_url',
        'copyright_text',
        'map_embed',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo_light')->singleFile();
        $this->addMediaCollection('logo_dark')->singleFile();
        $this->addMediaCollection('favicon')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Fit::Contain, 240, 240)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('web')
            ->fit(Fit::Contain, 800, 800)
            ->format('webp')
            ->nonQueued();
    }
}
