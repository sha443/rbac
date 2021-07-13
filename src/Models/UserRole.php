<?php

namespace sha443\rbac\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable = [
    	'user_id','role_id',
    ];

    public function user()
    {
        return $this->belongsTo('sha443\rbac\Models\DummyUser');
    }
    public function role()
    {
        return $this->belongsTo('sha443\rbac\Models\Role');
    }
}
