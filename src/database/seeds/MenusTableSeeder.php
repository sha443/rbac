<?php
namespace sha443\rbac\database\seeds;

use Illuminate\Database\Seeder;

use sha443\rbac\Models\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // default menu
        Menu::create([
            'action' => '/rbac/user',
            'display_name' => 'User',
            'icon' => 'fa fa-users',
            'level' => '1',
            'active' => '1',
        ]);

        Menu::create([
            'action' => '/rbac/role',
            'display_name' => 'Role',
            'icon' => 'fa fa-cog',
            'level' => '1',
            'active' => '1',
        ]);
        Menu::create([
            'action' => '/rbac/menu',
            'display_name' => 'Menu',
            'icon' => 'fa fa-bars',
            'level' => '1',
            'active' => '1',
        ]);
        Menu::create([
            'action' => '/rbac/user-role',
            'display_name' => 'User Role',
            'icon' => 'fa fa-check',
            'level' => '1',
            'active' => '1',
        ]);
        Menu::create([
            'action' => '/rbac/role-menu/create',
            'display_name' => 'Role Menu',
            'icon' => 'fa fa-cogs',
            'level' => '1',
            'active' => '1',
        ]);

        Menu::create([
            'action' => '/rbac/role-permission/create',
            'display_name' => 'Role Permission',
            'icon' => 'fa fa-sliders',
            'level' => '1',
            'active' => '1',
        ]);

    }
}
