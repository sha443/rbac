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
        
        // this action name
        $action = class_basename($request->route()->getActionname());

        // Logged user
        $user_id = auth()->user()->id;

        // get user role-permissions by logged user id
        $user_roles = UserRole::where('user_id', $user_id)->get();

        if($user_roles)
        {
            foreach ($user_roles as $key => $role)
            {
                // get permissions by role
                $role_permissions = RolePermission::with('permission')->where('role_id', $role->role_id)->get();

                if($this->checkRolePermissionAccess($action, $role_permissions))
                {
                    // access granted
                    return $next($request);
                }
            }
        }

        // access denied
        return response(["message" => "Access Denied!"], 203);
    }

    protected function checkRolePermissionAccess($action, $role_permissions)
    {
        // check if requested action is in permissions list
        foreach ($role_permissions as $role_permission)
        {
            $_namespaces_chunks = explode('\\', $role_permission->permission->controller);
            $controller = end($_namespaces_chunks);
            
            if ($action == $controller . '@' . $role_permission->permission->method)
            {
                return true;
            }
        }

        return false;
    }
}
