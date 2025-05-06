<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Support\Facades\Auth)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and is an admin
        // If not, abort with a 403 status code
        if (! Auth::check() || ! Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
