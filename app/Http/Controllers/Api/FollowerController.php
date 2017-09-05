<?php

namespace App\Http\Controllers\Api;

use App\Activities\UserFollowedUser;
use App\Notifications\NewUserFollowNotification;
use App\Repositories\UserRepository;
use Auth;

class FollowerController extends Apicontroller
{

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * FollowersController constructor.
     * @param $user
     */
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        $author = $this->userRepository->getById($id);
        return response()->json(['followed' => Auth::user()->isFollowing($author)]);
    }

    /**
     * Follow or unfollow the other user.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function doFollow()
    {
        $id = request('user');
        $userToFollow = $this->userRepository->getById(request('user'));

        $user = Auth::user();

        if ($user->isFollowing($id)) {
            app(UserFollowedUser::class)->remove($user, $userToFollow);
            $user->unfollow($id);
            $userToFollow->decrement('follower_count');
            return response()->json(['followed' => false]);
        } else {
            $user->follow($id);

            $userToFollow->notify(new NewUserFollowNotification());
            $userToFollow->increment('follower_count');
            app(UserFollowedUser::class)->generate($user, $userToFollow);
        }
        return response()->json(['followed' => true]);
    }

}
