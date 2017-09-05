<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Repositories\TagRepository;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{

    protected $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function tags()
    {
        $list = $this->tagRepository->getAllData('*', false);
        return view('dashboard.tags.tag-list', ['lists' => $list]);
    }

    public function create()
    {
        return view('dashboard.tags.create');
    }

    public function store(StoreTagRequest $request)
    {
        $this->tagRepository->store($request->all());
        return ajaxReturn(dashboardUrl('/tag'));
    }

    public function edit($id)
    {
        return view('dashboard.tags.edit', ['info' => $this->tagRepository->getById($id)]);
    }

    public function update(UpdateTagRequest $request, $id)
    {
        $this->tagRepository->update($id, $request->all());
        return ajaxReturn(dashboardUrl('/tag'));
    }


    public function destroy($id)
    {
        $tagArticle = $this->tagRepository->getById($id)->articles()->count();
        if ($tagArticle > 0) return ajaxReturnError('', 0, '该标签下有文章，不允许删除');
//        if ($tagArticle > 0) return ajaxReturnError('', 0, '该标签下有问题，不允许删除'); // TODO

        $this->tagRepository->destroy($id);

        return ajaxReturn(dashboardUrl('/tag'));
    }
}
