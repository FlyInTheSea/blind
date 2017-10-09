<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\api;
use App\Http\Resources\table_strucutres as table_structures_resource;
use App\Http\Resources\table_strucutre as table_structure_resource;
use function foo\func;
use Illuminate\Http\Request;

class table_structure extends api
{
    //
    function items_by_table_structure_name(Request $request)
    {

        $id = $request->name;

        $columns = \App\table_structure::find($id)->columns;
        return json_encode($columns);

    }


    function table_strucutres_in_single_format()
    {

        $table_structure = \App\table_structure::all()->toArray();
        $table_structure_single_format = array_map(function ($item) {
            $item["name"] = str_singular($item["name"]);
            return $item;
        }, $table_structure);
        return $table_structure_single_format;
    }


    function store(Request $request)
    {
        $data = $request->except(["_method", "s", "deleted_at"]);

        $save_result = \App\table_structure::firstOrCreate($data);

        if ($save_result) {
            return $this->respond($save_result);
        } else {
            return $this->respond_with_error();
        }

    }

    function all()
    {
        $data = \App\table_structure::all();
        return $this->respond(table_structure_resource::collection($data));
    }

    function all_in_plural()
    {
        $data = \App\table_structure::all();
        return $this->respond($data);
    }


    function index(Request $request)
    {
        $data = \App\table_structure::where("status", "=", 0)
            ->orderBy("created_at", "desc")
            ->paginate();
        if (!$data)
            return $this->respond_not_found();

        return $this->respond($data);
    }


    function edit(Request $request)
    {
        return $this->respond(
//            new \App\Http\Resources\table_strucutre(
            \App\table_structure::find($request->table_structure)
//            )
        );

    }


    function destroy(Request $request)
    {
        $id = (int)$request->table_structure;

        $table_structure = \App\table_structure::destroy($id);

        return $this->respond(
            $table_structure
        );
    }

    function update(Request $request)
    {
        $form_data = $request->except(["_method", "s", "deleted_at"]);
        $table_structure = \App\table_structure::find($request->id);
        $save_result = $table_structure->update($form_data);
        if ($save_result) {
            return $this->respond_update_success($table_structure);
        } else {
            return $this->respond_update_error_for_bad_validate();
        }
    }
}
