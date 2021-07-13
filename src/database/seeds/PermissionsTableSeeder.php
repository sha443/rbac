<?php

namespace sha443\rbac\database\seeds;

Use Route;

use Illuminate\Database\Seeder;

use sha443\rbac\Models\Permission;
use sha443\rbac\Models\Role;
use sha443\rbac\Models\RolePermission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission_ids = []; // an empty array of stored permission IDs

        // iterate though all routes
        foreach (Route::getRoutes()->getRoutes() as $key => $route)
        {
            // get route action
            $action = $route->getActionname();
            // separating controller and method
            $_action = explode('@',$action);

            $controller = $_action[0];
            $method = end($_action);

            $_namespaces_chunks = explode('\\', $controller);
            $controller_name = end($_namespaces_chunks);

            // check if this permission is already exists
            $permission_check = Permission::where(['controller'=>$controller, 'method'=>$method])->first();
            
            if(!$permission_check)
            {
                $permission = new Permission();
                $permission->controller = $controller;
                $permission->method = $method;
                $permission->display_name = $controller_name.'@'.$method;
                $permission->save();
                // add stored permission id in array
                $permission_ids[] = $permission->id;
            }
        }
        
        // find admin role.
        $admin_role = Role::where('name','admin')->first();
        // atache all permissions to admin role
        RolePermission::attach($admin_role->id, $permission_ids);
    }
}
