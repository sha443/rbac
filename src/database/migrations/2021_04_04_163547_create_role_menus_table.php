<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoleMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('role_menus', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('role_id');
			$table->integer('menu_id');
			$table->timestamps();

			$table->unique(['menu_id','role_id'], 'role_menu_key');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('role_menus');
	}

}
