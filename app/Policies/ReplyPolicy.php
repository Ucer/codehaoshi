<?php

namespace App\Policies;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Reply $reply)
    {
        return $user->hasRole('supper_admin') || $user->id == $reply->user_id;
    }
}