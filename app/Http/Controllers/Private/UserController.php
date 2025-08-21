<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        // Check if user is visible
        if (!$user->is_visible) {
            abort(404);
        }

        return view('zeus::themes.zeus.sky.private.user-show', [
            'user' => $user,
            'skyTheme' => 'zeus::themes.zeus.sky'
        ]);
    }
}
