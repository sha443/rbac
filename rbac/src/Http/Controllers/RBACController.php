<?php

/*
Author: Shahid
Email: shahidcseku@gmail.com | shahidul.islam@villacollege.edu.mv
Date: 1 April 2021
Developed at: CICT, Villa College

*/

namespace sha443\rbac\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\User;

class RBACController extends Controller
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

    /**
     * Create a new controller instance.
     *
     * @return void 
     */
    public function __construct()
    {
    }

    public function test()
    {
        return response(['message'=>'Passed'], 200);
    }
    public function getMenu()
    {
       // $data = MenuBuilder::getMenuItems();
       // $data = MenuBuilder::getMenuByLevel();
       $data = MenuBuilder::getMenuByLevel(1);
       foreach ($data as $key => $menu)
       {
           echo "<a href=".$menu['action'].">".$menu['display_name']."<br>";
       }
       // dd($data);
    }
}
?>