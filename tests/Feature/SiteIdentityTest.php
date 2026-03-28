<?php

namespace Tests\Feature;

use App\Models\SiteIdentity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class SiteIdentityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test: updating `brand_name` via admin form causes homepage to render new name
     * and invalidates `site_identity.all` cache
     * Requirements: 14.13
     */
    public function test_updating_brand_name_renders_new_name_and_invalidates_cache(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        // Create initial brand_name
        SiteIdentity::create([
            'key' => 'brand_name',
            'value' => 'AURUM',
        ]);

        // Prime the cache by visiting homepage
        $response = $this->get(route('home'));
        $response->assertSee('AURUM');
        
        // Verify cache exists
        $this->assertTrue(Cache::has('site_identity.all'), 'Cache should exist after first request');

        // Admin updates the brand name
        $this->actingAs($admin);
        
        $updateResponse = $this->post(route('admin.identity.update'), [
            'values' => [
                'brand_name' => 'LUXE SPA',
            ],
        ]);

        $updateResponse->assertRedirect();

        // Verify cache was invalidated
        $this->assertFalse(Cache::has('site_identity.all'), 'Cache should be invalidated after identity update');

        // Verify new brand name appears on homepage
        $response = $this->get(route('home'));
        $response->assertSee('LUXE SPA');
        
        // Verify the database was updated
        $this->assertDatabaseHas('site_identities', [
            'key' => 'brand_name',
            'value' => 'LUXE SPA',
        ]);
    }
}
