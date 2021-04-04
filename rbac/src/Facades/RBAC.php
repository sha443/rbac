<?php

namespace sha443\rbac\Facades;

use Illuminate\Support\Facades\Facade;

use sha443\rbac\Http\Controllers\RBACController;

class RBAC extends Facade
{
	protected static function getFacadeAccessor()
	{
		// it will return RBACController
		return 'sha443\rbac\Http\Controllers\RBACController'; 
	}
}