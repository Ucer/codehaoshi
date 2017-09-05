<?php


namespace App\Codehaoshi\Creators;

use App\Codehaoshi\Listeners\UserCreatorListener;
use App\Repositories\UserRepository;

class UserCreator
{
    protected $userModel;

    public function __construct(UserRepository $user)
    {
        $this->userModel = $user;
    }

    public function create(UserCreatorListener $observre, $userData)
    {
        if($userData['password']) {
            $userData['password'] = bcrypt($userData['password']);
        }

        $user = $this->userModel->store($userData);
        if (!$user) {
            return $observre->userValidationError($user->getErrors());
        }

        if($userData['image_url']) {
            $user->cacheAvatar();
        }

        return $observre->userCreated($user);
    }
}
