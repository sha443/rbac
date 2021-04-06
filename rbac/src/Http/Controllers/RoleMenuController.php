<?php


#==========================
# Author: Shahid
# Date: April 2021
# shahidcseku@gmail.com
#==========================


namespace sha443\rbac\Http\Controllers;

use sha443\rbac\Models\RoleMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use sha443\rbac\Models\Role;
use sha443\rbac\Models\Menu;

class RoleMenuController extends LaravelController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Role Menu List";
        $role_menu_list = RoleMenu::paginate(20);
        return view('rbac::rolemenus.index',compact('role_menu_list','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($role_id,$old_role_menu_id_array=NULL)
    {
        $title = "Role Menu";
        $menu_list = Menu::get()->where('active',1);
        $role_list = Role::get()->where('active',1);
        $role_menu_list = RoleMenu::with('menu','role')->paginate(20);

        if($role_id!=NULL)
        {

            return view('rolemenus.create',compact('role_menu_list','menu_list','role_list','title','role_id','old_role_menu_id_array'));
        }
        else
        {
            return view('rbac::rolemenus.create',compact('role_menu_list','menu_list','role_list','title'));
        }
    }

     public function oldMenu(Request $request)
    {
        $role_id = $request->input('role_id');
        $old_role_menus = RoleMenu::get()->where('role_id',$role_id);

       $old_role_menu_id_array = array();
       foreach ($old_role_menus as $old_role_menu)
       {
            array_push($old_role_menu_id_array, $old_role_menu->menu_id);
       }
        return $this->create($role_id,$old_role_menu_id_array);
    }
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'role_id'=>'required',
            'menu'=>'required',
        ]);

        if ($valid->fails())
        {
            self::warning('Please select required fields!');
            return redirect()->back();
        }

        $menus = $request->input('menu'); 
        $role_id = $request->input('role_id'); 

        $date_time = date('y-m-d h:i:s');

        foreach ($menus as $menu)
        {
            $role_menu_check = RoleMenu::where(
                 ['role_id'=>$role_id,'menu_id'=>$menu]
             )->first();
            if(!$role_menu_check)
            {
                $role_menu_request = new \Illuminate\Http\Request();
                $role_menu_request->setMethod('POST');
                $role_menu_request->request->add(['role_id' => $role_id]);
                $role_menu_request->request->add(['menu_id' => $menu]);

                RoleMenu::create($role_menu_request->all());
            }
        }

        // Delete the menu ( if exits) that are not selected
        $menu_all = Menu::get();
        $menu_all_id = array();
        $menu_selected_id = $menus;
        
        foreach ($menu_all as $menu)
        {
            array_push($menu_all_id, $menu->id);
        }

        // Subtract selected from all menu to get not selected
        $menu_not_selected_id =  array_diff($menu_all_id, $menu_selected_id);
        foreach ($menu_not_selected_id as $menu_id)
        {
            // delete if exists
            $this->revokeRoleMenu($role_id,$menu_id);
        }
        self::success('Role Menu updated successfully!');
        return redirect('/role-menu/create');
    }
    public function revokeRoleMenu($role_id, $menu_id)
    {
        RoleMenu::where('role_id',$role_id)->where('menu_id',$menu_id)->delete();
        return True;
    }
}
