<?php

#==========================
# Author: Shahid
# Date: April 2021
# shahidcseku@gmail.com
#==========================


namespace sha443\rbac\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use sha443\rbac\Models\RolePermission;
use sha443\rbac\Models\Role;
use sha443\rbac\Models\Permission;

class RolePermissionController extends LaravelController
{
    public function index($search_result=NULL)
    {
        $title = "Role Permission List";
        $role_permission_list = RolePermission::with('permission','role')->paginate(20);

        return view('rbac::permission.index',compact('role_permission_list','title'));
    }
    public function create($role_id, $old_role_permission_id_array=NULL)
    {
        $title = "Role Permission";
        $permission_list = Permission::orderBy('display_name')->orderBy('display_name')->orderBy('method')->get();
        // dd($permission_list);
        // group permissons by controller name
        $permission_groups = array();
        $current = null;
        $prevController = null;
        foreach ($permission_list as $key => $permission)
        {
            if($permission->controller===$prevController)
            {
                $current[] = $permission;
                $prevController = $permission->controller;
            }
            else
            {
                $prevController = $permission->controller;
                if(!is_null($current) && !is_null($prevController))
                {
                    array_push($permission_groups, $current);
                }

                unset($current);

                $current[] = $permission;
                $prevController = $permission->controller;

            }
        }

        // dd($permission_groups);

        $role_list = Role::get()->where('active',1);

        $role_permission_list = RolePermission::with('permission','role')->paginate(20);

        return view('rbac::permission.create',compact('role_permission_list','permission_groups','role_list','title','role_id','old_role_permission_id_array'));
    }
    public function oldPermission(Request $request)
    {
        $role_id = $request->input('role_id');
        $old_role_permissions = RolePermission::get()->where('role_id',$role_id);

       $old_role_permission_id_array = array();
       foreach ($old_role_permissions as $old_role_permission)
       {
       		// echo $old_role_permission->permission_id;
       		array_push($old_role_permission_id_array, $old_role_permission->permission_id);
       }
        // dd($old_role_permissions);
        return $this->create($role_id,$old_role_permission_id_array);
    }
    public function store(Request $request)
    {
    	$valid = Validator::make($request->all(), [
            'role_id'=>'required',
            'permission'=>'required',
        ]);

        if ($valid->fails())
	    {
	        return redirect()->back();
	    }
    	// print_r($request->input('permission')); exit;
    	$permissions = $request->input('permission'); 
    	$role_id = $request->input('role_id'); 


    	foreach ($permissions as $permission)
    	{
    		$role_permission_check = RolePermission::where(
                 ['role_id'=>$role_id,'permission_id'=>$permission]
             )->first();
    		if(!$role_permission_check)
    		{
	    		$role_permission_request = new \Illuminate\Http\Request();
				$role_permission_request->setMethod('POST');
				$role_permission_request->request->add(['role_id' => $role_id]);
				$role_permission_request->request->add(['permission_id' => $permission]);

				RolePermission::create($role_permission_request->all());
    		}
    	}

    	// Delete the permissions ( if exits) that are not selected
    	$permissions_all = Permission::get();
    	$permissions_all_id = array();
    	foreach ($permissions_all as $permission)
    	{
    		array_push($permissions_all_id, $permission->id);
    	}
    	$permissions_selected_id = $permissions;

    	// Subtract selected from all permissions to get not selected
    	$permissions_not_selected_id =  array_diff($permissions_all_id, $permissions_selected_id);
    	foreach ($permissions_not_selected_id as $permission_id)
    	{
    		// delete if exists
    		$this->revokeRolePermission($role_id,$permission_id);
    	}
        self::success('Role permission updated successfully!');
        // return redirect('/role-permission/create/');

        return $this->create($role_id, $permissions);
    }
    public function revokeRolePermission($role_id, $permission_id)
    {
    	RolePermission::where('role_id',$role_id)->where('permission_id',$permission_id)->delete();
    	return True;
    }
}
