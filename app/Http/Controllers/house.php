<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\api;
use App\Http\Controllers\crud\crud;
use Illuminate\Http\Request;

class house extends crud
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    function index(Request $request)
    {

        try {
            $data = \App\house::where(
                []
            )
                ->orderBy("created_at", "desc")
                ->paginate();

            $data["data"] = $data->map(
                function ($house) {
                    $house->community_id = $house->community->name;
                    return $house;
                }
            );

            if (!$data)
                return $this->respond_not_found();
            return $this->respond($data);
        } catch (\Throwable $exception) {
            return $this->respond_with_error($exception->getMessage());
        }

    }

    function payment(\App\house $house)
    {
        return $this->respond(
            $house->contract_fund()
                ->paginate());
    }


    function read_from_execel()
    {
        $file_path = "/home/zhu/zzz.ods";

        return $file_path;
    }
}
