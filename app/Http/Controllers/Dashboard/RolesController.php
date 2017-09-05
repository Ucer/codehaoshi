<?php

namespace App\Http\Controllers\Dashboard;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Config;

class RolesController extends Controller
{
    protected $roleRepository;
    protected $permissionRepository;

    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function roles()
    {
        return view('dashboard.roles.role-list');
    }

    public function ajaxRoles(Request $request)
    {
        $keywords = $request->keywords;
        $where = [];
        if ($request->keywords) {
            $where[] = ['name', 'like', "%$keywords%"];
        }

        $list = $this->roleRepository->page($where, Config::get('dashboard.pagesize'), 'created_at', 'desc');

        return view('dashboard.roles.ajax-role-list', ['lists' => $list]);

    }

    public function create()
    {
        return view('dashboard.roles.create');
    }

    public function store(StoreRoleRequest $request)
    {
        $this->roleRepository->store($request->all());
        return ajaxReturn(dashboardUrl('/role'));
    }

    public function edit($id)
    {
        return view('dashboard.roles.edit', ['info' => $this->roleRepository->getById($id)]);
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $this->roleRepository->update($id, $request->all());
        return ajaxReturn(dashboardUrl('/role'));
    }

    public function giveRolePermissions(Request $request)
    {
        $permissions = $this->roleRepository->getById($request->id)->cachedPermissions();
        return response()->json(
            ajaxReturn('', 1, '成功',
                roleOrPermissionDataHandle(array_column($permissions->toArray(), 'id'), $this->permissionRepository->getAllData(['id', 'name', 'display_name'])
                )));
    }

    public function giveRolePermissionsStore(Request $request)
    {
        $ids = [];
        if ($request->data) {
            $ids = explode(',', $request->data);
        }
        $this->roleRepository->syncPermission($ids, $request->id);
        return ajaxReturn(redirect()->back());
    }

    public function destroy($id)
    {
        $permissions = $this->roleRepository->getById($id)->users()->count();
        if ($permissions > 0) return ajaxReturnError('', 0, '有用户正在使用该角色，不允许删除');

        $this->roleRepository->syncPermission([], $id);
        $this->roleRepository->destroy($id);

        return ajaxReturn(redirect()->back());
    }
}
