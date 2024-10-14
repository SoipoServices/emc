<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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
            $user = User::where('email',$linkedinUser->email)->first();

            if($user){

                if(empty($user->profile_photo_path)){
                    $url = $linkedinUser->avatar;
                    $user->profile_photo_path = $this->downloadAvatar($url,$linkedinUser->name);
                    Log::debug("Linkedin avatar update",['profile'=>$user->profile_photo_path, 'url'=>$url]);
                }

                $user->oauth_id = $linkedinUser->id;
                $user->oauth_type = 'linkedin';
                $user->save();
                Auth::login($user);

                return redirect()->route('dashboard');
            }else{

                $password = Str::password();

                $user = User::create([
                    'name' => $linkedinUser->name,
                    'email' => $linkedinUser->email,
                    'profile_photo_path' =>  $this->downloadAvatar($linkedinUser->avatar,$linkedinUser->name),
                    'oauth_id' => $linkedinUser->id,
                    'oauth_type' => 'linkedin',
                    'password' =>  Hash::make($password),
                    'email_verified_at' => Carbon::now()->subMinutes(1)
                ]);

                Auth::login($user);

                return redirect()->route('dashboard');
            }

        } catch (Exception $e) {
            return redirect()->route('login')->with('flash', [
                'banner' => 'Something went wrong trying to log you in with linkedin, try again.',
                'bannerStyle' => 'danger',
            ]);;
        }
    }

    protected function downloadAvatar(string $url,string $userName):string{
        $fileName = "profile-photos/".Str::slug($userName);
        $content = file_get_contents($url);
        $size = getimagesize($url);
        $extension = image_type_to_extension($size[2]);
        $fileName .= $extension;
        Storage::disk('public')->put($fileName, $content);
        return $fileName;
    }
}
