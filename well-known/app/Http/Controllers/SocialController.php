<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\LoginLog;
use Validator;
use Socialite;
use Exception;
use Auth;

class SocialController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook(Request $request)
    {
        try {
    
            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();
     
            if($isUser){
                Auth::login($isUser);
                $loggedInUser = $isUser;
            }else{
                $subscriberRole = \App\Models\Role::where('name', 'subscriber')->first();

                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'role_id' => $subscriberRole->id ?? null,
                    'password' => encrypt('admin@123')
                ]);
    
                Auth::login($createUser);
                $loggedInUser = $createUser;
            }

            LoginLog::create([
                'user_id' => $loggedInUser->id,
                'ip_address' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 255),
                'logged_in_at' => now(),
            ]);

            $loggedInUser->forceFill([
                'last_login_at' => now(),
                'last_login_ip' => $request->ip(),
            ])->save();

            if ($loggedInUser->isAuthor()) {
                return redirect('/dashboard');
            }

            return redirect()->route('profile.show');
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
