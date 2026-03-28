<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $appointmentDate = fake()->dateTimeBetween('+1 day', '+30 days');
        $startHour = fake()->numberBetween(9, 17);
        $startMinute = fake()->randomElement([0, 30]);
        $startTime = sprintf('%02d:%02d', $startHour, $startMinute);
        
        $durationMinutes = fake()->randomElement([30, 45, 60, 90, 120]);
        $endDateTime = (new \DateTime($startTime))->modify("+{$durationMinutes} minutes");
        $endTime = $endDateTime->format('H:i');

        return [
            'user_id' => \App\Models\User::factory(),
            'service_id' => \App\Models\Service::factory(),
            'therapist_id' => \App\Models\Therapist::factory(),
            'appointment_date' => $appointmentDate,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'status' => fake()->randomElement(['pending', 'confirmed', 'completed', 'cancelled']),
            'total_price' => fake()->randomFloat(2, 50, 500),
        ];
    }
}
