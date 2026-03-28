<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class CacheTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test: after admin creates a service, `services.all` cache key is invalidated
     * Requirements: 11.13
     */
    public function test_services_cache_is_invalidated_after_admin_creates_service(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();

        // Prime the cache by visiting the services index
        $this->get(route('services.index'));
        
        // Verify cache exists
        $this->assertTrue(Cache::has('services.all'), 'Cache should exist after first request');

        // Admin creates a new service
        $this->actingAs($admin);
        
        $response = $this->post(route('services.store'), [
            'name' => 'New Service',
            'category_id' => $category->id,
            'duration_minutes' => 60,
            'price' => 100.00,
            'description' => 'Test service',
        ]);

        $response->assertRedirect();

        // Verify cache was invalidated
        $this->assertFalse(Cache::has('services.all'), 'Cache should be invalidated after service creation');
    }
}
