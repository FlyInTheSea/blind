<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\api\api;
use App\Http\Controllers\authenticates_user;
use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\Http\Controllers\HandlesOAuthErrors;
use Mockery\Exception;

class LoginController extends api
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a Traits
    | to conveniently provide its functionality to your applications.
    |
    */

    use HandlesOAuthErrors;
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    function index()
    {
        $this->setStatusCode(403)->respond_with_error("please login ");
    }

    protected function guard()
    {
        return Auth::guard("api");
    }

    public function authenticate($email, $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
    }

    function login(authenticates_user $authenticates_user,Request $request)
    {
        $authenticates_user->invite($request);
    }

}
