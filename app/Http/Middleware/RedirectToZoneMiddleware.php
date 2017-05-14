<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

use App\User;

class RedirectToZoneMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {

            if (Auth::user()->level === User::LEVEL_ADMIN) {
                return redirect()->route('admin.index');
            } elseif (Auth::user()->level === User::LEVEL_USER) {
                return redirect()->route('zone.index');
            }
        }

        return $next($request);
    }
}
