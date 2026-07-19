<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecurityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that security headers are applied to the responses.
     */
    public function test_security_headers_are_applied(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
    }

    /**
     * Test that guest users cannot access logout route.
     */
    public function test_guest_cannot_access_logout(): void
    {
        // A POST to logout without active session/auth should redirect
        $response = $this->post('/admin/logout');

        // Since it's protected by 'admin.auth', it redirects to 'admin.login'
        $response->assertRedirect(route('admin.login'));
    }
}
