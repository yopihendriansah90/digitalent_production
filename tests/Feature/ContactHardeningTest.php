<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactHardeningTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_honeypot_field_rejects_submission(): void
    {
        $response = $this->post('/contact', [
            'website' => 'https://spam.example.com',
            'name' => 'Bot User',
            'email' => 'bot@example.com',
            'service_type' => 'IT Training',
            'message' => 'Spam attempt',
        ]);

        $response->assertSessionHasErrors(['website']);
        $this->assertDatabaseCount('contact_inquiries', 0);
    }

    public function test_contact_is_rate_limited_after_five_requests_per_minute(): void
    {
        $payload = [
            'name' => 'Rate Limit User',
            'email' => 'ratelimit@example.com',
            'service_type' => 'IT Training',
            'message' => 'Normal message',
        ];

        for ($i = 0; $i < 5; $i++) {
            $this->post('/contact', $payload)->assertStatus(302);
        }

        $this->post('/contact', $payload)->assertStatus(429);
    }
}
