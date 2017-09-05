<?php

namespace App\Codehaoshi\Creators;

use App\Activities\UserReplyQuestion;
use App\Models\Question;
use App\Models\Reply;
use App\Models\User;
use App\Notifications\ReceivedReply;
use App\Tools\Markdowner;
use Carbon\Carbon;
use Codehaoshi\Core\CreatorListener;
use Auth;
use Codehaoshi\Notification\Metion;

class ReplyCreator
{
    protected $metion;

    public function __construct(Metion $metion)
    {
        $this->metion = $metion;
    }

    public function create(CreatorListener $observer, $data)
    {
        // 检查是否重复发布评论
        if ($this->isDuplicateReply($data)) {

            return $observer->creatorFailed('请不要发布重复评论。');
        }

        $data['user_id'] = Auth::id();
        $data['body'] = $this->metion->parse($data['body']);

        $markdown = new Markdowner;
        $data['body_original'] = $data['body'];
        $data['body'] = $markdown->convertMarkdownToHtml($data['body']);

        $reply = Reply::create($data);

        if (!$reply) {
            return $observer->creatorFailed($reply->getErrors());
        }

        // Add the comment user
        $question = Question::findOrFail($data['question_id']);
        $question->last_reply_user_id = Auth::id();
        $question->reply_count++;
        $question->updated_at = Carbon::now()->toDateTimeString();
        $question->save();


        Auth::user()->increment('reply_count', 1);
        // Todo 用户评论后发送站内通知消息给被评论文章的作者
        User::findOrFail($question['user_id'])->notify(new ReceivedReply($reply));
        app(UserReplyQuestion::class)->generate(Auth::user(), $question);

        return $observer->creatorSucceed($reply);
    }

    protected function isDuplicateReply($data)
    {
        $lastReply = Reply::where('user_id', Auth::id())
            ->where('question_id', $data['question_id'])
            ->orderBy('created_at', 'desc')
            ->first();
        return count($lastReply) && strcmp($lastReply->body_original, $data['body']) === 0;
    }
}