<?php

namespace Tests\Unit;

use App\Models\Booking;
use App\Models\User;
use App\Policies\BookingPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingPolicyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test: `view` returns true when booking user_id matches authenticated user id
     * Requirements: 11.9
     */
    public function test_view_returns_true_when_booking_belongs_to_user(): void
    {
        $user = User::factory()->create(['role' => 'customer']);
        $booking = Booking::factory()->create(['user_id' => $user->id]);

        $policy = new BookingPolicy();

        $result = $policy->view($user, $booking);

        $this->assertTrue($result);
    }

    /**
     * Test: `view` returns false when booking user_id does not match
     * Requirements: 11.10
     */
    public function test_view_returns_false_when_booking_does_not_belong_to_user(): void
    {
        $user1 = User::factory()->create(['role' => 'customer']);
        $user2 = User::factory()->create(['role' => 'customer']);
        $booking = Booking::factory()->create(['user_id' => $user1->id]);

        $policy = new BookingPolicy();

        $result = $policy->view($user2, $booking);

        $this->assertFalse($result);
    }

    /**
     * Test: admin can view any booking
     */
    public function test_admin_can_view_any_booking(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $customer = User::factory()->create(['role' => 'customer']);
        $booking = Booking::factory()->create(['user_id' => $customer->id]);

        $policy = new BookingPolicy();

        $result = $policy->view($admin, $booking);

        $this->assertTrue($result);
    }
}
