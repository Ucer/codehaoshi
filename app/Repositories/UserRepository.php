<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    use BaseRepository;
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * return  paginate list
     *
     * @param int $pagesize
     * @param string $sort
     * @param string $sortColumn
     * @return mixed
     */
    public function page($where = false, $pagesize = 20, $sortColumn = 'last_actived_at', $sort = 'desc')
    {
        if ($where) {
            return $this->model->where($where['k'])->orWhere($where['k2'])->orderBy($sortColumn, $sort)->paginate($pagesize);
        } else {
            return $this->model->orderBy($sortColumn, $sort)->paginate($pagesize);
        }
    }

    /**
     * Sync the tags for the article.
     * @param array $roleIds
     * @param int $userId
     */
    public function syncRole($roleIds = [], $userId = 0)
    {
        $this->getById($userId)->roles()->sync($roleIds);
    }

    /**
     * @param $user
     * @param $password
     * @return mixed
     */
    public function changePassword($user,$password)
    {
        return $user->update(['password'=>bcrypt($password)]);
    }

    /**
     * Get the user by name.
     *
     * @param  string $name
     * @return mixed
     */
    public function getByName($user_name)
    {
        return $this->model
            ->where('user_name', $user_name)
            ->first();
    }
}