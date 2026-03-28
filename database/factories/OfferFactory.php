<?php

namespace Database\Factories;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->randomElement([
                'Spring Wellness Special',
                'New Client Discount',
                'Weekend Spa Package',
                'Birthday Month Treat',
                'Couples Massage Deal',
                'Summer Refresh Offer',
                'Holiday Gift Special',
            ]),
            'discount_percentage' => fake()->numberBetween(1, 50),
            'discount_code' => strtoupper(fake()->unique()->lexify('??????')),
            'valid_until' => fake()->dateTimeBetween('+1 week', '+3 months'),
        ];
    }
}
