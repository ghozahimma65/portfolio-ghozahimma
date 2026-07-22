<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test that project detail page returns 404 when project not found.
     */
    public function test_project_detail_page_not_found_returns_404(): void
    {
        $response = $this->get('/project/non-existent-slug');

        $response->assertStatus(404);
    }
}
