<?php

namespace Database\Factories;

use App\Models\JournalPost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JournalPost>
 */
class JournalPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(6, true);
        
        return [
            'title' => rtrim($title, '.'),
            'slug' => \Illuminate\Support\Str::slug($title),
            'category' => fake()->randomElement([
                'Wellness Tips',
                'Beauty Trends',
                'Self-Care',
                'Spa Treatments',
                'Skincare Advice',
                'Lifestyle',
                'Health & Fitness',
            ]),
            'image_url' => fake()->imageUrl(1200, 630, 'wellness', true),
            'content' => fake()->paragraphs(8, true),
            'published_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
