<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 01/10/17
 * Time: 14:07
 */


namespace App\Http\Controllers\crud;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\api\api;
use App;

class crud extends api
{
    //
    protected $class;

    function __construct()
    {
        $class = (new \ReflectionClass($this))->getShortName();
        $class = sprintf("\App\%s", $class);
        $this->class = $class;
    }

    function store(Request $request)
    {
        $data = $request->except(["_method", "s", "deleted_at"]);

        try {
            $save_result = ($this->class)::firstOrCreate($data);
            return $this->respond($save_result);
        } catch (\Exception $exception) {
            return $this->respond_with_error($exception->getMessage());
        }
    }

    function index(Request $request)
    {


        try {
            $data = ($this->class)::where(
                []
            )
                ->orderBy("created_at", "desc")
                ->paginate();
            if (!$data)
                return $this->respond_not_found();
            return $this->respond($data);
        } catch (\Throwable $exception) {
            return $this->respond_with_error($exception->getMessage());
        }

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
