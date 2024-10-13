<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function toggle(Request $request, Post $post)
    {
        $validated = $request->validate([
            'emoji' => 'required|string',
        ]);

        $reaction = $post->reactions()
            ->where('user_id', $request->user()->id)
            ->where('emoji', $validated['emoji'])
            ->first();

        if ($reaction) {
            $reaction->delete();
        } else {
            $post->reactions()->create([
                'user_id' => $request->user()->id,
                'emoji' => $validated['emoji'],
            ]);
        }

        return redirect()->back();
    }
}
