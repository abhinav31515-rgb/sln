<?php

namespace Tests\Feature;

use App\Models\PageSeo;
use App\Models\SiteIdentity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageSeoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test: homepage renders correct `<title>` and `<meta name="description">` from `PageSeo` record
     * Requirements: 15.15
     */
    public function test_homepage_renders_correct_title_and_meta_description(): void
    {
        // Create PageSeo record for home route
        PageSeo::create([
            'route_name' => 'home',
            'title' => 'AURUM - Luxury Spa Experience',
            'description' => 'Experience luxury spa treatments in the heart of Gurugram',
            'robots' => 'index, follow',
        ]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('<title>AURUM - Luxury Spa Experience</title>', false);
        $response->assertSee('<meta name="description" content="Experience luxury spa treatments in the heart of Gurugram"', false);
    }

    /**
     * Test: `GET /llms.txt` returns 200 containing brand name
     * Requirements: 15.15
     */
    public function test_llms_txt_returns_200_with_brand_name(): void
    {
        // Create site identity with brand name
        SiteIdentity::create([
            'key' => 'brand_name',
            'value' => 'AURUM',
        ]);

        // Create PageSeo for home with LLM fields
        PageSeo::create([
            'route_name' => 'home',
            'title' => 'AURUM Spa',
            'description' => 'Luxury spa',
            'llm_summary' => 'AURUM is a luxury spa offering premium treatments',
            'llm_keywords' => 'luxury spa, wellness, Gurugram',
            'robots' => 'index, follow',
        ]);

        $response = $this->get(route('llms'));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'text/plain; charset=UTF-8');
        $response->assertSee('AURUM');
    }
}
