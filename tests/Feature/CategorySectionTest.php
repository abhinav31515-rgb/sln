<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\CategorySection;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategorySectionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test: visible section appears on homepage
     * Requirements: 16.15
     */
    public function test_visible_section_appears_on_homepage(): void
    {
        $category = Category::factory()->create(['name' => 'Facial Treatments']);
        
        $section = CategorySection::create([
            'category_id' => $category->id,
            'heading' => 'Premium Facials',
            'sub_heading' => 'Rejuvenate your skin',
            'layout' => 'grid',
            'sort_order' => 1,
            'is_visible' => true,
        ]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('Premium Facials');
        $response->assertSee('Rejuvenate your skin');
    }

    /**
     * Test: section with `is_visible = false` does not appear on homepage
     * Requirements: 16.15
     */
    public function test_invisible_section_does_not_appear_on_homepage(): void
    {
        $category = Category::factory()->create(['name' => 'Hidden Category']);
        
        $section = CategorySection::create([
            'category_id' => $category->id,
            'heading' => 'Hidden Section',
            'sub_heading' => 'This should not appear',
            'layout' => 'grid',
            'sort_order' => 1,
            'is_visible' => false,
        ]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertDontSee('Hidden Section');
        $response->assertDontSee('This should not appear');
    }
}
