<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use App\Models\Comment;
use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function toggle(Request $request)
    {
        $validated = $request->validate([
            'reactable_type' => 'required|in:thread,comment',
            'reactable_id' => 'required|integer',
            'type' => 'required|in:like,love'
        ]);

        $model = $validated['reactable_type'] === 'thread'
            ? Thread::findOrFail($validated['reactable_id'])
            : Comment::findOrFail($validated['reactable_id']);

        $existing = $model->reactions()
            ->where('user_id', $request->user()->id)
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['status' => 'removed']);
        }

        $model->reactions()->create([
            'user_id' => $request->user()->id,
            'type' => $validated['type']
        ]);

        return response()->json(['status' => 'added']);
    }
}
