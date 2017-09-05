<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;


    public function showDraft(User $user, Article $article)
    {
        return  $article->user_id == $user->id || $user->hasRole('supper_admin');

    }
}
