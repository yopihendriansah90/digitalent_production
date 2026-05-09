<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
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
}
