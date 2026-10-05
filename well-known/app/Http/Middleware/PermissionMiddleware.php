<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
{
    /**
     * Usage in routes:  ->middleware('permission:shop.products.manage')
     *
     * Several keys can be passed and any one of them is enough:
     *   ->middleware('permission:orders.view,orders.update_status')
     */
    public function handle($request, Closure $next, ...$permissions)
    {
        if (! Auth::check()) {
            return redirect('404');
        }

        $user = Auth::user();

        if (! $user->isActive()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->withErrors(['email' => 'This account has been deactivated. Please contact an administrator.']);
        }

        foreach ($permissions as $permission) {
            if ($user->hasPermission($permission)) {
                return $next($request);
            }
        }

        return redirect('404');
    }
}
