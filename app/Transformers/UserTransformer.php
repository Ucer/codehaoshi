<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'avatar' => $user->avatar,
            'user_name' => $user->name,
            'created_at' => $user->created_at->toDateTimeString(),
        ];
    }
}
