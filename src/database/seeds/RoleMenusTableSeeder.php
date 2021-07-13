<?php
namespace sha443\rbac\database\seeds;

use Illuminate\Database\Seeder;

use sha443\rbac\Models\Role;
use sha443\rbac\Models\Menu;
use sha443\rbac\Models\RoleMenu;

class RoleMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // find admin role.
        $admin_role = Role::where('name','admin')->first();

        $menu_ids = [];
        $menus = Menu::where('active', 1)->get();
        foreach ($menus as $key => $menu)
        {
            $role_exist = RoleMenu::where(['role_id' => $admin_role->id, 'menu_id' => $menu->id])->first();
            if(!$role_exist)
            {
                $menu_ids[] = $menu->id;
            }
        }

        try {
            RoleMenu::attach($admin_role->id, $menu_ids);
        } catch (Exception $e) {
            // do nothing
        }
    }
}
