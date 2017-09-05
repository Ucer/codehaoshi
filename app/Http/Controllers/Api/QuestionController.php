<?php

namespace App\Http\Controllers\Api;

use App\Repositories\QuestionRepository;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Auth;

class QuestionController extends Apicontroller
{
    public function voteUser(QuestionRepository $questionRepository, $question_id)
    {
        $info = $questionRepository->getById($question_id)->votes()->orderBy('created_at', 'desc')->with('user')->get()->pluck('user');
        return $this->respondWithArray($info->toArray());
    }

    public function vote(QuestionRepository $questionRepository, Request $request, $question_id)
    {
        $question = $questionRepository->getById($question_id);
        if ($request->type == 'up') {
            $result = app('Codehaoshi\Vote\Voter')->questionUpVote($question);
            if ($result['status'] == 1) return $this->respondWithItem(Auth::user(), new UserTransformer);
        } else {
            $result = app('Codehaoshi\Vote\Voter')->questionDownVote($question);
        }
        if ($result['status'] === 1) return $this->noContent();
        return $this->errorWrongArgs('出错了，请稍后再试');
    }
}
