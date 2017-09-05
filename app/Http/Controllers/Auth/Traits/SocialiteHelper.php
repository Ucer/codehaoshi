<?php

namespace App\Http\Controllers\Auth\Traits;

use Socialite;
use Auth;
use Flash;
use Illuminate\Http\Request;
use Session;

trait SocialiteHelper
{
    protected $oauthDrivers = ['github' => 'github', 'wechat' => 'weixin'];

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToGithubProvider(Request $request)
    {
        $driver = 'github';
        if (Auth::check() && Auth::user()->register_source == $driver) {
            return redirect('/');
        }

        return Socialite::driver($driver)->redirect();
    }


    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleGithubProviderCallback(Request $request)
    {
        $driver = 'github';

        if (
        (Auth::check() && Auth::user()->register_source == $driver) // If is github register user signined.
        ) {
            return redirect()->intended('/');
        }

        $oauthUser = Socialite::driver($driver)->user();
        $user = $this->userRepository->getFirstRecordByWhere([$driver . '_id' => $oauthUser->id]);// Select database is existence the user.

        if (Auth::check()) {  // TODO
            if ($user && $user->id != Auth::id()) {
                flash('error', 'Sorry, this socialite account has been registed.', ['driver' => $driver]);
            } else {
                return '绑定账号功能待完善';
            }

        } else {
            if ($user) {
                if ($user->status < 1) return $this->accountDisabled();
                return $this->loginUser($user);
            }
            return $this->userNotFound($driver, $oauthUser);
        }
    }

}
