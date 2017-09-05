<?php

namespace App\Http\Controllers;


use App\Models\About;
use App\Models\Article;
use App\Models\Question;
use App\Models\User;
use App\Repositories\ArticleRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(Article $article, Question $question)
    {
        $tenExcellentArticles = $article->getArticlesWithFilter('excellent', 10);
        $tenExcellentQuestions = $question->getArticlesWithFilter('excellent', 10);

        return view('pages.home', compact('tenExcellentArticles', 'tenExcellentQuestions'));
    }

    public function search(Request $request)
    {
        $query = $request->q;
        $article_search = Article::search($query, null, true)->withoutDraft()->WithoutPrivate()->recent()->weightAsc()->paginate(20);
        $question_search = Question::search($query, null, true)->withoutDraft()->WithoutPrivate()->recent()->weightAsc()->paginate(20);
        return view('pages.search', compact('article_search', 'question_search', 'query'));
    }

    public function about(ArticleRepository $articleRepository, QuestionRepository $questionRepository, TagRepository $tagRepository)
    {
        $info = About::where('is_enabled', 'yes')->first() ;

        $recentArticles = $articleRepository->getThisModel()->withoutDraft()->withoutPrivate()->orderBy('created_at', 'desc')->select('id', 'title', 'slug')->paginate(6);
        $recentQuestions = $questionRepository->getThisModel()->withoutDraft()->withoutPrivate()->orderBy('created_at', 'desc')->select('id', 'title', 'slug')->paginate(6);
        $tags = $tagRepository->getAllTagWithCount();

        return view('pages.about', compact('info', 'recentArticles', 'recentQuestions', 'tags'));
    }

}
