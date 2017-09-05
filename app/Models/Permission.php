<?php

namespace App\Models;


use Ucer\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = ['name', 'display_name', 'description'];

    public function saveFunction()
    {
//        $this->name         = 'create-post';
//        $this->display_name = 'Create Posts'; // optional
//// Allow a user to...
//        $this->description  = 'create new blog posts'; // optional
//        $this->save();
//
//        $this->name         = 'edit-user';
//        $this->display_name = 'Edit Users'; // optional
//// Allow a user to...
//        $this->description  = 'edit existing users'; // optional
//        $this->save();
        return 'success';
    }
}
