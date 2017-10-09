<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 9/14/17
 * Time: 11:57 AM
 */

namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;


class api extends Controller
{
    protected $status_code = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @param mixed $status_code
     */
    public function setStatusCode($status_code)
    {
        $this->status_code = $status_code;
        return $this;
    }

    function respond_update_error_for_bad_validate($message = "更新失敗")
    {
        return $this->setStatusCode(400)->respond_with_error($message);
    }


    function respond_update_success($data)
    {
        return $this->respond($data);
    }


    function respond_not_found($message = "沒找到")
    {
        return $this->setStatusCode(404)->respond_with_error($message);
    }



    function respond_with_no_login($message = "")
    {
        return $this->respond([
            "error" => [
                "message" => $message,
                "status_code" => $this->getStatusCode()
            ]
        ]);
    }


    function respond_with_error($message)
    {
        return $this->respond([
            "error" => [
                "message" => $message,
                "status_code" => $this->getStatusCode()
            ]
        ]);
    }


    function respond($data, $header = [])
    {
        $data = [
            "data" => $data,
            "status_code" => $this->getStatusCode(),
        ];
        return Response::json($data, $this->getStatusCode(), $header);
    }
}


/**
 * todo
 * refactor response
 * edit add finished button change
 * authenticate
 *
 */