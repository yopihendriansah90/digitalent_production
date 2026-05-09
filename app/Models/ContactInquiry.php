<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactInquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'service_type',
        'message',
        'status',
        'assigned_to',
    ];

    public const STATUS_NEW = 'new';
    public const STATUS_READ = 'read';
    public const STATUS_REPLIED = 'replied';

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
