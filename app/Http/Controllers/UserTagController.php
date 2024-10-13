<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Tags\Tag;

class UserTagController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'tags' => 'required|string',
        ]);

        $user = Auth::user();
        $tagNames = array_map('trim', explode(',', $request->tags));

        // Sync the tags
        $tags = collect($tagNames)->map(function ($tagName) {
            return Tag::findOrCreate($tagName);
        });

        $user->syncTags($tags);

        return back()->with('flash', [
            'banner' => 'Tags updated successfully!',
            'bannerStyle' => 'success',
        ]);
    }
}
