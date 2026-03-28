<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Cache::remember('services.all', 3600, function () {
            return Service::with('category')->get();
        });

        return view('services.index', compact('services'));
    }

    public function store(StoreServiceRequest $request): RedirectResponse
    {
        Gate::authorize('admin');

        Service::create($request->validated());

        Cache::forget('services.all');
        Cache::forget('category_sections.visible');

        return redirect()->route('services.index')
            ->with('success', 'Service created successfully.');
    }

    public function update(StoreServiceRequest $request, Service $service): RedirectResponse
    {
        Gate::authorize('admin');

        $service->update($request->validated());

        Cache::forget('services.all');
        Cache::forget('category_sections.visible');

        return redirect()->route('services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        Gate::authorize('admin');

        $hasActiveBookings = $service->bookings()
            ->whereNotIn('status', ['completed', 'cancelled'])
            ->exists();

        if ($hasActiveBookings) {
            return back()->withErrors([
                'service' => 'Cannot delete a service with active bookings.',
            ]);
        }

        $service->delete();

        Cache::forget('services.all');
        Cache::forget('category_sections.visible');

        return redirect()->route('services.index')
            ->with('success', 'Service deleted successfully.');
    }
}
