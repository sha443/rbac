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
        $menu_ids = [];
        $menus = Menu::where('active', 1)->get();
        foreach ($menus as $key => $menu)
        {
            $menu_ids[] = $menu->id;
        }

        // find admin role.
        $admin_role = Role::where('name','admin')->first();
        RoleMenu::attach($admin_role->id, $menu_ids);
    }
}
