<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Role;
use App\Models\LoginLog;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the registration form. If a redirect_to was passed (e.g. from a
     * "register to comment" link on a blog post), remember it in the
     * session so we can send the user straight back there once they've
     * actually logged in.
     */
    public function showRegistrationForm(Request $request)
    {
        if ($request->filled('redirect_to') && is_string($request->query('redirect_to')) && strpos($request->query('redirect_to'), url('/')) === 0) {
            $request->session()->put('post_login_redirect', $request->query('redirect_to'));
        }

        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'country_code' => ['required', 'string', 'max:5'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Anyone who signs up through the public /register form is a subscriber.
        $subscriberRole = Role::where('name', 'subscriber')->first();

        // Strip anything that isn't a digit and drop a leading 0 (e.g. "01812345678"
        // -> "1812345678") before prefixing the selected country code, so the stored
        // number always comes out like the existing "+8801876101515" format.
        $localNumber = ltrim(preg_replace('/\D/', '', $data['phone']), '0');
        $fullPhone = $data['country_code'] . $localNumber;

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $fullPhone,
            'password' => Hash::make($data['password']),
            'role_id' => $subscriberRole->id ?? null,
        ]);
    }

    /**
     * Record the sign-up IP and send the new user to the right place for their role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\Response
     */
    protected function registered(Request $request, $user)
    {
        // Session is about to be wiped below — carry this value over into
        // the fresh session so it survives all the way to the actual login.
        $postLoginRedirect = $request->session()->get('post_login_redirect');

        // Regardless of whether email verification is required, don't leave
        // the new user auto-logged-in — send them to the login page and let
        // them sign in explicitly with their new credentials.
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($postLoginRedirect) {
            $request->session()->put('post_login_redirect', $postLoginRedirect);
        }

        if ($user->needsEmailVerification()) {
            $user->sendVerificationCode();

            $request->session()->put('verify_user_id', $user->id);
            $request->session()->put('verify_context', 'register');

            return redirect()->route('verification.code.form');
        }

        return redirect()->route('login')->with('status', 'Registration successful! Please log in.');
    }
}
