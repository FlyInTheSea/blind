<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\api;
use Illuminate\Http\Request;

class contract_template extends api
{
    //
    function store(Request $request)
    {
        $data = $request->except(["_method", "s", "deleted_at"]);
        try {

            $contract_template = \App\contract_template::where(
                "community_id",
                "=",
                (int)$request->community_id
            )->first();

            !$contract_template && ($contract_template = new \App\contract_template());

            $contract_template->content = $request->data;

            $contract_template->save();
            return $this->respond($contract_template);
        } catch (\Exception $exception) {
            return $this->respond_with_error($exception->getMessage());
        }
    }


    function show(Request $request)
    {
        $community_id = $request->contract_template;

        try {
            $content = \App\community::find($community_id)
                ->contract_template->content;
        } catch (Throwable $throwable) {
            $content = "";
        }

        return $this->respond(
            $content
        );

    }

}
