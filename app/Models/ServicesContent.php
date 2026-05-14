<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ServicesContent extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'hero_title',
        'hero_cards',
        'training_kicker',
        'training_title',
        'training_body',
        'training_overview_items',
        'domain_kicker',
        'domain_title',
        'domain_body',
        'mentored_kicker',
        'mentored_title',
        'mentored_items',
        'support_items',
        'outsourcing_kicker',
        'outsourcing_title',
        'outsourcing_body',
        'outsourcing_overview_items',
        'talent_kicker',
        'talent_title',
        'talent_profiles',
        'selection_kicker',
        'selection_title',
        'selection_items',
    ];

    protected function casts(): array
    {
        return [
            'hero_title' => 'array',
            'hero_cards' => 'array',
            'training_kicker' => 'array',
            'training_title' => 'array',
            'training_body' => 'array',
            'training_overview_items' => 'array',
            'domain_kicker' => 'array',
            'domain_title' => 'array',
            'domain_body' => 'array',
            'mentored_kicker' => 'array',
            'mentored_title' => 'array',
            'mentored_items' => 'array',
            'support_items' => 'array',
            'outsourcing_kicker' => 'array',
            'outsourcing_title' => 'array',
            'outsourcing_body' => 'array',
            'outsourcing_overview_items' => 'array',
            'talent_kicker' => 'array',
            'talent_title' => 'array',
            'talent_profiles' => 'array',
            'selection_kicker' => 'array',
            'selection_title' => 'array',
            'selection_items' => 'array',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero_background')->singleFile();
        $this->addMediaCollection('domain_chart_image')->singleFile();
        $this->addMediaCollection('mentored_cover_image')->singleFile();
    }
}
