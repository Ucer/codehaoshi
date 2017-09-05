<?php

namespace App\Http\Controllers\Auth;

use App\Codehaoshi\Creators\UserCreator;
use App\Codehaoshi\Listeners\UserCreatorListener;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\Traits\SocialiteHelper;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;
use Auth;
use Carbon\Carbon;

class LoginController extends Controller implements UserCreatorListener
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, SocialiteHelper;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('guest')->except('logout');
        $this->userRepository = $userRepository;
    }

//    public function username()
//    {
//        return ['user_name','email'];
//    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.signin');
    }

    /**
     * ----------------------------------------
     * GithubAuthenticatorListener Delegate
     * ----------------------------------------
     */
    public function userNotFound($driver, $registerUserData)
    {
        if ($driver == 'github') {
            $oauthData['image_url'] = $registerUserData->avatar;
            $oauthData['github_id'] = $registerUserData->user['id'];
            $oauthData['github_name'] = $registerUserData->user['login'];
            $oauthData['nickname'] = $registerUserData->nickname;
            $oauthData['user_name'] = $registerUserData->user['login'];
            $oauthData['email'] = $registerUserData->email;
        } elseif ($driver == 'wechat') {
            return '暂不支持微信登录';
        }
        $oauthData['register_source'] = $driver;
        $oauthData['status'] = 1;
        $oauthData['password'] = '';

        Session::put('oauthData', $oauthData);

        return app(UserCreator::class)->create($this, $oauthData);
    }

    /**
     * Implements UserCreatorLister
     *
     * @param  [type] $errors [description]
     * @return [type]         [description]
     */
    public function userValidationError($errors)
    {
        return redirect('/');
    }

    /**
     * Implements UserCreatorLister.
     * When user was created success, excute this method
     *
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    public function userCreated($user)
    {
        $this->userRepository->save($user, ['last_actived_at' => Carbon::now()]);

        Auth::login($user, true);
        Session::forget('oauthData');

        flash('info', lang('login_Successful'));
        return redirect('/');
    }

    /**
     * User's account had been disabled
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function accountDisabled()
    {
        Session::forget('oauthData');
        flash('error', lang('sorry,your account has been disabled.'));
        return redirect('/');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        flash('info', lang('operation succeeded.'));
        return redirect('/');
    }

    /**
     * to login user
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    private function loginUser($user)
    {
        return $this->userCreated($user);
    }


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            flash('info', '登录成功');
            $this->userRepository->save(Auth::user(), ['last_actived_at' => Carbon::now()]);
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
