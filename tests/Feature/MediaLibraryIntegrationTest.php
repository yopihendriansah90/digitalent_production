<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\SectionBlock;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MediaLibraryIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_site_setting_collections_are_registered(): void
    {
        $model = new SiteSetting();

        $names = collect($model->getRegisteredMediaCollections())->pluck('name')->all();

        $this->assertContains('logo_light', $names);
        $this->assertContains('logo_dark', $names);
        $this->assertContains('favicon', $names);
    }

    public function test_page_collections_are_registered(): void
    {
        $model = new Page();

        $names = collect($model->getRegisteredMediaCollections())->pluck('name')->all();

        $this->assertContains('hero_background', $names);
        $this->assertContains('hero_images', $names);
    }

    public function test_section_block_collections_are_registered(): void
    {
        $model = new SectionBlock();

        $names = collect($model->getRegisteredMediaCollections())->pluck('name')->all();

        $this->assertContains('section_images', $names);
        $this->assertContains('section_icons', $names);
    }
}
