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
    | Builds role based menu and returns array of menu objects
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
          self::$instance = new MenuBuilder();
        }
        return self::$instance;
    }

    /**
    * @return array
    */
    public function getMenuItems($user_id)
    {
        $menu_items = array();

        $user_roles = UserRole::where('user_id', $user_id)->get();
        foreach ($user_roles as $key => $role)
        {
            $role_menus = RoleMenu::with('menu')->where('role_id', $role->role_id)->get();
            foreach ($role_menus as $key => $menus)
            {
                if(!is_null($menus->menu))
                {
                    $menu_items[] = $menus->menu;
                }
            }
        }
        
        return array_unique($menu_items);
    }

    /**
    * @return array
    */
    public function getMenuByLevel($user_id, $level=0)
    {
        $menu_items = array();

        $user_roles = UserRole::where('user_id', $user_id)->get();

        foreach ($user_roles as $key => $role)
        {
            $role_menus = RoleMenu::with(['menu' => function($query) use ($level){
                return $query->where('level', $level);
            }])->where('role_id' , $role->role_id)->get();

            foreach ($role_menus as $key => $menus)
            {
                if(!is_null($menus->menu))
                {
                    $menu_items[] = $menus->menu;
                }
            }
        }

        return array_unique($menu_items);
    }
}

?>