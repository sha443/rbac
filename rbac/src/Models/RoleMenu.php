<?php

namespace sha443\rbac\Models;

use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    protected $fillable = [
    	'role_id', 'menu_id',
    ];

    public function menu()
    {
        return $this->belongsTo('sha443\rbac\Models\Menu');
    }
    public function role()
    {
        return $this->belongsTo('sha443\rbac\Models\Role');
    }
    public static function attach($role_id, $menu_ids)
    {
        foreach ($menu_ids as $key => $menu_id)
        {
            $data = [
                'role_id' => $role_id,
                'menu_id' => $menu_id,
            ];

            RoleMenu::create($data);
        }
    }
}
