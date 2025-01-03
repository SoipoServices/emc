<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmails;
use App\Models\Post;
use App\Models\User;
use App\Notifications\NewPostCreated;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Embed\Embed;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;
    const PAGINATION = 10;


    public function index()
    {
        $posts = Post::with(['user', 'reactions'])
            ->withCount('comments')
            ->latest() // This orders by created_at in descending order
            ->paginate(self::PAGINATION);

        $posts->map(function ($post) {
            $post->link_preview = [
                'url' => $post->link_url,
                'title' => $post->link_title,
                'description' => $post->link_description,
                'image' => $post->link_image,
            ];
            return $post;
        });

        return Inertia::render('Billboard/List', [
            'posts' => $posts,
            'can' => [
                'createPost' => auth()->user()->can('create', Post::class),
            ],
        ]);
    }

    public function create()
    {
        return Inertia::render('Billboard/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $post = new Post($validated);
        $post->user_id = $request->user()->id;

        // Extract link metadata
        $urls = $this->extractUrls($validated['body']);
        if (!empty($urls)) {
            $embed = new Embed();
            $info = $embed->get($urls[0]);

            $post->link_url = $urls[0];
            $post->link_title = $info->title;
            $post->link_description = $info->description;
            $post->link_image = $info->image;
        }

        $users = User::where('id', '!=', $request->user()->id)->get(); // Exclude the event creator
        foreach ($users as $user) {
            $user->notify(new NewPostCreated($post));
        }

        $post->save();

        return redirect()->route('billboard.index')->with('flash', [
            'banner' => 'Post created successfully!',
            'bannerStyle' => 'success',
        ]);
    }

    public function show(Post $post)
    {
        $post->load(['user', 'comments.user', 'reactions']);
        $post->loadCount(['reactions as reactions_count' => function ($query) {
            $query->select(DB::raw('count(distinct(user_id))'));
        }]);
       $post->link_preview = [
            'url' => $post->link_url,
            'title' => $post->link_title,
            'description' => $post->link_description,
            'image' => $post->link_image,
        ];

        return Inertia::render('Billboard/Show', [
            'post' => $post,
            'can' => [
                'update' => auth()->user()->can('update', $post),
                'delete' => auth()->user()->can('delete', $post),
            ],
        ]);
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return Inertia::render('Billboard/Edit', [
            'post' => $post,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $post->update($validated);

        // Re-extract link metadata
        $urls = $this->extractUrls($validated['body']);
        if (!empty($urls)) {
            $embed = new Embed();
            $info = $embed->get($urls[0]);

            $post->link_url = $urls[0];
            $post->link_title = $info->title;
            $post->link_description = $info->description;
            $post->link_image = $info->image;
        } else {
            $post->link_url = null;
            $post->link_title = null;
            $post->link_description = null;
            $post->link_image = null;
        }

        $post->save();

        return redirect()->route('billboard.index')->with('flash', [
            'banner' => 'Post updated successfully!',
            'bannerStyle' => 'success',
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('update', $post);

        $post->delete();

        return redirect()->route('billboard.index')->with('flash', [
            'banner' => 'Post deleted successfully!',
            'bannerStyle' => 'success',
        ]);
    }

    private function extractUrls($text)
    {
        preg_match_all('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', $text, $matches);
        return $matches[0];
    }
}
