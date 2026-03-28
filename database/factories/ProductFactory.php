<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Lavender Essential Oil',
                'Rose Hydrating Serum',
                'Organic Body Butter',
                'Himalayan Salt Scrub',
                'Argan Hair Oil',
                'Green Tea Face Mask',
                'Coconut Body Lotion',
                'Vitamin C Serum',
            ]),
            'category' => fake()->randomElement([
                'Skincare',
                'Haircare',
                'Body Care',
                'Essential Oils',
                'Aromatherapy',
                'Wellness',
            ]),
            'description' => fake()->paragraphs(2, true),
            'price' => fake()->randomFloat(2, 15, 200),
            'stock' => fake()->numberBetween(0, 200),
            'image_url' => fake()->imageUrl(640, 480, 'products', true),
        ];
    }
}
