<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //if (Auth::guard($guard)->check()) {
         //   return redirect('/home');
       // }

        switch ($guard){
            case 'admin':
                if(Auth::guard($guard)->check()){
                    return redirect()->route('admin.dashboard');
                }
                break;
            case 'provost':
                if(Auth::guard($guard)->check()){
                    return redirect()->route('provost.dashboard');
                }
                break;
            case 'asstprovost':
                if(Auth::guard($guard)->check()){
                    return redirect()->route('asstprovost.dashboard');
                }
                break;
            default:
                if(Auth::guard($guard)->check()){
                    return redirect()->route('student.dashboard');
                }
                break;
        }

        return $next($request);
    }
}
