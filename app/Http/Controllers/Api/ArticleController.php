<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ArticleRepository;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Auth;

class ArticleController extends Apicontroller
{
    public function voteUser(ArticleRepository $articleRepository, $article_id)
    {
        $info = $articleRepository->getById($article_id)->votes()->orderBy('created_at', 'desc')->with('user')->get()->pluck('user');
        return $this->respondWithArray($info->toArray());
    }

    public function vote(ArticleRepository $articleRepository, Request $request, $article_id)
    {
        $article = $articleRepository->getById($article_id);
        if ($request->type == 'up') {
            $result = app('Codehaoshi\Vote\Voter')->articleUpVote($article);
            if ($result['status'] == 1) return $this->respondWithItem(Auth::user(), new UserTransformer);
        } else {
            $result = app('Codehaoshi\Vote\Voter')->articleDownVote($article);
        }
        if ($result['status'] === 1) return $this->noContent();
        return $this->errorWrongArgs('出错了，请稍后再试');
    }
}
