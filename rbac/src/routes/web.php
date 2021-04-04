<?php

// Route::any('/rbac-test', function(){
// 	echo "RBAC Passed";
// });

// Please do not modify the middleware order
Route::group(['middleware'=>['web', 'auth', 'rbac']], function(){
	Route::get('/rbac-test', '\sha443\rbac\Http\Controllers\RBACController@test')->name('test');
	Route::get('/rbac-menu', '\sha443\rbac\Http\Controllers\RBACController@getMenu');
});

