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

use Auth;

use sha443\rbac\Models\Role;
use sha443\rbac\Models\Menu;
use sha443\rbac\Models\RoleMenu;

use App\User;
use sha443\rbac\Models\UserRole;

class MenuBuilder extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Menu Builder
    |--------------------------------------------------------------------------
    |
    | 
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void 
     */
    public function __construct()
    {
        // user must login and pass the access middleware
        $this->middleware(['auth', 'web']);
    }

    /**
    * @return array
    */
    public static function getMenuItems()
    {
        $menu_items = array();

        $user_id = auth()->user()->id;
        $user_roles = UserRole::where('user_id', $user_id)->get();
        foreach ($user_roles as $key => $role)
        {
            $role_menus = RoleMenu::with('menu')->where('role_id', $role->role_id)->get();
            foreach ($role_menus as $key => $menus)
            {
                $menu_items[] = $menus->menu;
            }
        }
        
        return $menu_items;
    }
    /**
    * @return array
    */
    public static function getMenuByLevel($level=0)
    {
        $menu_items = array();

        $user_id = auth()->user()->id;
        $user_roles = UserRole::where('user_id', $user_id)->get();
        foreach ($user_roles as $key => $role)
        {
            $role_menus = RoleMenu::with(['menu' => function($query) use ($level){
                return $query->where('level', $level);
            }])->where('role_id' , $role->role_id)->get();

            foreach ($role_menus as $key => $menus)
            {
                $menu_items[] = $menus->menu;
            }
        }
        return $menu_items;
    }
}
?>