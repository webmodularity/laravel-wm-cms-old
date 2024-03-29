<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use WebModularity\LaravelUser\Http\Controllers\Auth\AuthenticatesUsersAndSocialUsers;

class LoginController extends Controller
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

    use AuthenticatesUsersAndSocialUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        $this->middleware('auth.social_users_allowed')->only(['redirectSocialUser', 'loginSocialUser']);
    }
}
