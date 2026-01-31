<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AutoLoginLocal
{
    /**
     * If running in local environment and no user is authenticated,
     * try to log in the demo admin user `admin@example.com`.
     */
    public function handle(Request $request, Closure $next)
    {
        if (app()->environment('local') && !Auth::check()) {
            $user = User::where('email', 'admin@example.com')->first();
            if ($user) {
                Auth::login($user);
                // regenerate session to be safe
                $request->session()->regenerate();
            }
        }

        return $next($request);
    }
}
