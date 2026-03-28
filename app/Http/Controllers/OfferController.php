<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfferRequest;
use App\Models\Offer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class OfferController extends Controller
{
    public function index(): View
    {
        $offers = Cache::remember('offers.active', 1800, function () {
            return Offer::where('valid_until', '>', now())->get();
        });

        return view('offers.index', compact('offers'));
    }

    public function store(StoreOfferRequest $request): RedirectResponse
    {
        Gate::authorize('admin');

        Offer::create($request->validated());

        Cache::forget('offers.active');

        return redirect()->route('offers.index')
            ->with('success', 'Offer created successfully.');
    }

    public function update(StoreOfferRequest $request, Offer $offer): RedirectResponse
    {
        Gate::authorize('admin');

        $offer->update($request->validated());

        Cache::forget('offers.active');

        return redirect()->route('offers.index')
            ->with('success', 'Offer updated successfully.');
    }

    public function destroy(Offer $offer): RedirectResponse
    {
        Gate::authorize('admin');

        $offer->delete();

        Cache::forget('offers.active');

        return redirect()->route('offers.index')
            ->with('success', 'Offer deleted successfully.');
    }
}
