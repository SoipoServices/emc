<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = $request->route('user');
        $authenticatedUser = $request->user();

        // If there's a user parameter in the route, ensure it matches the authenticated user
        if ($userId && $authenticatedUser) {
            // Handle both string ID and User model instances
            $userIdToCheck = is_object($userId) ? $userId->id : $userId;

            if ($userIdToCheck != $authenticatedUser->id) {
                abort(403, 'Unauthorized access to user resources.');
            }
        }

        return $next($request);
    }
}
