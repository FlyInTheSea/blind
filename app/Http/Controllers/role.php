<?php

namespace App\Http\Controllers;

use App\Http\Controllers\crud\crud;
use Faker\Generator;

class role extends crud
{
    function all()
    {
        $data = \App\role::all()->all();

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

    function create(Generator $faker)
    {

        \App\role::create(
            [
                "name" => $faker->city,
                "display_name" => "am",
                "description" => "我是描述"
            ]
        );
        return "Fuck";
    }
}
