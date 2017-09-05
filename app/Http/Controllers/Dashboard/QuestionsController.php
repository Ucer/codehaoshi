<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\ArticleHelper;
use App\Http\Requests\QuestionRequest;
use App\Repositories\QuestionCategoryRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\TagRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Config;

class QuestionsController extends Controller
{
    use ArticleHelper;
    protected $questionRepository;
    protected $questionCategoryRepository;
    protected $tagRepository;

    public function __construct(QuestionCategoryRepository $questionCategoryRepository, QuestionRepository $questionRepository, TagRepository $tagRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->questionCategoryRepository = $questionCategoryRepository;
        $this->tagRepository = $tagRepository;
    }

    public function questions()
    {
        $category_list = $this->questionCategoryRepository->getAllData('*', false);
        return view('dashboard.questions.question-list', compact('category_list'));
    }

    /**
     * Article List ajax page date
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ajaxQuestions(Request $request)
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

        $lists = $this->questionRepository->page($where, Config::get('dashboard.pagesize'), $order, $sort);
        return view('dashboard.questions.ajax-question-list', compact('lists', 'order', 'sort'));

    }

    public function create()
    {
        $catList = $this->questionCategoryRepository->getAllData(['id', 'name'], false);
        $tagList = $this->tagRepository->getAllData(['id', 'tag'], false);

        return view('dashboard.questions.create', ['catList' => $catList, 'tagList' => $tagList]);
    }

    public function store(QuestionRequest $request)
    {
        $data = $this->handleArticleDate($request->all());

        $this->questionRepository->store($data);

        $this->questionCategoryRepository->getById($request->category_id)->increment('question_count');
        Auth::user()->increment('question_count');

        $this->questionRepository->syncTag(explode(',', $request->tags));
        return ajaxReturn(dashboardUrl('/question'));
    }


    public function edit($id)
    {
        $catList = $this->questionCategoryRepository->getAllData(['id', 'name'], false);
        $tagList = $this->tagRepository->getAllData(['id', 'tag'], false);
        $model = $this->questionRepository->getById($id);

        $attribute = $this->handleArticleDateToStr($model);

        return view('dashboard.questions.edit', ['info' => $model,
            'catList' => $catList, 'tagList' => $tagList,
            'tags' => array_column($model->tags->toArray(), 'id'),
            'attribute' => $attribute
        ]);
    }

    public function update(QuestionRequest $request, $id)
    {
        $oldData = $this->questionRepository->getById($id)->category_id;
        if ($oldData != $request->category_id) {
            $this->questionCategoryRepository->getById($request->category_id)->increment('question_count');
            $this->questionCategoryRepository->getById($oldData)->decrement('question_count');
        }
        $data = $this->handleArticleDate($request->all());
        unset($data['user_id']);
        $this->questionRepository->update($id, $data);

        $this->questionRepository->syncTag(explode(',', $request->tags));
        return ajaxReturn(dashboardUrl('/question'));
    }


    public function destroy($id)
    {
        $info = $this->questionRepository->getById($id);
        $this->questionCategoryRepository->getById($info->category_id)->decrement('question_count');
        Auth::user()->decrement('question_count');

        $info->tags()->sync([]);

        $this->questionRepository->destroy($id);

        return ajaxReturn(dashboardUrl('/question'));
    }
}
