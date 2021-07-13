<?php
namespace sha443\rbac\database\seeds;

use Illuminate\Database\Seeder;

use sha443\rbac\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // default roles
        Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'active' => '1',
        ]);

        Role::create([
            'name' => 'user',
            'display_name' => 'User',
            'active' => '1',
        ]);
    }
}
