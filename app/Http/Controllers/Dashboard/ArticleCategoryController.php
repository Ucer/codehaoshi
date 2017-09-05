<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\StoreArticleCategoryRequest;
use App\Http\Requests\UpdateArticleCategoryRequest;
use App\Repositories\ArticleCategoryRepository;
use App\Http\Controllers\Controller;
use App\Tools\FileManager\BaseManager;

class ArticleCategoryController extends Controller
{

    protected $articleCategoryRepository;
    protected $baseManager;

    public function __construct(ArticleCategoryRepository $articleCategoryRepository, BaseManager $baseManager)
    {
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->baseManager = $baseManager;
    }

    public function articleCategories()
    {
        $list = $this->articleCategoryRepository->getAllData('*', false);
        return view('dashboard.article-categories.category-list', ['lists' => $list]);
    }

    public function create()
    {
        return view('dashboard.article-categories.create');
    }

    public function store(StoreArticleCategoryRequest $request)
    {
        $data = array_merge($request->all(), [
            'image_url' => $this->baseManager->moveFileTorealPath($request->image_url),
            'weight' => $request->weight ?: 50
        ]);

        $this->articleCategoryRepository->store($data);
        return ajaxReturn(dashboardUrl('/articleCategory'));
    }

    public function edit($id)
    {
        return view('dashboard.article-categories.edit', ['info' => $this->articleCategoryRepository->getById($id)]);
    }

    public function update(UpdateArticleCategoryRequest $request, $id)
    {
        $data = array_merge($request->all(), [
            'image_url' => $this->baseManager->moveFileTorealPath($request->image_url),
            'weight' => $request->weight ?: 50
        ]);
        $this->articleCategoryRepository->update($id, $data);
        return ajaxReturn(dashboardUrl('/articleCategory'));
    }

    public function destroy($id)
    {
        $permissions = $this->articleCategoryRepository->getById($id)->articles()->count();
        if ($permissions > 0) return ajaxReturnError('', 0, '有文章正在使用该分类，不允许删除');

        $this->articleCategoryRepository->destroy($id);

        return ajaxReturn(redirect()->back());
    }
}
