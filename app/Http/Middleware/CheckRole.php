<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;
use App\User;
use Illuminate\Foundation\Auth\User as Authenticable;
use Session;

class CheckRole 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $checkRole)
    {
        // | in checkrole parameter equals an OR statement. 2|3 means check whether user has role 2 OR 3.
        // ! before a role id means NOT. !2 passes if user does NOT have role 2.
        // listed logical statements can be combined without issue. !2|1 passes if user has NOT role 2 OR has role 1. 

        $saveCheckString = $checkRole."";

        if (strpos($checkRole, "|") !== false) {
            $checkRole = explode("|", $checkRole);
        }

        if (gettype($checkRole) == "string") {
            $checkRole = [$checkRole];
        };

        function isRole($request, $roleId) {
            foreach($request->user()->roles as $role){
                if ($role->id == $roleId){
                    return true;
                }
            };
            return false;
        };

        foreach ($checkRole as $roleId) {
            if ($roleId[0] === "!") {
                if (isRole($request, substr($roleId,1)) === false) {
                    return $next($request);
                }
            } else {
                if (isRole($request, $roleId)) {
                    return $next($request);
                }
            }
        }

        //error reporting
        $saveCheckString = preg_replace(['/\|/','/\!/','/\d+/'], [" OR "," not:", "role-$0"], $saveCheckString);
        Session::flash('error', "$saveCheckString role check failed, access denied.");
        return redirect('/home');

    }
}
