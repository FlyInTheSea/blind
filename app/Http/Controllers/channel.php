<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\api;
use Illuminate\Http\Request;

class channel extends api
{
    //

    function all()
    {
        $data =
            \App\channel::all()->all();
        $data = array_map(function ($item) {
            return [
                "value" => $item["id"],
                "display_name" => $item["name_alias"]
            ];
        }, $data);
        return
            $this->respond(
                $data
            );
    }

    function store(Request $request)
    {

        $data = $request->except(["_method", "s", "deleted_at"]);

        $save_result = \App\channel::firstOrCreate($data);

        if ($save_result) {
            return $this->respond($save_result);
        } else {
            return $this->respond_with_error();
        }

    }

    function index(Request $request)
    {
        $data = \App\channel::where("status", "=", 0)
            ->orderBy("created_at", "desc")
            ->paginate();
        if (!$data)
            return $this->respond_not_found();

        return $this->respond($data);
    }


    function update(Request $request)
    {
        $form_data = $request->except(["_method", "s", "deleted_at"]);
        $channel = \App\channel::find($request->id);
        $save_result = $channel->update($form_data);
        if ($save_result) {
            return $this->respond_update_success($channel);
        } else {
            return $this->respond_update_error_for_bad_validate();
        }
    }


    function edit(Request $request)
    {
        return $this->respond(
//            new \App\Http\Resources\table_strucutre(
            \App\channel::find($request->channel)
//            )
        );

    }


    function destroy(Request $request)
    {
        $id = (int)$request->channel;

        $channel = \App\channel::destroy($id);

        return $this->respond(
            $channel
        );
    }
}
