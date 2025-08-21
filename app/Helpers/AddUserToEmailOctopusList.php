<?php

namespace App\Helpers;

use App\Models\User;
use GoranPopovic\EmailOctopus\Facades\EmailOctopus;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class AddUserToEmailOctopusList extends Command
{
    public static function addContact(User $user): ?string
    {

        $first_last_name = Str::of($user->name)->explode(' ');

        $response = EmailOctopus::lists()->createContact(config('emc.default_email_list'), [
            'email_address' => $user->email, // required
            'fields' => [ // optional
                'FirstName' => Arr::get($first_last_name, 0),
                'LastName' => Arr::get($first_last_name, 1),
            ],
            'tags' => [ // optional
                'member',
            ],
            'status' => 'SUBSCRIBED', // optional
        ]);

        return Arr::get($response, 'status'); // SUBSCRIB
    }
}
