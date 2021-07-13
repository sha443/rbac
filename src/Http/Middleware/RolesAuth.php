<?php

#==========================
# Author: Shahid
# Date: Nov 2019
# shahidul.islam@villacollege.edu.mv
# shahidcseku@gmail.com
#==========================


namespace sha443\rbac\Http\Middleware;

use Closure;
use Auth;

use sha443\rbac\facades\RBAC;

// Laravel app default user
use App\User;

// Package models
use sha443\rbac\Models\Role;
use sha443\rbac\Models\UserRole;
use sha443\rbac\Models\RolePermission;
use sha443\rbac\Models\Menu;
use sha443\rbac\Models\RoleMenu;

class RolesAuth
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
        if(!Auth::user())
        {
            return redirect('/login');
        }
        
        // Logged user
        $user_id = auth()->user()->id;
        
        if(RBAC::isRequestPassed($user_id, $request))
        {
            // access granted
            return $next($request);
        }

        // access denied
        return response(["message" => "Access Denied!"], 403);
    }
}
