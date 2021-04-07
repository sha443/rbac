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

class RolesMenu
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
        
        // Menu builder arrays
        $main_menu = array();
        $settings_menu = array();
        $others_menu = array();

        // Logged user || no need to check access as already passed rolesauth middleware
        $user_id = auth()->user()->id;
        $menus = RBAC::getMenuItems($user_id);

        // Buildup the menu
        foreach($menus as $menu)
        {
            if($menu->level==1)
            {
                array_push($main_menu, $menu);
            }
            else if($menu->level==2)
            {
                array_push($settings_menu, $menu);
            }
            else if($menu->level==3)
            {
                array_push($others_menu, $menu);
            }
        }  

        // Save as config
        config(['app.main_menu' => $main_menu]);
        config(['app.settings_menu' => $settings_menu]);
        config(['app.others_menu' => $others_menu]);

        return $next($request);
    }
}
