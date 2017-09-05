<?php

namespace App\Activities;

class UserFollowedUser extends BaseActivity
{
    /**
     * When use vote a article, insert into activities a record
     *
     * @param $user
     * @param $question
     */
    public function generate($user, $following)
    {
        $causer = 'u' . $user->id;
        $indentifier = 'u' . $following->id;
        $data = array_merge([
            'following_user_name' => $following->user_name,
            'following_id' => $following->id,
        ]);
        $this->addActivity($causer, $user, $indentifier, $data);
    }

    public function remove($user, $following)
    {
        $this->removeBy('u' . $user->id, 'u' . $following->id);
    }
}