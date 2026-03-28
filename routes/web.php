<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategorySectionController;
use App\Http\Controllers\IdentityController;
use App\Http\Controllers\JournalPostController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

// Homepage - loads category sections from cache with eager-loaded relationships
Route::get('/', function () {
    $categorySections = Cache::remember('category_sections.visible', 3600, function () {
        return \App\Models\CategorySection::where('is_visible', true)
            ->orderBy('sort_order')
            ->with(['category', 'services'])
            ->get();
    });

    return view('welcome', [
        'categorySections' => $categorySections,
        'services' => \App\Models\Service::all(),
        'therapists' => \App\Models\Therapist::with('user')->get(),
        'products' => \App\Models\Product::all(),
        'offers' => \App\Models\Offer::where('valid_until', '>=', now())->get(),
    ]);
})->name('home');

// Public resource routes - index only
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
Route::get('/journal', [JournalPostController::class, 'index'])->name('journal.index');

// Admin-only resource routes for services, products, offers, journal
Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::post('/offers', [OfferController::class, 'store'])->name('offers.store');
    Route::put('/offers/{offer}', [OfferController::class, 'update'])->name('offers.update');
    Route::delete('/offers/{offer}', [OfferController::class, 'destroy'])->name('offers.destroy');

    Route::post('/journal', [JournalPostController::class, 'store'])->name('journal.store');
    Route::put('/journal/{journalPost}', [JournalPostController::class, 'update'])->name('journal.update');
    Route::delete('/journal/{journalPost}', [JournalPostController::class, 'destroy'])->name('journal.destroy');
});

// Authenticated booking routes
Route::middleware('auth')->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

// Admin route group
Route::prefix('admin')->middleware(['auth', 'can:admin'])->group(function () {
    // Site Identity management
    Route::get('/identity', [IdentityController::class, 'edit'])->name('admin.identity.edit');
    Route::post('/identity', [IdentityController::class, 'update'])->name('admin.identity.update');

    // SEO management
    Route::get('/seo', [SeoController::class, 'index'])->name('admin.seo.index');
    Route::get('/seo/{routeName}', [SeoController::class, 'edit'])->name('admin.seo.edit');
    Route::put('/seo/{routeName}', [SeoController::class, 'update'])->name('admin.seo.update');

    // Category Sections management
    Route::get('/category-sections', [CategorySectionController::class, 'index'])->name('admin.category-sections.index');
    Route::post('/category-sections', [CategorySectionController::class, 'store'])->name('admin.category-sections.store');
    Route::get('/category-sections/{categorySection}', [CategorySectionController::class, 'edit'])->name('admin.category-sections.edit');
    Route::put('/category-sections/{categorySection}', [CategorySectionController::class, 'update'])->name('admin.category-sections.update');
    Route::delete('/category-sections/{categorySection}', [CategorySectionController::class, 'destroy'])->name('admin.category-sections.destroy');
    Route::post('/category-sections/reorder', [CategorySectionController::class, 'reorder'])->name('admin.category-sections.reorder');
});

// Sitemap and LLM-optimized routes
Route::get('/sitemap.xml', function () {
    $pages = \App\Models\PageSeo::all();
    
    return response()->view('sitemap', ['pages' => $pages])
        ->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::get('/llms.txt', function () {
    $identity = Cache::remember('site_identity.all', 3600, function () {
        return \App\Models\SiteIdentity::all()->pluck('value', 'key');
    });
    
    $homeSeo = Cache::remember('seo.home', 3600, function () {
        return \App\Models\PageSeo::where('route_name', 'home')->first();
    });
    
    return response()->view('llms', [
        'identity' => $identity,
        'seo' => $homeSeo,
    ])->header('Content-Type', 'text/plain');
})->name('llms');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
