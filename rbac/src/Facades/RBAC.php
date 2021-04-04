<?php

namespace sha443\rbac\Facades;

use Illuminate\Support\Facades\Facade;

class RBAC extends Facade
{
	protected static function getFacadeAccessor() { return 'RBAC'; }
}