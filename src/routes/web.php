<?php

// Route::any('/rbac-test', function(){
// 	echo "RBAC Passed";
// });

// Please do not modify the middleware order
Route::group(['prefix' => 'rbac'], function() {
	Route::group(['middleware'=>['web', 'rbac']], function(){
		// ===================================
		// Settings routes [SuperAdmin]
		// ===================================

		// User CRUD route

		// Role CRUD route
		Route::get('/role','sha443\rbac\Http\Controllers\RoleController@index')->name('role_index');
		Route::post('/role/','sha443\rbac\Http\Controllers\RoleController@addEdit')->name('role_create');

		// User Role CRUD route
		Route::get('/user-role','sha443\rbac\Http\Controllers\UserRoleController@index')->name('user_role_index');
		Route::post('/user-role','sha443\rbac\Http\Controllers\UserRoleController@searchOrStore')->name('user_role_store');
		Route::get('/user-role/edit/{id}','sha443\rbac\Http\Controllers\UserRoleController@edit')->name('user_role_edit');
		Route::put('/user-role/{id}','sha443\rbac\Http\Controllers\UserRoleController@update')->name('user_role_update');

		// Role Permission CRUD route
		Route::get('/role-permission','sha443\rbac\Http\Controllers\RolePermissionController@index')->name('role_permission_index');
		Route::get('/role-permission/create','sha443\rbac\Http\Controllers\RolePermissionController@create')->name('role_permission_create');
		Route::get('/role-permission/old-permission','sha443\rbac\Http\Controllers\RolePermissionController@oldPermission')->name('role_permission_retrive');
		Route::post('/role-permission','sha443\rbac\Http\Controllers\RolePermissionController@store')->name('role_permission_store');
		Route::get('/role-permission/edit/{id}','sha443\rbac\Http\Controllers\RolePermissionController@edit')->name('role_permission_edit');
		Route::put('/role-permission/{id}','sha443\rbac\Http\Controllers\RolePermissionController@update')->name('role_permission_update');

		// Menu CRUD route
		Route::get('/menu','sha443\rbac\Http\Controllers\MenuController@index')->name('menu_index');
		Route::post('/menu','sha443\rbac\Http\Controllers\MenuController@addEdit')->name('manu_create');

		// Role Menu CRUD route
		Route::get('/role-menu','sha443\rbac\Http\Controllers\RoleMenuController@index')->name('role_menu_index');
		Route::get('/role-menu/create','sha443\rbac\Http\Controllers\RoleMenuController@create')->name('role_menu_create');
		Route::post('/role-menu','sha443\rbac\Http\Controllers\RoleMenuController@store')->name('role_menu_store');
		Route::get('/role-menu/old-menu','sha443\rbac\Http\Controllers\RoleMenuController@oldMenu')->name('role_menu_retrive');
	});
});


// must be used with middlewares
Route::group(['middleware'=>['web', 'auth']], function(){
	// Route::get('/rbac-facade', function(){
	// 	dd(sha443\rbac\facades\RBAC::getMenuItems(1));
	// });

	Route::get('/rbac-menu', function(){
		dd(sha443\rbac\facades\RBAC::getMenuByLevel(1, 1));
	});

	Route::get('/rbac-menu-all', function(){
		dd(sha443\rbac\facades\RBAC::getMenuItems(1));
	});

	Route::get('/rbac-failed', function(Illuminate\Http\Request $request){
		dd(sha443\rbac\facades\RBAC::isRequestPassed(1, $request));
	});
});
