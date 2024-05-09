<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

use function Laravel\Prompts\error;

class LinkedinController extends Controller
{
    public function linkedinRedirect()
    {
        return Socialite::driver('linkedin-openid')->redirect();
    }

    public function linkedinCallback()
    {
        try {

            $linkedinUser = Socialite::driver('linkedin-openid')->user();

            $user = User::where('oauth_id', $linkedinUser->id)->first();
            if($user->profile_photo_path){
                $user->profile_photo_path = $linkedinUser->avatar;
            }
            if($user){

                Auth::login($user);

                return redirect('/dashboard');

            }else{
                $user = User::create([
                    'name' => $linkedinUser->name,
                    'email' => $linkedinUser->email,
                    'oauth_id' => $linkedinUser->id,
                    'profile_photo_path' => $linkedinUser->avatar,
                    'oauth_type' => 'linkedin',
                    'password' => encrypt('admin12345')
                ]);

                Auth::login($user);

                return redirect('/dashboard');
            }

        } catch (Exception $e) {
            return error(403,$e->getMessage());
        }
    }
}
