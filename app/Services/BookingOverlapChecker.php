<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class BookingOverlapChecker
{
    /**
     * Check whether a therapist has an overlapping booking.
     *
     * Two time ranges [A, B] and [C, D] overlap when A < D AND C < B.
     */
    public function hasOverlap(
        int $therapistId,
        string $date,
        string $startTime,
        string $endTime,
        ?int $excludeBookingId = null
    ): bool {
        $query = DB::table('bookings')
            ->where('therapist_id', $therapistId)
            ->whereRaw('DATE(appointment_date) = ?', [$date])
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('start_time', '<', $endTime)
            ->where('end_time', '>', $startTime);

        if ($excludeBookingId !== null) {
            $query->where('id', '!=', $excludeBookingId);
        }

        return $query->exists();
    }
}
