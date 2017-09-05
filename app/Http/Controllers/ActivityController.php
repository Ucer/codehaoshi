<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Question;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Auth;

class ActivityController extends Controller
{
    protected $userRepository;
    protected $article;
    protected $question;

    public function __construct(UserRepository $userRepository, Article $article, Question $question)
    {
        $this->userRepository = $userRepository;
        $this->article = $article;
        $this->question = $question;
    }

    public function index($user_name, $view = null, Request $request)
    {
        $user = $this->userRepository->getByName($user_name);

        if (!isset($user)) abort(404);

        switch ($view) {
            case 'article':
                $activities = $this->article->getArticlesWithWhoFilter('default', 10, $user->id);;
                break;
            case 'question':
                $activities = $this->question->getArticlesWithWhoFilter('default', 10, $user->id);;
                break;
            case 'following':
                $activities = $user->followings;;
                break;
            case 'followed':
                $activities = $user->followers;
                break;
            case 'vote':
                $activities = $user->activities()->recent()->whereIn('type', ['UserUpvoteArticle', 'UserUpvoteQuestion'])->paginate(10);
                break;
            default:
                $activities = $user->activities()->recent()->paginate(10);
                break;
        }
        $user_name = $user->user_name;

        return view('users.personal-center', [
            'info' => $user,
            'activities' => $activities,
            'view' => $view,
            'nowUrl' => $request->url(),
            'articleView' => route('user_center', ['user_name' => $user_name, 'view' => 'article']),
            'questionView' => route('user_center', ['user_name' => $user_name, 'view' => 'question']),
            'followingView' => route('user_center', ['user_name' => $user_name, 'view' => 'following']),
            'followedView' => route('user_center', ['user_name' => $user_name, 'view' => 'followed']),
            'defaultView' => route('user_center', ['user_name' => $user_name, 'view' => null]),
            'voteView' => route('user_center', ['user_name' => $user_name, 'view' => 'vote']),
        ]);
    }
}
