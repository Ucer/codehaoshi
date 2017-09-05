<?php

namespace App\Http\Controllers;


use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

    }

    /**
     * To check is current user has the permission to edit the infomation
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->userRepository->getById($id);
        $this->authorize('update', $user); // Use UserPolicy's update function
        return view('users.edit', ['info' => $user]);
    }

    /**
     * @param $id
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $user = $this->userRepository->getById($id);
        $this->authorize('update', $user);
        try {
            $this->userRepository->save($user, $request->except(['user_name', 'email', '_token', '']));

            flash('info', '操作成功');
        } catch (\Exception $e) {
            flash('error', $e);
        }
        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPassword($id)
    {
        $user = $this->userRepository->getById($id);
        $this->authorize('update', $user);
        return view('users.edit-password', ['info' => $user]);
    }

    /**
     * @param $id
     * @param ResetPasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword($id, ResetPasswordRequest $request)
    {
        $user = $this->userRepository->getById($id);
        $this->authorize('update', $user);

        $this->userRepository->changePassword($user, $request->password);
        flash('info', '密码修改成功!');
        return redirect()->back();
    }

    public function editEmail($id)
    {
        return view('users.edit-email');
    }

}
