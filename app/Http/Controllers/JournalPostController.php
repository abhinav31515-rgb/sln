<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJournalPostRequest;
use App\Models\JournalPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class JournalPostController extends Controller
{
    public function index(): View
    {
        Gate::authorize('admin');

        $posts = JournalPost::latest('published_at')->paginate(15);

        return view('journal.index', compact('posts'));
    }

    public function store(StoreJournalPostRequest $request): RedirectResponse
    {
        Gate::authorize('admin');

        JournalPost::create($request->validated());

        return redirect()->route('journal.index')
            ->with('success', 'Journal post created successfully.');
    }

    public function update(StoreJournalPostRequest $request, JournalPost $journalPost): RedirectResponse
    {
        Gate::authorize('admin');

        $journalPost->update($request->validated());

        return redirect()->route('journal.index')
            ->with('success', 'Journal post updated successfully.');
    }

    public function destroy(JournalPost $journalPost): RedirectResponse
    {
        Gate::authorize('admin');

        $journalPost->delete();

        return redirect()->route('journal.index')
            ->with('success', 'Journal post deleted successfully.');
    }
}
