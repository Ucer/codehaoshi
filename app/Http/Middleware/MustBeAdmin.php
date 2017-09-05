<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class MustBeAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Determine whether the current user is an administrator
        if (Auth::guest() || (Auth::user()->is_admin != 'yes')) {
            abort(403);
        }
        return $next($request);

    }
}
