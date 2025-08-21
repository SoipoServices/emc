<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ImpersonationController extends Controller
{
    /**
     * Start impersonating a user.
     */
    public function start(Request $request, User $user)
    {
        // Check if the current user can impersonate
        if (!$request->user()->canImpersonate()) {
            abort(403, 'You do not have permission to impersonate users.');
        }

        // Check if the target user can be impersonated
        if (!$user->canBeImpersonated()) {
            abort(403, 'This user cannot be impersonated.');
        }

        // Start impersonation
        $request->user()->impersonate($user);

        return redirect()->route('dashboard')->with('success', "You are now impersonating {$user->name}");
    }

    /**
     * Stop impersonating and return to original user.
     */
    public function stop(Request $request)
    {
        if (!$request->user()->isImpersonated()) {
            return redirect()->route('dashboard');
        }
        
        $request->user()->leaveImpersonation();

        return redirect()->route('dashboard')->with('success', 'You have stopped impersonating and returned to your account.');
    }
}
