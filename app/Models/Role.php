<?php

namespace App\Models;

use Ucer\Entrust\EntrustRole;
use Ucer\Entrust\Traits\EntrustRoleTrait;

class Role extends EntrustRole
{
    use EntrustRoleTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description'];

    public function saveFunction()
    {
//        $this->name = 'owner';
//        $this->display_name = 'Project Owner'; // optional
//        $this->description = 'User is the owner of a given project'; // optional
//        $this->save();

//        $this->name = 'admin';
//        $this->display_name = 'User Administrator'; // optional
//        $this->description = 'User is allowed to manage and edit other users'; // optional
//        $this->save();
        $result = 'success';
        $role = $this->findOrFail(1);
//        $role->attachPermission(1); // 为角色 1 添加1权限
//        $role->attachPermissions(['1','2']);
//        $role->detachPermission(1);
//        $role->detachPermissions(['1','2']);
//        $result = $role->hasPermission('edit-user');


        return $result;
    }
}
