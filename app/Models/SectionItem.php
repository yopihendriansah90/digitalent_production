<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SectionItem extends Model
{
    protected $fillable = [
        'section_block_id',
        'title',
        'description',
        'badge',
        'order_index',
        'extra',
    ];

    protected function casts(): array
    {
        return [
            'extra' => 'array',
        ];
    }

    public function sectionBlock(): BelongsTo
    {
        return $this->belongsTo(SectionBlock::class);
    }
}
