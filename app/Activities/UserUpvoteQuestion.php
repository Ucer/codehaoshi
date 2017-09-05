<?php
namespace App\Activities;

class UserUpvoteQuestion extends BaseActivity
{
    /**
     * When use vote a article, insert into activities a record
     *
     * @param $user
     * @param $article
     */
    public function generate($user, $question)
    {
        $this->addQuestionActivity($user, $question);
    }

    public function remove($user, $question)
    {
        $this->removeBy('u'.$user->id, 'q'.$question->id);
    }
}