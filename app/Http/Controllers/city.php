<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\api;
use Illuminate\Http\Request;

use App\city as city_model;

class city extends api
{
    //

    function store(Request $request)
    {

        $form_data_json = $request->form_data;

        $form_data = json_decode($form_data_json, true);


        $save_result = \App\city::firstOrCreate($form_data);


        if ($save_result) {

            return json_encode($save_result);

        }

    }

    function all()
    {
        $data = \App\city::all()->all();
        $data = array_map(function ($item) {
            return [
                "value" => $item["id"],
                "display_name" => $item["name"]
            ];
        }, $data);
        return
            $this->respond(
                $data
            );
    }

    function index(Request $request)
    {


//        $form_data_json = $request->form_data;

//        $form_data = json_decode($form_data_json);

        $table_structure = \App\city::where("status", "=", 0)
            ->orderBy("created_at", "desc")
            ->get();

        $data = array_map(function ($item) {
            return [
                "value" => $item["id"],
                "display_name" => $item["name"]
            ];
        }, $table_structure);
        return $this->respond($data);

    }


    function show($id)
    {

        $city = \App\city::find($id);

        return json_encode($city);
    }

    function update(Request $request, int $id)
    {
        $form_data_json = $request->form_data;

        $form_data = json_decode($form_data_json);

        $table_structure = \App\city::find($id);
        $table_structure->name = $form_data->name;
        $table_structure->name_alias = $form_data->name_alias;
        $save_result = $table_structure->save();

        if ($save_result) {

            return json_encode($table_structure);
        }
    }
}
