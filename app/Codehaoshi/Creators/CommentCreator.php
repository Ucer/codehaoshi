<?php

namespace App\Codehaoshi\Creators;

use App\Activities\UserCommentArticle;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use App\Notifications\ReceivedComment;
use App\Tools\Markdowner;
use Carbon\Carbon;
use Codehaoshi\Core\CreatorListener;
use Auth;
use Codehaoshi\Notification\Metion;

class CommentCreator
{
    protected $metion;

    public function __construct(Metion $metion)
    {
        $this->metion = $metion;
    }

    public function create(CreatorListener $observer, $data)
    {
        // 检查是否重复发布评论
        if ($this->isDuplicateComment($data)) {

            return $observer->creatorFailed('请不要发布重复评论。');
        }

        $data['user_id'] = Auth::id();
        $data['body'] = $this->metion->parse($data['body']);

        $markdown = new Markdowner();
        $data['body_original'] = $data['body'];
        $data['body'] = $markdown->convertMarkdownToHtml($data['body']);

        $comment = Comment::create($data);

        if (!$comment) {
            return $observer->creatorFailed($comment->getErrors());
        }

        // Add the comment user
        $article = Article::findOrFail($data['article_id']);
        $article->last_comment_user_id = Auth::id();
        $article->comment_count++;
        $article->updated_at = Carbon::now()->toDateTimeString();
        $article->save();


        Auth::user()->increment('comment_count', 1);
        // Todo 用户评论后发送站内通知消息给被评论文章的作者
        User::findOrFail($article['user_id'])->notify(new ReceivedComment($comment));
        app(UserCommentArticle::class)->generate(Auth::user(), $article);

        return $observer->creatorSucceed($comment);
    }

    protected function isDuplicateComment($data)
    {
        $lastComment = Comment::where('user_id', Auth::id())
            ->where('article_id', $data['article_id'])
            ->orderBy('created_at', 'desc')
            ->first();
        return count($lastComment) && strcmp($lastComment->body_original, $data['body']) === 0;
    }
}