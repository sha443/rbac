<?php

// Route::any('/rbac-test', function(){
// 	echo "RBAC Passed";
// });

Route::group(['middleware'=>['web', 'auth']], function(){
	Route::get('/rbac-test', '\sha443\rbac\Http\Controllers\RBACController@test')->name('test');
	Route::get('/rbac-menu', '\sha443\rbac\Http\Controllers\RBACController@getMenu');
});

