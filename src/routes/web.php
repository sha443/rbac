<?php

// Route::any('/rbac-test', function(){
// 	echo "RBAC Passed";
// });

// Please do not modify the middleware order
Route::group(['prefix' => 'rbac'], function() {
	Route::group(['middleware'=>['web', 'auth', 'rbac']], function(){
		// ===================================
		// Settings routes [SuperAdmin]
		// ===================================

		// User CRUD route

		// Role CRUD route
		Route::get('/role','sha443\rbac\Http\Controllers\RoleController@index');
		Route::post('/role/','sha443\rbac\Http\Controllers\RoleController@addEdit');

		// User Role CRUD route
		Route::get('/user-role','sha443\rbac\Http\Controllers\UserRoleController@index');
		Route::post('/user-role','sha443\rbac\Http\Controllers\UserRoleController@searchOrStore');
		Route::get('/user-role/edit/{id}','sha443\rbac\Http\Controllers\UserRoleController@edit');
		Route::put('/user-role/{id}','sha443\rbac\Http\Controllers\UserRoleController@update');

		// Role Permission CRUD route
		Route::get('/role-permission','sha443\rbac\Http\Controllers\RolePermissionController@index');
		Route::get('/role-permission/create','sha443\rbac\Http\Controllers\RolePermissionController@create');
		Route::get('/role-permission/old-permission','sha443\rbac\Http\Controllers\RolePermissionController@oldPermission');
		Route::post('/role-permission','sha443\rbac\Http\Controllers\RolePermissionController@store');
		Route::get('/role-permission/edit/{id}','sha443\rbac\Http\Controllers\RolePermissionController@edit');
		Route::put('/role-permission/{id}','sha443\rbac\Http\Controllers\RolePermissionController@update');

		// Menu CRUD route
		Route::get('/menu','sha443\rbac\Http\Controllers\MenuController@index');
		Route::post('/menu','sha443\rbac\Http\Controllers\MenuController@addEdit');

		// Role Menu CRUD route
		Route::get('/role-menu','sha443\rbac\Http\Controllers\RoleMenuController@index');
		Route::get('/role-menu/create','sha443\rbac\Http\Controllers\RoleMenuController@create');
		Route::post('/role-menu','sha443\rbac\Http\Controllers\RoleMenuController@store');
		Route::get('/role-menu/old-menu','sha443\rbac\Http\Controllers\RoleMenuController@oldMenu');
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
