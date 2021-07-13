<?php

namespace sha443\rbac\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
    	'name', 'display_name', 'active',
    ];

}
