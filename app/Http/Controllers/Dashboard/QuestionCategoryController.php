<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\StoreQuestionCategoryRequest;
use App\Http\Requests\UpdateQuestionCategoryRequest;
use App\Repositories\QuestionCategoryRepository;
use App\Http\Controllers\Controller;
use App\Tools\FileManager\BaseManager;

class QuestionCategoryController extends Controller
{
    protected $questionCategoryRepository;
    protected $baseManager;

    public function __construct(QuestionCategoryRepository $questionCategoryRepository, BaseManager $baseManager)
    {
        $this->questionCategoryRepository = $questionCategoryRepository;
        $this->baseManager = $baseManager;
    }

    public function questionCategories()
    {
        $list = $this->questionCategoryRepository->getAllData('*', false);
        return view('dashboard.question-categories.category-list', ['lists' => $list]);
    }

    public function create()
    {
        return view('dashboard.question-categories.create');
    }

    public function store(StoreQuestionCategoryRequest $request)
    {
        $data = array_merge($request->all(), [
            'image_url' => $this->baseManager->moveFileTorealPath($request->image_url,'question'),
            'weight' => $request->weight ?: 50
        ]);

        $this->questionCategoryRepository->store($data);
        return ajaxReturn(dashboardUrl('/questionCategory'));
    }


    public function edit($id)
    {
        return view('dashboard.question-categories.edit', ['info' => $this->questionCategoryRepository->getById($id)]);
    }
    public function update(UpdateQuestionCategoryRequest $request, $id)
    {
        $data = array_merge($request->all(), [
            'image_url' => $this->baseManager->moveFileTorealPath($request->image_url, 'question'),
            'weight' => $request->weight ?: 50
        ]);
        $this->questionCategoryRepository->update($id, $data);
        return ajaxReturn(dashboardUrl('/questionCategory'));
    }

    public function destroy($id)
    {
        $permissions = $this->questionCategoryRepository->getById($id)->questions()->count();
        if ($permissions > 0) return ajaxReturnError('', 0, '有问题正在使用该分类，不允许删除');

        $this->questionCategoryRepository->destroy($id);
        return ajaxReturn(redirect()->back());
    }
}
