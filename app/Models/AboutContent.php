<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AboutContent extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'hero_title',
        'who_we_are_title',
        'who_we_are_body',
        'where_we_come_from_title',
        'where_we_come_from_body',
        'commitment_title',
        'commitment_body',
        'founded_label',
        'founded_value',
        'group_label',
        'group_value',
        'business_focus_title',
        'focus_1_title',
        'focus_1_body',
        'focus_2_title',
        'focus_2_body',
    ];

    protected function casts(): array
    {
        return [
            'hero_title' => 'array',
            'who_we_are_title' => 'array',
            'who_we_are_body' => 'array',
            'where_we_come_from_title' => 'array',
            'where_we_come_from_body' => 'array',
            'commitment_title' => 'array',
            'commitment_body' => 'array',
            'founded_label' => 'array',
            'founded_value' => 'array',
            'group_label' => 'array',
            'group_value' => 'array',
            'business_focus_title' => 'array',
            'focus_1_title' => 'array',
            'focus_1_body' => 'array',
            'focus_2_title' => 'array',
            'focus_2_body' => 'array',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('about_photo')->singleFile();
    }
}
