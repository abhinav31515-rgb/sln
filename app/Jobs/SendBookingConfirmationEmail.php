<?php

namespace App\Jobs;

use App\Mail\BookingConfirmed;
use App\Models\Booking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendBookingConfirmationEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Booking $booking
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Load required relationships
        $this->booking->loadMissing(['service', 'therapist.user', 'user']);

        Mail::to($this->booking->user->email)
            ->send(new BookingConfirmed($this->booking));
    }
}
