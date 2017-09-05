<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use Auth;

class UsersController extends Controller
{
    protected $userRepository;
    protected $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function users()
    {
        return view('dashboard.users.user-list');
    }

    public function ajaxUsers(Request $request)
    {
        $keywords = $request->keywords;
        $where = [];
        if ($request->keywords) {
            $where['k'][] = ['user_name', 'like', "%$keywords%"];
            $where['k2'][] = ['email', 'like', "%$keywords%"];
        }

        $list = $this->userRepository->page($where, Config::get('dashboard.pagesize'));

        return view('dashboard.users.ajax-user-list', ['lists' => $list]);

    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $data = array_merge($request->all(), [
            'avatar' => '/assets/dashboard/images/head_default.gif',
            'register_source' => 'admin',
            'password' => bcrypt($request->password),
            'status' => 1
        ]);
        $this->userRepository->store($data);
        return ajaxReturn(dashboardUrl('/user'));
    }

    public function edit($id)
    {
        return view('dashboard.users.edit', ['info' => $this->userRepository->getById($id)]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->all();
        if ($request->password) {
            $data = array_merge($data, [
                'password' => bcrypt($request->password)
            ]);
        } else {
            unset($data['password']);
        }
        $this->userRepository->update($id, $data);
        return ajaxReturn(dashboardUrl('/user'));
    }

    public function destroy($id)
    {
        if (Auth::user()->id == $id) {
            return ajaxReturnError('', 0, '您不能删除您自己');
        }
        $user = $this->userRepository->getById($id);
        $article = $user->articles()->count();
        $question = $user->questions()->count();
        if( $article > 0 || $question > 0) return ajaxReturnError('', 0, '用户发表过文章或问题，不允许删除');

        $this->userRepository->syncRole([], $id);
        $this->userRepository->destroy($id);

        return ajaxReturn(redirect()->back());
    }

    public function giveUserRoles(Request $request)
    {
        $roles = $this->userRepository->getById($request->id)->cachedRoles();
        return response()->json(
            ajaxReturn('', 1, '成功',
                roleOrPermissionDataHandle(array_column($roles->toArray(), 'id'), $this->roleRepository->getAllData(['id', 'name', 'display_name'])
                )));
    }

    public function giveUserRolesStore(Request $request)
    {
        $ids = [];
        if ($request->data) {
            $ids = explode(',', $request->data);
        }
        $this->userRepository->syncRole($ids, $request->id);
        return ajaxReturn(redirect()->back());
    }

}
