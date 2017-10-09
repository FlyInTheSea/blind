<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\api;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

use App\Mail\login;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\Http\Controllers\HandlesOAuthErrors;

class authenticates_user extends api
{
    //
    use HandlesOAuthErrors;

    protected $access_token;

    protected $request;

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * @param mixed $access_token
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }


    function __construct(Request $request)
    {
        $this->request = $request;
    }


    function invite(Request $request)
    {
        return $this->validateLogin()
            ->create_token()
            ->send();
    }

    function create_token()
    {
        $message = $this->withErrorHandling(
            function () {
                $http = new Client;
                $url = 'http://c.sc.cc/oauth/token';
                $response = $http->post(
                    $url,
                    [
                        'form_params' => [
                            'grant_type' => 'password',
                            'client_id' => 1,
                            'client_secret' => 'hMZZAxHZBQspqGX3IZsoasQXHuTUIeTipxlv9Krg',
                            'username' => $this->request->email,
                            'password' => '123456',
                            'scope' => '*',
                        ],
                    ]);
                return json_decode((string)$response->getBody(), true);

            }
        );
        //success 返回 array fail 返回 object
        if (is_array($message)) {
            $accessToken = $message["access_token"];
            $authroization = $message["token_type"] . " " . $accessToken;
            $this->access_token = $accessToken;
        } else if (is_object($message)) {
            return $this->setStatusCode($message->getStatusCode())->respond_with_error((string)$message);
        }
        return $this;
    }


    protected function validateLogin()
    {
        $this->validate($this->request, [
            $this->username() => 'required|string',
        ]);
        return $this;
    }

    function send()
    {

        $re = Mail::to([
            "email" => $this->request->email,
        ])->send(
            new login([
                "access_token" => $this->access_token
            ])
        );
        return $this->respond($re);
    }

    public function username()
    {
        return 'email';
    }

}
