<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthenticateStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->user()->is_allow_login) {
            return redirect()->route('auth.logout');
        }
        
        if (auth()->check() && auth()->user()->user_type == config('settings.user_type_id.student') ) {
            return $next($request);
        }
        abort(401, 'This action is unauthorized.');
    }
}
