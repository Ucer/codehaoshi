<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;


    public function showDraft(User $user, Question $article)
    {
        return  $article->user_id == $user->id || $user->hasRole('supper_admin');
    }
}
