<?php

/*
Author: Shahid
Email: shahidcseku@gmail.com | shahidul.islam@villacollege.edu.mv
Date: 1 April 2021
Developed at: CICT, Villa College

*/

namespace sha443\rbac\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\User;

class RBACController extends LaravelController
{
    /*
    |--------------------------------------------------------------------------
    | SSO Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application using
    | a third party token
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected static $menuBuilder;
    protected static $accessChecker;

    /**
     * Create a new controller instance.
     *
     * @return void 
     */
    public function __construct()
    {
      self::$menuBuilder = MenuBuilder::getInstance();
      self::$accessChecker = AccessChecker::getInstance();
    }

    public function test()
    {
        return response(['message'=>'Passed'], 200);
    }
    public function passed(Request $request, $user_id)
    {
      if(self::isRequestPassed($user_id, $request))
      {
        return response(['message'=>'passed'], 200);
      }
      return response(['message'=>'failed'], 403);
    }
    public function getMenu()
    {
       // $data = MenuBuilder::getMenuItems();
       // $data = MenuBuilder::getMenuByLevel();
       $data = self::getMenuByLevel(1, 1);
       foreach ($data as $key => $menu)
       {
           echo "<a href=".$menu['action'].">".$menu['display_name']."<br>";
       }
    }

    public static function getMenuItems($user_id)
    {
      return self::$menuBuilder->getMenuItems($user_id);
    }

    public static function getMenuByLevel($user_id, $level=0)
    {
      return self::$menuBuilder->getMenuByLevel($user_id, $level);
    }

    public static function isRequestPassed($user_id, $request)
    {
      return self::$accessChecker->isRequestPassed($user_id, $request);
    }
}
?>