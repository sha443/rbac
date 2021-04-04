<?php

namespace sha443\rbac\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
    	'action', 'display_name', 'active', 'icon', 'level',
    ];
}