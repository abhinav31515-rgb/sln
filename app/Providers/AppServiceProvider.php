<?php

namespace App\Providers;

use App\View\Composers\PageSeoComposer;
use App\View\Composers\SiteIdentityComposer;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Authorization
        Gate::define('admin', fn ($user) => $user->role === 'admin');

        // Warn when debug mode is on in production
        if (config('app.debug') && config('app.env') === 'production') {
            Log::critical('APP_DEBUG is enabled in a production environment. Disable it immediately.');
        }

        // Rate limiters
        RateLimiter::for('login', fn (Request $request) =>
            Limit::perMinute(5)->by($request->ip())
        );

        RateLimiter::for('forgot-password', fn (Request $request) =>
            Limit::perMinute(3)->by($request->ip())
        );

        // View composers
        View::composer('*', SiteIdentityComposer::class);
        View::composer('*', PageSeoComposer::class);
    }
}
