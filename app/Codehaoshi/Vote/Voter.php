<?php

namespace Codehaoshi\Vote;

use App\Activities\UserUpvoteArticle;
use App\Activities\UserUpvoteQuestion;
use App\Models\Article;
use App\Models\Question;
use App\Models\User;
use App\Notifications\UserVoteArticle;
use App\Notifications\UserVoteQuestion;
use Illuminate\Support\Facades\Auth;

class Voter
{
    public function articleUpVote(Article $article)
    {
        $query = $article->votes();
        if ($query->ByWhom(Auth::id())->count()) {
            $result = 0;
        } else {
            $result = $query->create(['user_id' => Auth::id()]);

            User::findOrfail($article->user_id)->notify(new UserVoteArticle($article));
            app(UserUpvoteArticle::class)->generate(Auth::user(), $article);

            $article->increment('vote_count', 1);
        }

        return $result ? ['status' => 1] : ['status' => -1];
    }

    public function articleDownVote(Article $article)
    {
        $query = $article->votes()->ByWhom(Auth::id());
        if (!$query->count()) {
            $result = 0;
        } else {
            $result = $query->delete();
            $article->decrement('vote_count', 1);
            app(UserUpvoteArticle::class)->remove(Auth::user(), $article);
        }
        return $result ? ['status' => 1] : ['status' => -1];
    }

    public function questionUpVote(Question $question)
    {
        $query = $question->votes();
        if ($query->ByWhom(Auth::id())->count()) {
            $result = 0;
        } else {
            $result = $query->create(['user_id' => Auth::id()]);

            User::findOrfail($question->user_id)->notify(new UserVoteQuestion($question));
            app(UserUpvoteQuestion::class)->generate(Auth::user(), $question);

            $question->increment('vote_count', 1);
        }

        return $result ? ['status' => 1] : ['status' => -1];
    }

    public function questionDownVote(Question $question)
    {
        $query = $question->votes()->ByWhom(Auth::id());
        if (!$query->count()) {
            $result = 0;
        } else {
            $result = $query->delete();
            $question->decrement('vote_count', 1);
            app(UserUpvoteQuestion::class)->remove(Auth::user(), $question);
        }
        return $result ? ['status' => 1] : ['status' => -1];
    }
}