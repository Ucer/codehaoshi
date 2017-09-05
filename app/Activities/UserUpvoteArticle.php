<?php
namespace App\Activities;

class UserUpvoteArticle extends BaseActivity
{
    /**
     * When use vote a article, insert into activities a record
     *
     * @param $user
     * @param $article
     */
    public function generate($user, $article)
    {
        $this->addArticleActivity($user, $article);
    }

    public function remove($user, $article)
    {
        $this->removeBy('u'.$user->id, 'a'.$article->id);
    }
}