<?php

namespace sha443\rbac\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
    	'display_name', 'controller', 'method',
    ];
}
