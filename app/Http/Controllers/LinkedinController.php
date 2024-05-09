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
        return Socialite::driver('linkedin')->redirect();
    }

    public function linkedinCallback()
    {
        try {

            $user = Socialite::driver('linkedin')->user();

            dd($user);
            $linkedinUser = User::where('oauth_id', $user->id)->first();

            if($linkedinUser){

                Auth::login($linkedinUser);

                return redirect('/dashboard');

            }else{
                $user = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'oauth_id' => $user->id,
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
