<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class HomeContent extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_primary_cta_label',
        'hero_primary_cta_url',
        'hero_secondary_cta_label',
        'hero_secondary_cta_url',
        'hero_proof_items',
        'core_values_kicker',
        'core_values_title',
        'core_values_items',
        'progress_kicker',
        'progress_items',
        'why_choose_kicker',
        'why_choose_title',
        'why_choose_items',
        'faq_kicker',
        'faq_title',
        'faq_items',
    ];

    protected function casts(): array
    {
        return [
            'hero_title' => 'array',
            'hero_subtitle' => 'array',
            'hero_primary_cta_label' => 'array',
            'hero_primary_cta_url' => 'array',
            'hero_secondary_cta_label' => 'array',
            'hero_secondary_cta_url' => 'array',
            'hero_proof_items' => 'array',
            'core_values_kicker' => 'array',
            'core_values_title' => 'array',
            'core_values_items' => 'array',
            'progress_kicker' => 'array',
            'progress_items' => 'array',
            'why_choose_kicker' => 'array',
            'why_choose_title' => 'array',
            'why_choose_items' => 'array',
            'faq_kicker' => 'array',
            'faq_title' => 'array',
            'faq_items' => 'array',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero_background_1')->singleFile();
        $this->addMediaCollection('hero_background_2')->singleFile();
        $this->addMediaCollection('hero_background_3')->singleFile();

        // Optional: each core value can have one icon, mapped by index in UI.
        $this->addMediaCollection('core_value_icon_1')->singleFile();
        $this->addMediaCollection('core_value_icon_2')->singleFile();
        $this->addMediaCollection('core_value_icon_3')->singleFile();
        $this->addMediaCollection('core_value_icon_4')->singleFile();
        $this->addMediaCollection('core_value_icon_5')->singleFile();
    }
}
