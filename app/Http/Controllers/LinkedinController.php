<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
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

            if($user){

                if(is_null($user->profile_photo_path)){
                    $url = $linkedinUser->avatar;
                    $user->profile_photo_path = $this->downloadAvatar($url);
                }

                Auth::login($user);

                return redirect()->route('dashboard');
            }else{

                $password = Str::password();

                $user = User::create([
                    'name' => $linkedinUser->name,
                    'email' => $linkedinUser->email,
                    'oauth_id' => $linkedinUser->id,
                    'profile_photo_path' =>  $this->downloadAvatar($linkedinUser->avatar),
                    'oauth_type' => 'linkedin',
                    'password' =>  Hash::make($password)
                ]);

                Auth::login($user);

                return redirect()->route('dashboard');
            }

        } catch (Exception $e) {
            return abort(403,$e->getMessage());
        }
    }

    protected function downloadAvatar(string $url):string{
        $fileName = "profile-photos/".basename($url);
        Storage::disk('public')->put($fileName, file_get_contents($url));
        return $fileName;
    }
}
