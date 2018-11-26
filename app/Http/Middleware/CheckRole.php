<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;
use App\User;
use Illuminate\Foundation\Auth\User as Authenticable;
use Session;

class CheckRole{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $checkRole)
    {
        function isRole($request) {
            global $checkRole;
            foreach($request->user()->roles as $role){
                if ($role->id == $checkRole){
                    return true;
                }
            };
            return false;
        };

        if(isRole($request)){
            return $next($request);
        } else {
            $roleName = Role::find($checkRole)->name;
            Session::flash('error', "$roleName role needed to access this page");
            return redirect('/home');
        }

    }
}
