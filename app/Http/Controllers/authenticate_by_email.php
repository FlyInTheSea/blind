<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 24/10/17
 * Time: 16:53
 */


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\login as login_mail;
use Illuminate\Http\Request;
use Mockery\Exception;

trait authenticate_by_email
{
    protected $request;
    protected $access_token;


    function invite(Request $request)
    {
        $this->request = $request;
        $this->validateLogin()
            ->create_token()
            ->send();
    }

    function create_token()
    {
        $user = \App\User::where([
            "email" => $this->request->email
        ])->first();

        if (!$user) {
            throw new Exception("用户不存在");
        }

        $this->access_token = $user->createToken('Admin')->accessToken;

        return $this;

    }

    protected function validateLogin()
    {
        $this->request->validate([
            $this->username() => 'required|email',
        ]);

        return $this;
    }

    function send()
    {
        Mail::to([
            "email" => $this->request->email,
        ])->send(
            new login_mail([
                "access_token" => $this->access_token
            ])
        );
        return $this;
    }

    public function username()
    {
        return 'email';
    }

}