<?php

namespace App\View\Composers;

use App\Models\SiteIdentity;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SiteIdentityComposer
{
    public function compose(View $view): void
    {
        $identity = Cache::remember('site_identity.all', 3600, function () {
            return SiteIdentity::all()->pluck('value', 'key');
        });

        $view->with('identity', $identity);
    }
}
