<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\api;
use App\Http\Controllers\crud\crud;
use Illuminate\Http\Request;


class community extends crud
{

    function all()
    {
        $data = \App\community::all()->all();
        return $this->respond(
            $data
        );
    }

    function search()
    {
        return $this->respond(\App\community::search("张家口")->get());
    }

}
