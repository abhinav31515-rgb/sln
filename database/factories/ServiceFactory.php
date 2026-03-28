<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => \App\Models\Category::factory(),
            'name' => fake()->randomElement([
                'Swedish Massage',
                'Deep Tissue Massage',
                'Hot Stone Therapy',
                'Aromatherapy Session',
                'Facial Treatment',
                'Body Scrub',
                'Manicure & Pedicure',
                'Hair Styling',
            ]),
            'duration_minutes' => fake()->randomElement([30, 45, 60, 90, 120]),
            'price' => fake()->randomFloat(2, 50, 500),
            'image_url' => fake()->imageUrl(640, 480, 'spa', true),
            'description' => fake()->paragraphs(2, true),
            'sort_order' => fake()->numberBetween(0, 100),
        ];
    }
}
