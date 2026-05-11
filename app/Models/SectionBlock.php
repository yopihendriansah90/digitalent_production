<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SectionBlock extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'page_id',
        'section_key',
        'section_title',
        'section_subtitle',
        'section_description',
        'order_index',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(SectionItem::class)->orderBy('order_index');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('section_images');
        $this->addMediaCollection('section_icons');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Fit::Crop, 320, 180)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('web')
            ->fit(Fit::Max, 1600, 900)
            ->format('webp')
            ->nonQueued();
    }
}
