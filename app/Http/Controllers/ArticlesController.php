<?php

namespace App\Http\Controllers;


use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Repositories\ArticleCategoryRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\TagRepository;
use Codehaoshi\Selectors\ArticleSelector;
use Auth;

class ArticlesController extends Controller
{
    protected $articleRepository;
    protected $articleCategoryRepository;
    protected $tagRepository;
    protected $questionRepository;

    public function __construct(ArticleCategoryRepository $articleCategoryRepository, ArticleRepository $articleRepository, TagRepository $tagRepository, QuestionRepository $questionRepository)
    {
        $this->tagRepository = $tagRepository;
        $this->articleRepository = $articleRepository;
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->questionRepository = $questionRepository;
    }

    /**
     * Get article list by category
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($slug)
    {
        $category = $this->articleCategoryRepository->getInfoBySlug($slug);
        $articles = $this->articleRepository->getThisModel()->getArticlesWithFilter('category', 20, $category->id);

        $hotArticles = $this->articleRepository->getThisModel()->getArticlesWithFilter('hot', 5);
        $recentArticles = $this->articleRepository->getThisModel()->getArticlesWithFilter('recent', 5);
        $tags = $this->tagRepository->getAllTagWithCount();

        return view('articles.article-list', compact('articles', 'category', 'hotArticles', 'recentArticles', 'tags'));
    }

    /**
     * Show article-info page
     * @param $slug
     * @param Article $articleModel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug, Article $articleModel)
    {
        $article = $this->articleRepository->getArticleInfoBySlug($slug);

        if ($article->is_draft == 'yes' || $article->only_owner_can_see == 'yes') {
            $this->authorize('showDraft', $article);
        }

        $article->increment('view_count');

        $recentArticles = $articleModel->withoutDraft()->withoutPrivate()->where('id', '<>', $article['id'])->orderBy('created_at', 'desc')->select('id', 'title', 'slug')->paginate(6);

        $prevAndNext = app(ArticleSelector::class)->articleInfoWithPrevAndNext($article->id);
        return view('articles.show', ['info' => $article,
            'recentArticles' => $recentArticles,
            'prev' => $prevAndNext['prev'],
            'next' => $prevAndNext['next']
        ]);
    }


    /**
     * Get All articles
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allArticles()
    {
        $articles = $this->articleRepository->getThisModel()->getArticlesWithFilter('recent', 20);
        return view('articles.all-articles', compact('articles'));
    }


    public function create()
    {
        $recentArticles = $this->articleRepository->getThisModel()->getArticlesWithFilter('recent', 5);
        $recentQuestions = $this->questionRepository->getThisModel()->getArticlesWithFilter('recent', 5);
        $tags = $this->tagRepository->getAllTagWithCount();

        $catList = $this->articleCategoryRepository->getAllData(['id', 'name'], false);
        $tagList = $this->tagRepository->getAllData(['id', 'tag'], false);
        return view('articles.create', compact('tagList', 'catList', 'recentQuestions', 'recentArticles', 'tags'));
    }

    public function store(ArticleRequest $request)
    {
        $data = array_merge($request->all(), ['user_id' => Auth::id()]);
        $res  =$this->articleRepository->store($data);

        $this->articleCategoryRepository->getById($request->category_id)->increment('article_count');
        Auth::user()->increment('article_count');

        $this->articleRepository->syncTag(explode(',', $request->tags));
        flash('info', '文章发布成功');
        return redirect()->route('article.show', ['slug' => $res->slug]);
    }

    public function edit($id)
    {
        $recentArticles = $this->articleRepository->getThisModel()->getArticlesWithFilter('recent', 5);
        $recentQuestions = $this->questionRepository->getThisModel()->getArticlesWithFilter('recent', 5);
        $tags = $this->tagRepository->getAllTagWithCount();

        $catList = $this->articleCategoryRepository->getAllData(['id', 'name'], false);
        $tagList = $this->tagRepository->getAllData(['id', 'tag'], false);
        $info = $this->articleRepository->getById($id);
        $infoTag = implode(',', array_column($info->tags->toArray(), 'id'));

        return view('articles.edit',compact('info','infoTag', 'catList', 'tagList', 'tags', 'recentArticles', 'recentQuestions'));
    }

    public function update(ArticleRequest $request, $id)
    {
        $oldData = $this->articleRepository->getById($id)->category_id;
        if ($oldData != $request->category_id) {
            $this->articleCategoryRepository->getById($request->category_id)->increment('article_count');
            $this->articleCategoryRepository->getById($oldData)->decrement('article_count');
        }
        $data = $request->only('title', 'category_id', 'description', 'content', 'tags', 'is_draft');
        $res = $this->articleRepository->update($id, $data);

        $this->articleRepository->syncTag(explode(',', $request->tags));
        flash('info', '文章更新成功');
        return redirect()->route('article.show', ['slug' => $res->slug]);
    }
}
