<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginLog;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the login form. If a redirect_to was passed (e.g. from a
     * "log in to comment" link on a blog post), remember it in the
     * session so we can send the user straight back there once they're
     * actually authenticated.
     */
    public function showLoginForm(Request $request)
    {
        if ($request->filled('redirect_to') && $this->isSafeRedirect($request->query('redirect_to'))) {
            $request->session()->put('post_login_redirect', $request->query('redirect_to'));
        }

        return view('auth.login');
    }

    /**
     * Only allow redirecting back to a URL on this same site — never to
     * an arbitrary external URL an attacker could plant in the link.
     */
    protected function isSafeRedirect($url)
    {
        return is_string($url) && strpos($url, url('/')) === 0;
    }

    /**
     * Record the login IP and send the user to the right place for their role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        // A deactivated account keeps its password and its data, but must
        // not be able to get in until an admin switches it back on.
        if (! $user->isActive()) {
            $this->guard()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'email' => 'This account has been deactivated. Please contact an administrator.',
            ]);
        }

        if ($user->needsEmailVerification()) {
            // Session is about to be wiped below — carry this value over
            // into the fresh session so it survives to the actual login.
            $postLoginRedirect = $request->session()->get('post_login_redirect');

            // AuthenticatesUsers already logged the user in above — log them
            // straight back out and send them to the code-entry screen.
            $this->guard()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $user->sendVerificationCode();

            $request->session()->put('verify_user_id', $user->id);
            $request->session()->put('verify_context', 'login');
            if ($postLoginRedirect) {
                $request->session()->put('post_login_redirect', $postLoginRedirect);
            }

            return redirect()->route('verification.code.form');
        }

        LoginLog::create([
            'user_id' => $user->id,
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 255),
            'logged_in_at' => now(),
        ]);

        $user->forceFill([
            'last_login_at' => now(),
            'last_login_ip' => $request->ip(),
        ])->save();

        if ($redirect = $request->session()->pull('post_login_redirect')) {
            return redirect($redirect);
        }

        if ($user->isAuthor()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return redirect()->route('profile.show');
    }
}
