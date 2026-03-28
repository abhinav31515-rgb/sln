<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateIdentityRequest;
use App\Models\SiteIdentity;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class IdentityController extends Controller
{
    public function edit()
    {
        Gate::authorize('admin');

        $identity = SiteIdentity::all()->keyBy('key');

        return view('admin.identity.edit', compact('identity'));
    }

    public function update(UpdateIdentityRequest $request)
    {
        Gate::authorize('admin');

        foreach ($request->validated()['values'] as $key => $value) {
            SiteIdentity::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Cache::forget('site_identity.all');

        return redirect()->back()->with('status', 'identity-updated');
    }
}
