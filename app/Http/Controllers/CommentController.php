<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment = new Comment($validated);
        $comment->user_id = $request->user()->id;
        $comment->post_id = $post->id;
        $comment->save();

        return redirect()->back();
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment->update($validated);

        return redirect()->back();
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->back();
    }
}
