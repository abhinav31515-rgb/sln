<?php

namespace Database\Factories;

use App\Models\Therapist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Therapist>
 */
class TherapistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'specialty' => fake()->randomElement([
                'Swedish Massage',
                'Deep Tissue Massage',
                'Hot Stone Therapy',
                'Aromatherapy',
                'Sports Massage',
                'Reflexology',
                'Thai Massage',
                'Prenatal Massage',
            ]),
            'bio' => fake()->paragraphs(3, true),
            'avatar_url' => fake()->imageUrl(400, 400, 'people', true),
        ];
    }
}
