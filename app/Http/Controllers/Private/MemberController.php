<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\Controller;
use App\Models\User;

class MemberController extends Controller
{
    /**
     * Display the specified user.
     */
    public function __invoke(User $user)
    {
        // Check if user is visible
        if (! $user->is_visible) {
            abort(404);
        }

        return view('zeus::themes.zeus.sky.private.member', [
            'user' => $user,
            'skyTheme' => 'zeus::themes.zeus.sky',
        ]);
    }
}
