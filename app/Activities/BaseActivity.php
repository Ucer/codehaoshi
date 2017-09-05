<?php
namespace App\Activities;

use App\Models\Activity;
use App\Models\Article;
use App\Models\Question;
use App\Models\User;
use Carbon\Carbon;

class BaseActivity
{
    public function addArticleActivity(User $user, Article $article, $extra_data = [], $indentifier = null)
    {
        $causer      = 'u' . $user->id;
        $indentifier = $indentifier ?: 'a' . $article->id;

        $data = array_merge([
            'article_type' => 'article',
            'article_id' => $article->id,
            'article_slug' => $article->slug,
            'article_title' => $article->title,
        ], $extra_data);

        $this->addActivity($causer, $user, $indentifier, $data);
    }
    public function addQuestionActivity(User $user, Question $question, $extra_data = [], $indentifier = null)
    {
        $causer      = 'u' . $user->id;
        $indentifier = $indentifier ?: 'q' . $question->id;

        $data = array_merge([
            'article_type' => 'question',
            'article_id' => $question->id,
            'article_slug' => $question->slug,
            'article_title' => $question->title,
        ], $extra_data);

        $this->addActivity($causer, $user, $indentifier, $data);
    }

    public function addActivity($causer, $user, $indentifier, $data)
    {
        $type = class_basename(get_class($this));

        $activities[] = [
            'causer'      => $causer,
            'user_id'     => $user->id,
            'type'        => $type,
            'indentifier' => $indentifier,
            'data'        => serialize($data),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        Activity::insert($activities);
    }


    public function removeBy($causer, $indentifier)
    {
        Activity::where('causer', $causer)
            ->where('indentifier', $indentifier)
            ->where('type', class_basename(get_class($this)))
            ->delete();
    }
}