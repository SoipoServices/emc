<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    /**
     * Display the user's saved library items.
     */
    public function index()
    {
        $user = Auth::user();
        $savedLibraryItems = $user->savedLibraryItems()
            ->orderBy('user_library.created_at', 'desc')
            ->get();

        return view('vendor.zeus.themes.zeus.sky.private.library.index', [
            'savedLibraryItems' => $savedLibraryItems,
            'user' => $user
        ]);
    }

    /**
     * Save a library item to the user's collection.
     */
    public function store(Request $request)
    {
        $request->validate([
            'library_id' => 'required|exists:libraries,id'
        ]);

        $user = Auth::user();
        $libraryId = $request->input('library_id');

        // Check if the item is already saved
        if ($user->savedLibraryItems()->where('library_id', $libraryId)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Item is already in your library'
            ], 400);
        }

        // Save the library item
        $user->savedLibraryItems()->attach($libraryId);

        return response()->json([
            'success' => true,
            'message' => 'Item added to your library'
        ]);
    }

    /**
     * Remove a library item from the user's collection.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'library_id' => 'required|exists:libraries,id'
        ]);

        $user = Auth::user();
        $libraryId = $request->input('library_id');

        // Check if the item exists in user's library
        if (!$user->savedLibraryItems()->where('library_id', $libraryId)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found in your library'
            ], 404);
        }

        // Remove the library item
        $user->savedLibraryItems()->detach($libraryId);

        return response()->json([
            'success' => true,
            'message' => 'Item removed from your library'
        ]);
    }
}
