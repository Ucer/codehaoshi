<?php

namespace App\Repositories;

use App\Models\Question;

class QuestionRepository
{
    use BaseRepository;
    protected $model;

    public function __construct(Question $article)
    {
        $this->model = $article;
    }
    /**
     * Sync the tags for the article.
     *
     * @param  int $number
     * @return Paginate
     */
    public function syncTag($tags = '')
    {
        $this->model->tags()->sync($tags);
    }

    public function getQuestionInfoBySlug($slug)
    {
        return $this->model->where('slug', $slug)->with('user', 'category')->firstOrFail();
    }

    /**
     * Get one record without draft scope
     *
     * @param $id
     * @return mixed
     */
    public function getByIdWithoutException($id, $type = '>' ,$field = ['id','title','slug'])
    {
        return $this->model->withoutDraft()->where('id' , $type, $id)->select($field)->first();
    }

    public function decrementReplyCount($model)
    {
        return $model->decrement('reply_count');
    }


    public function generateLastReplyUserInfo($questionModel)
    {
        $lastComment = $questionModel->replies()->recent()->first();
        $questionModel->last_reply_user_id = $lastComment ? $lastComment->user_id : 0;
        $questionModel->save();
    }
}