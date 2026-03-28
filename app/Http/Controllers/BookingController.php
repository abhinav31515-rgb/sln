<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Jobs\SendBookingConfirmationEmail;
use App\Models\Booking;
use App\Models\Service;
use App\Services\BookingOverlapChecker;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(Request $request): View
    {
        $userId = Auth::id();
        $page   = $request->get('page', 1);

        $bookings = Cache::remember("bookings.user.{$userId}.page.{$page}", 300, function () use ($userId) {
            return Booking::with(['service', 'therapist.user'])
                ->where('user_id', $userId)
                ->latest('appointment_date')
                ->paginate(15);
        });

        return view('bookings.index', compact('bookings'));
    }

    public function store(StoreBookingRequest $request, BookingOverlapChecker $checker): RedirectResponse
    {
        $data    = $request->validated();
        $service = Service::findOrFail($data['service_id']);

        $startTime = $data['start_time'];
        $endTime   = Carbon::createFromFormat('H:i', $startTime)
            ->addMinutes($service->duration_minutes)
            ->format('H:i');

        if ($checker->hasOverlap($data['therapist_id'], $data['appointment_date'], $startTime, $endTime)) {
            return back()->withErrors([
                'therapist_id' => 'The selected therapist is not available at this time.',
            ])->withInput();
        }

        $booking = Booking::create([
            'user_id'          => Auth::id(),
            'service_id'       => $data['service_id'],
            'therapist_id'     => $data['therapist_id'],
            'appointment_date' => $data['appointment_date'],
            'start_time'       => $startTime,
            'end_time'         => $endTime,
            'status'           => 'pending',
            'total_price'      => $service->price,
        ]);

        // Invalidate user booking cache (all pages)
        $this->clearUserBookingCache(Auth::id());

        SendBookingConfirmationEmail::dispatch($booking);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking created successfully.');
    }

    public function show(Booking $booking): View
    {
        $this->authorize('view', $booking);

        $booking->loadMissing(['service', 'therapist.user']);

        return view('bookings.show', compact('booking'));
    }

    public function destroy(Booking $booking): RedirectResponse
    {
        $this->authorize('delete', $booking);

        $booking->update(['status' => 'cancelled']);

        $this->clearUserBookingCache($booking->user_id);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking cancelled successfully.');
    }

    private function clearUserBookingCache(int $userId): void
    {
        // Bust pages 1–10 as a pragmatic cache invalidation strategy
        for ($page = 1; $page <= 10; $page++) {
            Cache::forget("bookings.user.{$userId}.page.{$page}");
        }
    }
}
