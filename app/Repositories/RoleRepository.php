<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository
{
    use BaseRepository;
    protected $model;

    public function __construct(Role $role)
    {
        $this->model = $role;
    }


    /**
     * @param $id
     * @param $input
     * @return mixed
     */
    public function update($id, $input)
    {
        $this->model = $this->getById($id);

        return $this->save($this->model, $input);
    }


    /**
     * Sync the tags for the article.
     * @param array $roleIds
     * @param int $userId
     */
    public function syncPermission($permissionIds = [], $userId = 0)
    {
        $this->getById($userId)->perms()->sync($permissionIds);
    }
}