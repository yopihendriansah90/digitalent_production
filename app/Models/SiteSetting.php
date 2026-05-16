<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SiteSetting extends Model implements HasMedia
{
    use InteractsWithMedia;

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
        'topbar_working_hours',
        'topbar_address_short',
        'consultation_label',
        'nav_labels',
        'footer_description',
        'footer_pages_title',
        'footer_services_title',
        'footer_contact_title',
        'footer_service_links',
        'footer_bottom_right_text',
    ];

    protected function casts(): array
    {
        return [
            'topbar_working_hours' => 'array',
            'topbar_address_short' => 'array',
            'consultation_label' => 'array',
            'nav_labels' => 'array',
            'footer_description' => 'array',
            'footer_pages_title' => 'array',
            'footer_services_title' => 'array',
            'footer_contact_title' => 'array',
            'footer_service_links' => 'array',
            'footer_bottom_right_text' => 'array',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo_light')->singleFile();
        $this->addMediaCollection('logo_dark')->singleFile();
        $this->addMediaCollection('favicon')->singleFile();
        $this->addMediaCollection('whatsapp_icon')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Fit::Contain, 240, 240)
            ->format('webp')
            ->nonQueued();

        $this->addMediaConversion('web')
            ->fit(Fit::Contain, 800, 800)
            ->format('webp')
            ->nonQueued();
    }
}
