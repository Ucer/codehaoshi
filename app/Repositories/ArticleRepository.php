<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\Comment;

class ArticleRepository
{
    use BaseRepository;
    protected $model;

    public function __construct(Article $article)
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

    public function getArticleInfoBySlug($slug)
    {
        return $this->model->where('slug', $slug)->with('user', 'category')->firstOrFail();
    }

    public function decrementCommentCount($model)
    {
        return $model->decrement('comment_count');
    }


    public function generateLastReplyUserInfo($articleModel)
    {
        $lastComment = $articleModel->comments()->recent()->first();
        $articleModel->last_comment_user_id = $lastComment ? $lastComment->user_id : 0;
        $articleModel->save();
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
}