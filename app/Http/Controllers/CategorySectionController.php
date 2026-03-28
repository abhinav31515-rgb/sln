<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorySectionRequest;
use App\Models\CategorySection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CategorySectionController extends Controller
{
    public function index(): View
    {
        Gate::authorize('admin');

        $sections = CategorySection::with(['category', 'services'])
            ->orderBy('sort_order')
            ->get();

        return view('admin.category-sections.index', compact('sections'));
    }

    public function store(StoreCategorySectionRequest $request): RedirectResponse
    {
        Gate::authorize('admin');

        $data = $request->validated();
        $serviceIds = $data['service_ids'] ?? [];
        unset($data['service_ids']);

        $section = CategorySection::create($data);

        // Sync pivot preserving array index as sort_order
        $pivotData = [];
        foreach (array_values($serviceIds) as $index => $serviceId) {
            $pivotData[$serviceId] = ['sort_order' => $index];
        }
        $section->services()->sync($pivotData);

        Cache::forget('category_sections.visible');

        return redirect()->route('admin.category-sections.index')
            ->with('success', 'Category section created successfully.');
    }

    public function edit(CategorySection $categorySection): View
    {
        Gate::authorize('admin');

        $categorySection->load(['category', 'services']);

        return view('admin.category-sections.edit', compact('categorySection'));
    }

    public function update(StoreCategorySectionRequest $request, CategorySection $categorySection): RedirectResponse
    {
        Gate::authorize('admin');

        $data = $request->validated();
        $serviceIds = $data['service_ids'] ?? [];
        unset($data['service_ids']);

        $categorySection->update($data);

        // Sync pivot preserving array index as sort_order
        $pivotData = [];
        foreach (array_values($serviceIds) as $index => $serviceId) {
            $pivotData[$serviceId] = ['sort_order' => $index];
        }
        $categorySection->services()->sync($pivotData);

        Cache::forget('category_sections.visible');

        return redirect()->route('admin.category-sections.index')
            ->with('success', 'Category section updated successfully.');
    }

    public function destroy(CategorySection $categorySection): RedirectResponse
    {
        Gate::authorize('admin');

        $categorySection->delete();

        Cache::forget('category_sections.visible');

        return redirect()->route('admin.category-sections.index')
            ->with('success', 'Category section deleted successfully.');
    }

    public function reorder(Request $request): JsonResponse
    {
        Gate::authorize('admin');

        $request->validate([
            'ids'   => ['required', 'array'],
            'ids.*' => ['integer', 'exists:category_sections,id'],
        ]);

        DB::transaction(function () use ($request) {
            foreach (array_values($request->ids) as $index => $id) {
                CategorySection::where('id', $id)->update(['sort_order' => $index]);
            }
        });

        Cache::forget('category_sections.visible');

        return response()->json(['success' => true]);
    }
}
