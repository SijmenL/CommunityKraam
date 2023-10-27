<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsActive
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Check the 'active' status of the user
            if ($user->active) {
                return $next($request); // User is active, continue to the next middleware or route
            }
        }

        // If the user is not active, you can redirect them to a specific route or return a response.
        return redirect('/banned');
    }
}
