<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\api;
use Illuminate\Http\Request;

class house extends api
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index(Request $request)
    {
        $data = \App\house::orderBy("created_at", "desc")
            ->paginate();
        if (!$data)
            return $this->respond_not_found();

        return $this->respond($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    function store(Request $request)
    {

        $data = $request->except(["_method", "s", "deleted_at"]);

        $save_result = \App\house::firstOrCreate($data);

        if ($save_result) {
            return $this->respond($save_result);
        } else {
            return $this->respond_with_error();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    function edit(Request $request)
    {
        return $this->respond(
//            new \App\Http\Resources\table_strucutre(
            \App\house::find($request->house)
//            )
        );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    function update(Request $request)
    {
        $form_data = $request->except(["_method", "s", "deleted_at"]);
        $house = \App\house::find($request->id);
        $save_result = $house->update($form_data);
        if ($save_result) {
            return $this->respond_update_success($house);
        } else {
            return $this->respond_update_error_for_bad_validate();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    function destroy(Request $request)
    {
        $id = (int)$request->house;

        $channel = \App\house::destroy($id);

        return $this->respond(
            $channel
        );
    }
}
