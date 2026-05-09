<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SectionBlock extends Model
{
    protected $fillable = [
        'page_id',
        'section_key',
        'section_title',
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
}
