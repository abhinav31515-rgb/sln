<?php

namespace Database\Factories;

use App\Models\Membership;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Membership>
 */
class MembershipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tiers = [
            'Bronze' => [
                'price' => 99.00,
                'perks' => [
                    '10% discount on all services',
                    'Priority booking',
                    'Monthly wellness newsletter',
                ],
            ],
            'Silver' => [
                'price' => 199.00,
                'perks' => [
                    '15% discount on all services',
                    'Priority booking',
                    'One complimentary facial per quarter',
                    'Exclusive member events',
                ],
            ],
            'Gold' => [
                'price' => 399.00,
                'perks' => [
                    '20% discount on all services',
                    'Priority booking',
                    'One complimentary massage per month',
                    'Free product samples',
                    'VIP lounge access',
                    'Birthday spa package',
                ],
            ],
        ];

        $tierName = fake()->randomElement(array_keys($tiers));
        $tierData = $tiers[$tierName];

        return [
            'tier_name' => $tierName,
            'price' => $tierData['price'],
            'perks_json' => $tierData['perks'],
        ];
    }
}
