<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\api\api;
use App\Http\Controllers\authenticates_user;
use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\Http\Controllers\HandlesOAuthErrors;
use Mockery\Exception;

use App\Http\Controllers\authenticate_by_email;


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

    use authenticate_by_email;
    use HandlesOAuthErrors;

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
    function __construct()
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

    function login(Request $request)
    {
        try {
            $this->invite($request);
            return $this->respond([]);
        } catch (\Throwable $exception) {
            return $this->respond_with_error($exception->getMessage());
        }
    }

}
