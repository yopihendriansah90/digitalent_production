<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
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
}
