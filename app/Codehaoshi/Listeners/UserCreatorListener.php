<?php
namespace App\Codehaoshi\Listeners;

interface UserCreatorListener
{
    public function userValidationError($errors);
    public function userCreated($user);
}
