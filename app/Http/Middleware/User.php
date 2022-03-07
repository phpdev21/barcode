<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
class User
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
 
        if(Auth::check() && Auth::user()->role == 1){
            return $next($request);
        }
        if(Auth::check() && Auth::user()->role == 0){
            return redirect()->route('admin.dashboard');
        }
        else{
            return redirect()->route('login');
        } 
    }
}
