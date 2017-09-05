<?php

namespace App\Http\Controllers;

use App\Codehaoshi\Creators\CommentCreator;
use App\Http\Requests\StoreReplyOrCommentRequest;
use App\Repositories\ArticleRepository;
use Codehaoshi\Core\CreatorListener;

class CommentsController extends Controller implements CreatorListener
{

    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->middleware('auth');
        $this->articleRepository = $articleRepository;
    }

    public function store(StoreReplyOrCommentRequest $request)
    {
        return app(CommentCreator::class)->create($this, $request->except('_token'));
    }

    public function creatorSucceed($article)
    {
        flash('info', lang('Operation succeed.'));
        $articleSlug = $this->articleRepository->getById($article->article_id)->slug;
        return redirect()->route('article.show', ['slug' => $articleSlug]);
    }

    public function creatorFailed($error)
    {
        flash('error', '发布失败:' . $error);
        return redirect('/');

    }


}
