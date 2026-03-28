<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePageSeoRequest;
use App\Models\PageSeo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class SeoController extends Controller
{
    public function index(): View
    {
        Gate::authorize('admin');

        $seoRecords = PageSeo::orderBy('route_name')->get();

        return view('admin.seo.index', compact('seoRecords'));
    }

    public function edit(string $routeName): View
    {
        Gate::authorize('admin');

        $seo = PageSeo::where('route_name', $routeName)->firstOrFail();

        return view('admin.seo.edit', compact('seo'));
    }

    public function update(UpdatePageSeoRequest $request, string $routeName): RedirectResponse
    {
        Gate::authorize('admin');

        $seo = PageSeo::where('route_name', $routeName)->firstOrFail();

        $data = $request->validated();

        // Decode json_ld string to array for storage
        if (isset($data['json_ld']) && is_string($data['json_ld'])) {
            $data['json_ld'] = json_decode($data['json_ld'], true);
        }

        $data['updated_at'] = now();

        $seo->update($data);

        Cache::forget("seo.{$routeName}");

        return redirect()->route('admin.seo.index')
            ->with('success', 'SEO record updated successfully.');
    }
}
