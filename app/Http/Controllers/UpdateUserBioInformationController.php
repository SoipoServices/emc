<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\ProfileInformationUpdatedResponse;

class UpdateUserBioInformationController extends Controller
{

    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function __invoke(Request $request )
    {
        $user = auth()->user();

        $input = $request->validateWithBag('updateBioInformation',
            [
                'bio' => ['required', 'string'],
                'position' => ['required', 'string', 'max:255'],
                'linkedin_profile_url' => ['nullable', 'url', 'max:255'],
                'site_url' => ['nullable', 'url', 'max:255'],
                'facebook_url' => ['nullable', 'url', 'max:255'],
                'twitter_url' => ['nullable', 'url', 'max:255'],
                'youtube_url' => ['nullable', 'url', 'max:255'],
            ]
        );


        $user->forceFill([
            'bio' => $input['bio'],
            'position' => $input['position'],
            'linkedin_profile_url' => $input['linkedin_profile_url'],
            'site_url' => $input['site_url'],
            'facebook_url' => $input['facebook_url'],
            'twitter_url' => $input['twitter_url'],
            'youtube_url' => $input['youtube_url'],
        ])->save();

        return app(ProfileInformationUpdatedResponse::class);
    }
}
