<?php

namespace App\Http\Controllers\Api;

use App\Activities\UserCommentArticle;
use App\Codehaoshi\Creators\CommentCreator;
use App\Http\Requests\StoreReplyOrCommentRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\CommentRepository;
use App\Transformers\CommentTransformer;
use Codehaoshi\Core\CreatorListener;
use Illuminate\Http\Request;
use Auth;

class CommentController extends Apicontroller implements CreatorListener
{
    protected $commentRepository;
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository, CommentRepository $commentRepository)
    {
        parent::__construct();
        $this->commentRepository = $commentRepository;
        $this->articleRepository = $articleRepository;
    }

    public function show(Request $request, $article_id)
    {
        $article = $this->articleRepository->getById($article_id);
        $replies = $article->getCommentsWithLimit(config('codehaoshi.comments_perpage', '200'), $request->order_by);
        return $this->respondWithCollection($replies, new CommentTransformer);
    }


    public function store(StoreReplyOrCommentRequest $request)
    {
        return app(CommentCreator::class)->create($this, $request->all());
    }

    public function creatorSucceed($comment)
    {
        return $this->respondWithItem($comment, new CommentTransformer);
    }

    public function creatorFailed($error)
    {
        return $this->errorWrongArgs($error);
    }

    public function destroy($comment_id)
    {
        $comment = $this->commentRepository->getById($comment_id);
        $this->authorize('delete', $comment);
        $comment->delete();
        $articleModel = $comment->article();
        $this->articleRepository->decrementCommentCount($articleModel);
        $article = $this->articleRepository->getById($comment->article_id);
        $this->articleRepository->generateLastReplyUserInfo($article);
        app(UserCommentArticle::class)->remove(Auth::user(), $article);

        return $this->noContent();
    }

}
