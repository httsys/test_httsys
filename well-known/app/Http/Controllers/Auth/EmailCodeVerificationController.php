<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginLog;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailCodeVerificationController extends Controller
{
    const MAX_RESENDS = 3;
    const RESEND_COOLDOWN_MINUTES = 2;

    /**
     * Show the "enter your code" form for the user currently pending
     * verification (tracked in the session, not via auth — the user is
     * deliberately logged out while this step is pending).
     */
    public function showForm(Request $request)
    {
        $user = $this->pendingUser($request);

        if (! $user) {
            return redirect()->route('login');
        }

        $secondsRemaining = 0;
        if ($user->verification_sent_at) {
            $secondsRemaining = max(0, self::RESEND_COOLDOWN_MINUTES * 60 - now()->diffInSeconds($user->verification_sent_at));
        }

        return view('auth.verify-code', [
            'email' => $user->email,
            'resendsLeft' => max(0, self::MAX_RESENDS - $user->verification_resend_count),
            'secondsRemaining' => $secondsRemaining,
        ]);
    }

    /**
     * Check the submitted code and, if correct, log the user in.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $user = $this->pendingUser($request);

        if (! $user) {
            return redirect()->route('login');
        }

        $codeMatches = $user->verification_code && hash_equals($user->verification_code, $request->code);
        $notExpired = $user->verification_code_expires_at && now()->lessThanOrEqualTo($user->verification_code_expires_at);

        if (! $codeMatches || ! $notExpired) {
            return back()->withErrors(['code' => 'The code you entered is incorrect or has expired.']);
        }

        $user->forceFill([
            'email_verified_at' => now(),
            'verification_code' => null,
            'verification_code_expires_at' => null,
            'verification_sent_at' => null,
            'verification_resend_count' => 0,
        ])->save();

        $context = $request->session()->get('verify_context', 'login');

        $request->session()->forget('verify_user_id');
        $request->session()->forget('verify_context');

        if ($context === 'register') {
            // Match the no-verification-needed registration flow: never
            // auto-login a brand new account, always require an explicit
            // login afterwards.
            return redirect()->route('login')->with('status', 'Your email has been verified! Please log in.');
        }

        Auth::login($user);

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

    /**
     * Send a fresh code, subject to the 2-minute cooldown and 3-resend cap.
     */
    public function resend(Request $request)
    {
        $user = $this->pendingUser($request);

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->verification_resend_count >= self::MAX_RESENDS) {
            return back()->withErrors(['code' => 'You have reached the maximum number of code resends. Please try registering again later or contact support.']);
        }

        if ($user->verification_sent_at && now()->lessThan($user->verification_sent_at->addMinutes(self::RESEND_COOLDOWN_MINUTES))) {
            return back()->withErrors(['code' => 'Please wait before requesting another code.']);
        }

        $user->sendVerificationCode();
        $user->increment('verification_resend_count');

        return back()->with('status', 'A new verification code has been sent to your email.');
    }

    protected function pendingUser(Request $request)
    {
        $userId = $request->session()->get('verify_user_id');

        if (! $userId) {
            return null;
        }

        return User::find($userId);
    }
}
