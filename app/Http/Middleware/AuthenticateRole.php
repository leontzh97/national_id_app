<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class AuthenticateRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param array $role
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {
        if (!Auth::check())
          return redirect()->route('login');

        if(is_array($role)){
          foreach($role as $r){
            if(Auth::user()->role == $r)
              return $next($request);
          }
        }

        return abort(403, 'Unauthorized action.');
    }
}
