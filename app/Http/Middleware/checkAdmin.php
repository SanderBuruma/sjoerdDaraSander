<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;
use App\User;
use Illuminate\Foundation\Auth\User as Authenticable;
use Session;

class checkAdmin
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
        function isAdmin($request) {
            foreach($request->user()->roles as $role){
                if ($role->id == 1){
                    return true;
                }
            };
            return false;
        };

        if(isAdmin($request)){
            return $next($request);
        } else {
            Session::flash('error', 'You need Admin role to access this page...');
            return view('pages.home');
        }

    }
}
