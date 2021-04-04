<?php
namespace sha443\rbac\database\seeds;

use Illuminate\Database\Seeder;

class RBACSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(RoleMenusTableSeeder::class);
    }
}
