<?php

namespace App\Http\Controllers\Api;

use App\Activities\UserReplyQuestion;
use App\Codehaoshi\Creators\ReplyCreator;
use App\Http\Requests\StoreReplyOrCommentRequest;
use App\Repositories\QuestionRepository;
use App\Repositories\ReplyRepository;
use App\Transformers\ReplyTransformer;
use Codehaoshi\Core\CreatorListener;
use Illuminate\Http\Request;
use Auth;

class ReplyController extends Apicontroller implements CreatorListener
{
    protected $replyRepository;
    protected $questionRepository;

    public function __construct(QuestionRepository $questionRepository, ReplyRepository $replyRepository)
    {
        parent::__construct();
        $this->replyRepository = $replyRepository;
        $this->questionRepository = $questionRepository;
    }

    public function show(Request $request, $question_id)
    {
        $question = $this->questionRepository->getById($question_id);
        $replies = $question->getRepliesWithLimit(config('codehaoshi.comments_perpage', '200'), $request->order_by);
        return $this->respondWithCollection($replies, new ReplyTransformer);
    }

    public function store(StoreReplyOrCommentRequest $request)
    {
        return app(ReplyCreator::class)->create($this, $request->all());
    }

    public function creatorSucceed($reply)
    {
        return $this->respondWithItem($reply, new ReplyTransformer);
    }

    public function creatorFailed($error)
    {
        return $this->errorWrongArgs($error);
    }

    public function destroy($reply_id)
    {
        $reply = $this->replyRepository->getById($reply_id);
        $this->authorize('delete', $reply);
        $reply->delete();
        $questionModel = $reply->question();
        $this->questionRepository->decrementReplyCount($questionModel);
        $question = $this->questionRepository->getById($reply->question_id);
        $this->questionRepository->generateLastReplyUserInfo($question);
        app(UserReplyQuestion::class)->remove(Auth::user(), $question);

        return $this->noContent();
    }
}
