<?php

namespace sha443\rbac\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $fillable = [
    	'role_id', 'permission_id',
    ];

    public function permission()
    {
        return $this->belongsTo('sha443\rbac\Models\Permission');
    }
    public function role()
    {
        return $this->belongsTo('sha443\rbac\Models\Role');
    }
    public static function attach($role_id, $permissions)
    {
        foreach ($permissions as $key => $permission_id)
        {
            $data = [
                'role_id' => $role_id,
                'permission_id' => $permission_id,
            ];

            RolePermission::create($data);
        }
    }
}
