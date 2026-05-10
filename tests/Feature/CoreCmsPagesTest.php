<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\SectionBlock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CoreCmsPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_core_routes_render_ok_with_empty_data(): void
    {
        $this->get('/')->assertOk();
        $this->get('/about')->assertOk();
        $this->get('/services')->assertOk();
        $this->get('/contact')->assertOk();
        $this->get('/vision-mission')->assertOk();
        $this->get('/portfolio')->assertOk();
        $this->get('/training')->assertOk();
        $this->get('/outsourcing')->assertOk();
    }

    public function test_home_page_renders_modern_layout_shell(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('fixed inset-x-0 top-0 z-50', false);
        $response->assertSee('id="desktop-topbar"', false);
    }

    public function test_contact_submission_is_stored_with_new_status(): void
    {
        $response = $this->post('/contact', [
            'name' => 'Asti',
            'email' => 'asti@example.com',
            'service_type' => 'IT Training',
            'message' => 'Kami butuh training cloud dasar.',
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('contact_inquiries', [
            'name' => 'Asti',
            'email' => 'asti@example.com',
            'status' => 'new',
        ]);
    }

    public function test_contact_submission_validation_errors(): void
    {
        $response = $this->post('/contact', [
            'name' => '',
            'email' => 'invalid-email',
            'message' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'message']);
    }

    public function test_unpublished_page_is_not_used_for_public_render(): void
    {
        Page::query()->create([
            'title' => 'About',
            'slug' => 'about',
            'hero_title' => 'Hidden Unpublished Hero',
            'is_published' => false,
        ]);

        $this->get('/about')
            ->assertOk()
            ->assertDontSee('Hidden Unpublished Hero');
    }

    public function test_unpublished_training_page_uses_fallback_content(): void
    {
        Page::query()->create([
            'title' => 'Training',
            'slug' => 'training',
            'hero_title' => 'Hidden Training Hero',
            'is_published' => false,
        ]);

        $this->get('/training')
            ->assertOk()
            ->assertDontSee('Hidden Training Hero');
    }

    public function test_only_active_sections_are_injected_to_view_data(): void
    {
        $page = Page::query()->create([
            'title' => 'Home',
            'slug' => 'home',
            'hero_title' => 'CMS Hero',
            'is_published' => true,
        ]);

        SectionBlock::query()->create([
            'page_id' => $page->id,
            'section_key' => 'hero',
            'section_title' => 'Hero',
            'order_index' => 1,
            'is_active' => true,
        ]);

        SectionBlock::query()->create([
            'page_id' => $page->id,
            'section_key' => 'cta',
            'section_title' => 'CTA',
            'order_index' => 2,
            'is_active' => false,
        ]);

        $response = $this->get('/');
        $response->assertOk();

        $sections = $response->viewData('sections');

        $this->assertArrayHasKey('hero', $sections);
        $this->assertArrayNotHasKey('cta', $sections);
    }

    public function test_only_active_sections_are_injected_for_portfolio_page(): void
    {
        $page = Page::query()->create([
            'title' => 'Portfolio',
            'slug' => 'portfolio',
            'hero_title' => 'Portfolio Hero',
            'is_published' => true,
        ]);

        SectionBlock::query()->create([
            'page_id' => $page->id,
            'section_key' => 'client_logos',
            'section_title' => 'Client Logos',
            'order_index' => 1,
            'is_active' => true,
        ]);

        SectionBlock::query()->create([
            'page_id' => $page->id,
            'section_key' => 'training_gallery',
            'section_title' => 'Training Gallery',
            'order_index' => 2,
            'is_active' => false,
        ]);

        $response = $this->get('/portfolio');
        $response->assertOk();

        $sections = $response->viewData('sections');

        $this->assertArrayHasKey('client_logos', $sections);
        $this->assertArrayNotHasKey('training_gallery', $sections);
    }
}
