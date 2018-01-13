<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\api;
use App\Http\Controllers\crud\crud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class house extends crud
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function single_where_option_array($key, $val, $method)
    {
        if ($method === "equal") {
            return [
                $key, "=", $val
            ];
        } else if ($method === "") {

        }
    }

    function process_receive_where_options_to_sql_array($receive_options)
    {
        $where_preset_options = [
            "community_id" => "equal",
            "number" => "equal",
            "entrance" => "equal",
            "unit" => "equal",
            "floor" => "equal",
        ];


        $where = [];

        foreach ($where_preset_options as $key => $val) {
            if (!isset($receive_options[$key])) {
                continue;
            }
            $where[] = $this->single_where_option_array(
                $key,
                $receive_options[$key],
                $where_preset_options[$key]
            );
        }
        return $where;
    }

    function index(Request $request)
    {


        try {
            $where = json_decode(
                ($request->query_params), true
            )["where"];

            $where = $this->process_receive_where_options_to_sql_array($where);

        } catch (\Throwable $exception) {
            $where = [];
        }


        try {
            $data = \App\house::where(
                $where
            )
                ->orderBy("updated_at", "desc")
                ->paginate();
            $data->map(
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

}
