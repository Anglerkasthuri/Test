<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission='')
    { 
        
        $permissions = explode("|", $permission);
        if ($permission && auth()->check() && (auth()->user()->hasAnyPermission($permissions) || auth()->user()->is_super_admin) ) {
            return $next($request);
        }
        return redirect()->route('dashboard');
        // abort(401, 'This action is unauthorized.');
    }
}
