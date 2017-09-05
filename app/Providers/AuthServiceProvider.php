<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Question;
use App\Models\Reply;
use App\Models\User;
use App\Policies\ArticlePolicy;
use App\Policies\CommentPolicy;
use App\Policies\QuestionPolicy;
use App\Policies\ReplyPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Article::class => ArticlePolicy::class,
        Question::class => QuestionPolicy::class,
        Comment::class => CommentPolicy::class,
        User::class => UserPolicy::class,
        Reply::class => ReplyPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

    }
}
