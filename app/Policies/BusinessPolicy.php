<?php

namespace App\Policies;

use App\Models\Business;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessPolicy
{
    use HandlesAuthorization;

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
        return $user->id === $business->user_id;
    }

    public function delete(User $user, Business $business)
    {
        return $user->id === $business->user_id;
    }
}
