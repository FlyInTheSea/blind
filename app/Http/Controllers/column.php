<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\api;
use Illuminate\Http\Request;
use \App\table_structure;
use Illuminate\Support\Facades\DB;

class column extends api
{


    function item_by_table_name(Request $request)
    {
        $name = $request->name;
        if (preg_match("/^\d*$/", $name)) {
            $structure_table = table_structure::find((int)$name)->columns;
        } else
            $structure_table = table_structure::where("name", $name)->first()->columns;

        return $this->respond($structure_table);
    }


    function index(Request $request)
    {
        $data = \App\column::where("status", "=", 0)
            ->orderBy("created_at", "desc")
            ->paginate();
        if (!$data)
            return $this->respond_not_found();

        return $this->respond($data);
    }


    function store(Request $request)
    {
        $data = $request->all();

        $save_result = \App\column::firstOrCreate($data);

        if ($save_result) {
            return $this->respond($save_result);
        } else {
            return $this->respond_with_error();
        }

    }

    function update(Request $request)
    {
        $form_data = $request->except(["_method", "s", "deleted_at"]);
        $table_structure = \App\column::find($request->id);
        $save_result = $table_structure->update($form_data);
        if ($save_result) {
            return $this->respond_update_success($table_structure);
        } else {
            return $this->respond_update_error_for_bad_validate();
        }
    }


    function edit(Request $request)
    {
        return $this->respond(
//            new \App\Http\Resources\column(
            \App\column::find($request->column)
//            )
        );

    }


    function destroy(Request $request)
    {
        $id = (int)$request->column;

        $column = \App\column::destroy($id);

        return $this->respond(
            $column
        );
    }

}

