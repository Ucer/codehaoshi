<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;

class PermissionsController extends Controller
{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function roles()
    {
        return view('dashboard.permissions.permission-list');
    }

    public function ajaxPermissions(Request $request)
    {
        $keywords = $request->keywords;
        $where = [];
        if ($request->keywords) {
            $where[] = ['name', 'like', "%$keywords%"];
        }

        $list = $this->permissionRepository->page($where, Config::get('dashboard.pagesize'), 'created_at', 'desc');

        return view('dashboard.permissions.ajax-permission-list', ['lists' => $list]);
    }

    public function create()
    {
        return view('dashboard.permissions.create');
    }

    public function store(StorePermissionRequest $request)
    {
        $this->permissionRepository->store($request->all());
        return ajaxReturn(dashboardUrl('/permission'));
    }

    public function edit($id)
    {
        return view('dashboard.permissions.edit', ['info' => $this->permissionRepository->getById($id)]);
    }

    public function update(UpdatePermissionRequest $request, $id)
    {
        $this->permissionRepository->update($id, $request->all());
        return ajaxReturn(dashboardUrl('/permission'));
    }

    public function destroy($id)
    {
        $permissions = $this->permissionRepository->getById($id)->roles()->count();
        if ($permissions > 0) return ajaxReturnError('', 0, '有角色正在使用该权限，不允许删除');

        $this->permissionRepository->destroy($id);

        return ajaxReturn(redirect()->back());
    }
}
