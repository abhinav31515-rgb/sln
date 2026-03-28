<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Cache::remember('products.all', 3600, function () {
            return Product::all();
        });

        return view('products.index', compact('products'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        Gate::authorize('admin');

        DB::transaction(function () use ($request) {
            Product::create($request->validated());
        });

        Cache::forget('products.all');

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function update(StoreProductRequest $request, Product $product): RedirectResponse
    {
        Gate::authorize('admin');

        DB::transaction(function () use ($request, $product) {
            $product->update($request->validated());
        });

        Cache::forget('products.all');

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        Gate::authorize('admin');

        $product->delete();

        Cache::forget('products.all');

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
