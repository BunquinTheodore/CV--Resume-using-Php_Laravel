<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsLoggedIn
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        if (!session('user_logged_in') && !Auth::check()) {
            return redirect()->route('login.form');
        }

        return $next($request);
    }
}
