<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function index()
    {
        $threads = Thread::with(['user', 'comments'])
            ->withCount(['comments', 'reactions'])
            ->latest()
            ->paginate(15);

        return view('forum.index', compact('threads'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $thread = $request->user()->threads()->create($validated);

        return redirect()->route('forum.threads.show', $thread)
            ->with('success', 'Thread created successfully');
    }

    public function show(Thread $thread)
    {
        $thread->load(['user', 'comments.user', 'comments.reactions', 'reactions']);
        return view('forum.show', compact('thread'));
    }
}
