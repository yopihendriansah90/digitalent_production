<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Page extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'hero_title',
        'hero_subtitle',
        'hero_highlights',
        'is_published',
        'meta_title',
        'meta_description',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public function sectionBlocks(): HasMany
    {
        return $this->hasMany(SectionBlock::class)->orderBy('order_index');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero_background')->singleFile();
        $this->addMediaCollection('hero_image_1')->singleFile();
        $this->addMediaCollection('hero_image_2')->singleFile();
        $this->addMediaCollection('hero_image_3')->singleFile();
        $this->addMediaCollection('about_photo')->singleFile();
        $this->addMediaCollection('hero_images');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Fit::Crop, 320, 180)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('web')
            ->fit(Fit::Max, 1920, 1080)
            ->format('webp')
            ->nonQueued();
    }
}
