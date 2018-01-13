<?php

namespace App\Http\Controllers;

use App\Http\Controllers\crud\crud;
use Illuminate\Http\Request;

class customer_owner extends crud
{

    function index(Request $request)
    {

        $where = json_decode($request->query_params, true);
        $where = array_map(function ($key, $val) {
            return [
                $key,
                "=",
                $val
            ];
        }, array_keys($where), $where);
        try {
            $data = \App\customer_owner::where(
                []
            )
                ->orderBy("created_at", "desc")
                ->where(
                    $where
                )
                ->paginate();
            if (!$data)
                return $this->respond_not_found();
            return $this->respond($data);
        } catch (\Throwable $exception) {
            return $this->respond_with_error($exception->getMessage());
        }

    }

}
