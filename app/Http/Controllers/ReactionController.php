<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;
use App\Notifications\PostInteractionNotification;

class ReactionController extends Controller
{
    public function toggle(Request $request, Post $post)
    {
        $validated = $request->validate([
            'emoji' => 'required|string',
        ]);

        $reaction = $post->reactions()->where('user_id', $request->user()->id)->first();

        if ($reaction) {
            if ($reaction->emoji === $validated['emoji']) {
                $reaction->delete();
            } else {
                $reaction->update($validated);
            }
        } else {
            $reaction = new Reaction($validated);
            $reaction->user_id = $request->user()->id;
            $post->reactions()->save($reaction);

            // Send notification to post author
            if ($post->user->id !== $request->user()->id) {
                $post->user->notify(new PostInteractionNotification($post, $request->user(), 'reaction'));
            }
        }

        return back();
    }
}
