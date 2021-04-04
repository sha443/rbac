<?php

// Route::any('/rbac-test', function(){
// 	echo "RBAC Passed";
// });

// Please do not modify the middleware order
Route::group(['middleware'=>['web', 'auth', 'rbac']], function(){
	Route::get('/rbac-test', '\sha443\rbac\Http\Controllers\RBACController@test')->name('test');
	// Route::get('/rbac-menu', '\sha443\rbac\Http\Controllers\RBACController@getMenu');
	Route::get('/rbac-passed/{id}', '\sha443\rbac\Http\Controllers\RBACController@passed' );
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
