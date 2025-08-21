<?php

namespace App\Policies;

use App\Models\Business;
use App\Models\User;

class BusinessPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Business $event)
    {
        return true;
    }

    public function create(User $user)
    {
        return true; // Allow all authenticated users to create events
    }

    public function update(User $user, Business $business)
    {
        return $user->id === $business->user_id || $user->is_admin;
    }

    public function delete(User $user, Business $business)
    {
        return $user->id === $business->user_id || $user->is_admin;
    }
}
