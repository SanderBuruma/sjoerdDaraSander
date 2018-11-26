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
        // & is an AND operator
        // listed logical statements can be combined without issue as long as ! prefixes numbers and &| are inbetween role numbers. !2|1 passes if user has NOT role 2 OR has role 1.  2&!3 passes if user is not role 3 and has role 2.

        $saveCheckString = $checkRole."";

        $checkRole = explode("|", $checkRole);

        function isRole($request, $roleId) {
            foreach($request->user()->roles as $role){
                if ($role->id == $roleId){
                    return true;
                }
            };
            return false;
        };

        foreach ($checkRole as $roleId) {
            $andStatement = true;
            foreach(explode("&", $roleId) as $i){
                if ($i[0] === "!") {
                    if (isRole($request, substr($i,1)) === true) {
                        $andStatement = false; break;
                    }
                } else {
                    if (isRole($request, $i) === false) {
                        $andStatement = false; break;
                    }
                }
            }
            if ($andStatement === true) {
                return $next($request);
            }
        }

        

        //error reporting
        $saveCheckString = preg_replace(['/\|/', '/\!/', '/\&/'], [" OR "," not:", " AND "], $saveCheckString);
        Session::flash('error', "role check failed, access denied. role $saveCheckString required");
        return redirect('/home');

    }
}
