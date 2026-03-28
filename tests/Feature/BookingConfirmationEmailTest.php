<?php

namespace Tests\Feature;

use App\Jobs\SendBookingConfirmationEmail;
use App\Mail\BookingConfirmed;
use App\Models\Booking;
use App\Models\Service;
use App\Models\SiteIdentity;
use App\Models\Therapist;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class BookingConfirmationEmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_confirmation_job_is_dispatched_on_booking_creation(): void
    {
        Queue::fake();

        $user = User::factory()->create();
        $therapist = Therapist::factory()->create();
        $service = Service::factory()->create(['duration_minutes' => 60]);

        $this->actingAs($user);

        $response = $this->post(route('bookings.store'), [
            'service_id' => $service->id,
            'therapist_id' => $therapist->id,
            'appointment_date' => now()->addDays(1)->format('Y-m-d'),
            'start_time' => '10:00',
        ]);

        Queue::assertPushed(SendBookingConfirmationEmail::class);
    }

    public function test_booking_confirmed_mailable_has_correct_subject(): void
    {
        SiteIdentity::create([
            'key' => 'brand_name',
            'value' => 'AURUM Spa',
        ]);

        $user = User::factory()->create();
        $therapist = Therapist::factory()->create();
        $service = Service::factory()->create();
        
        $booking = Booking::factory()->create([
            'user_id' => $user->id,
            'service_id' => $service->id,
            'therapist_id' => $therapist->id,
        ]);

        $booking->loadMissing(['service', 'therapist.user', 'user']);

        $mailable = new BookingConfirmed($booking);
        $envelope = $mailable->envelope();

        $this->assertEquals('Your booking at AURUM Spa is confirmed', $envelope->subject);
    }

    public function test_booking_confirmation_email_is_sent_to_user(): void
    {
        Mail::fake();

        $user = User::factory()->create(['email' => 'customer@example.com']);
        $therapist = Therapist::factory()->create();
        $service = Service::factory()->create();
        
        $booking = Booking::factory()->create([
            'user_id' => $user->id,
            'service_id' => $service->id,
            'therapist_id' => $therapist->id,
        ]);

        $booking->loadMissing(['service', 'therapist.user', 'user']);

        $job = new SendBookingConfirmationEmail($booking);
        $job->handle();

        Mail::assertSent(BookingConfirmed::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }
}
