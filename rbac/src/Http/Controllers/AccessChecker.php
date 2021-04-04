<?php

/*
Author: Shahid
Email: shahidcseku@gmail.com | shahidul.islam@villacollege.edu.mv
Date: 1 April 2021
Developed at: CICT, Villa College

*/
namespace sha443\rbac\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Laravel app default user
use App\User;

// Package models
use sha443\rbac\Models\Role;
use sha443\rbac\Models\UserRole;
use sha443\rbac\Models\RolePermission;
use sha443\rbac\Models\Menu;
use sha443\rbac\Models\RoleMenu;

class AccessChecker extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Roles Access
    |--------------------------------------------------------------------------
    |
    | Check role based access and returns verdict as bool
    |
    */
    protected static $instance = null;
    /**
     * Create a new controller instance.
     *
     * @return void 
     */
    private function __construct()
    {

    }

    public static function getInstance()
    {
        // Lazy Initilaization
        if (self::$instance == null)
        {
          self::$instance = new AccessChecker();
        }
        return self::$instance;
    }

    /**
    * @return array
    */
    public function isRequestPassed($user_id, $request)
    {
        // this action name
        $action = class_basename($request->route()->getActionname());

        // get user role-permissions by user id
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
                    return true;
                }
            }
        }

        return false;
    }

    /**
    * @return bool
    */
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

?>