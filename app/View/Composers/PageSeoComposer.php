<?php

namespace App\View\Composers;

use App\Models\PageSeo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class PageSeoComposer
{
    public function compose(View $view): void
    {
        $routeName = Route::currentRouteName();

        if (!$routeName) {
            $view->with('seo', null);
            return;
        }

        $seo = Cache::remember("seo.{$routeName}", 3600, function () use ($routeName) {
            return PageSeo::where('route_name', $routeName)->first();
        });

        $view->with('seo', $seo);
    }
}
