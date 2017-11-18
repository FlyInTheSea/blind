<?php

namespace App\Http\Controllers;

use App\Http\Controllers\crud\crud;
use Illuminate\Http\Request;

class permission extends crud
{
    function all()
    {
        $data = \App\permission::all()->all();

        $data = array_map(function ($item) {
            return [
                "id" => $item["id"],
                "name" => $item["name"]
            ];
        }, $data);
        return
            $this->respond(
                $data
            );
    }
}
