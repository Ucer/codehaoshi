<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\Traits\ArticleHelper;
use App\Http\Requests\ArticleRequest;
use App\Repositories\ArticleCategoryRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\TagRepository;
use Config;
use Illuminate\Http\Request;
use Auth;

class ArticlesController extends Controller
{
    use ArticleHelper;

    protected $articleRepository;
    protected $articleCategoryRepository;
    protected $tagRepository;

    public function __construct(ArticleCategoryRepository $articleCategoryRepository, ArticleRepository $articleRepository, TagRepository $tagRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->tagRepository = $tagRepository;
    }

    public function articles()
    {
        $category_list = $this->articleCategoryRepository->getAllData('*', false);
        return view('dashboard.articles.article-list', compact('category_list'));
    }

    /**
     * Article List ajax page date
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ajaxArticles(Request $request)
    {
        $order = $request->order?: 'weight';
        $sort = $request->sort?: 'asc';
        $keywords = $request->keywords;
        $is_hot = $request->is_hot;
        $only_owner_can_see = $request->only_owner_can_see;
        $is_excellent = $request->is_excellent;
        $is_draft = $request->is_draft;
        $category_id = $request->cat_id;

        $where = [];
        if ($request->keywords) {
            $where[] = ['title', 'like', "%$keywords%"];
        }
        if($is_hot) $where[] = ['is_hot' , '=', $is_hot];
        if($only_owner_can_see) $where[] = ['only_owner_can_see' , '=', $only_owner_can_see];
        if($is_excellent) $where[] = ['is_excellent' , '=', $is_excellent];
        if($is_draft) $where[] = ['is_draft' , '=', $is_draft];
        if($category_id) $where[] = ['category_id' , '=', $category_id];

        $lists = $this->articleRepository->page($where, Config::get('dashboard.pagesize'), $order, $sort);
        return view('dashboard.articles.ajax-article-list', compact('lists', 'order', 'sort'));

    }

    public function create()
    {
        $catList = $this->articleCategoryRepository->getAllData(['id', 'name'], false);
        $tagList = $this->tagRepository->getAllData(['id', 'tag'], false);

        return view('dashboard.articles.create', ['catList' => $catList, 'tagList' => $tagList]);
    }

    public function store(ArticleRequest $request)
    {
        $data = $this->handleArticleDate($request->all());
        $this->articleRepository->store($data);

        $this->articleCategoryRepository->getById($request->category_id)->increment('article_count');
        Auth::user()->increment('article_count');

        $this->articleRepository->syncTag(explode(',', $request->tags));
        return ajaxReturn(dashboardUrl('/article'));
    }

    public function edit($id)
    {
        $catList = $this->articleCategoryRepository->getAllData(['id', 'name'], false);
        $tagList = $this->tagRepository->getAllData(['id', 'tag'], false);
        $model = $this->articleRepository->getById($id);

        $attribute = $this->handleArticleDateToStr($model);

        return view('dashboard.articles.edit', ['info' => $model,
            'catList' => $catList, 'tagList' => $tagList,
            'tags' => array_column($model->tags->toArray(), 'id'),
            'attribute' => $attribute
        ]);
    }

    public function update(ArticleRequest $request, $id)
    {
        $oldData = $this->articleRepository->getById($id)->category_id;
        if ($oldData != $request->category_id) {
            $this->articleCategoryRepository->getById($request->category_id)->increment('article_count');
            $this->articleCategoryRepository->getById($oldData)->decrement('article_count');
        }
        $data = $this->handleArticleDate($request->all());
        unset($data['user_id']);
        $this->articleRepository->update($id, $data);

        $this->articleRepository->syncTag(explode(',', $request->tags));
        return ajaxReturn(dashboardUrl('/article'));
    }


    public function destroy($id)
    {
        $info = $this->articleRepository->getById($id);
        $this->articleCategoryRepository->getById($info->category_id)->decrement('article_count');
        Auth::user()->decrement('article_count');

        $info->tags()->sync([]);

        $this->articleRepository->destroy($id);

        return ajaxReturn(dashboardUrl('/article'));
    }

}
