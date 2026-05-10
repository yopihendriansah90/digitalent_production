<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\SectionBlock;
use App\Models\SectionItem;
use Database\Seeders\CmsContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmsContentSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_cms_content_seeder_creates_all_core_pages_and_sections(): void
    {
        $this->seed(CmsContentSeeder::class);

        $expectedSlugs = [
            'home',
            'about',
            'services',
            'vision-mission',
            'portfolio',
            'training',
            'outsourcing',
            'contact',
        ];

        foreach ($expectedSlugs as $slug) {
            $this->assertDatabaseHas('pages', [
                'slug' => $slug,
                'is_published' => true,
            ]);
        }

        $sectionMap = config('company_profile.section_keys');

        foreach ($sectionMap as $slug => $sectionKeys) {
            $page = Page::query()->where('slug', $slug)->first();
            $this->assertNotNull($page, "Page {$slug} should exist after seed.");

            foreach ($sectionKeys as $sectionKey) {
                $this->assertDatabaseHas('section_blocks', [
                    'page_id' => $page->id,
                    'section_key' => $sectionKey,
                    'is_active' => true,
                ]);
            }
        }

        $this->assertGreaterThanOrEqual(8, Page::count());
        $this->assertGreaterThan(0, SectionBlock::count());
        $this->assertGreaterThan(0, SectionItem::count());
    }
}
