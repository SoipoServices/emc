<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Event $event)
    {
        return true;
    }

    public function create(User $user)
    {
        return true; // Allow all authenticated users to create events
    }

    public function update(User $user, Event $event)
    {
        return $user->id === $event->user_id || $user->is_admin;
    }

    public function delete(User $user, Event $event)
    {
        return $user->id === $event->user_id || $user->is_admin;
    }
}
