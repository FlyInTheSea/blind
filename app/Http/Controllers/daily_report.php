<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\api\api;
use Illuminate\Support\Facades\Input;

class daily_report extends api
{


    /**
     * daily_report constructor.
     */

    function edit(Request $request)
    {
        return $this->respond(
            new \App\Http\Resources\daily_report(
                \App\daily_report::find($request->daily_report)
            )
        );

    }

    function store(Request $request)
    {
        $data = $request->all();

        if (isset($request->report_date)) {
            $data["report_date"] = $this->change_timestamp_to_int($data["report_date"]);
        } else {
            //如果没有输入　默认是今天
            $data["report_date"] = (int)Carbon::now()->format("Ymd");
        }
        $save_result = \App\daily_report::firstOrCreate($data);

        if ($save_result) {
            return $this->respond($save_result);
        } else {
            return $this->respond_with_error();
        }

    }

    function change_timestamp_to_int($timestamp)
    {
        return (int)Carbon::createFromTimestamp($timestamp / 1000)->format("Ymd");
    }


    function index(Request $request)
    {
        $data = \App\daily_report::where("status", "=", 0)
            ->orderBy("created_at", "desc")
            ->paginate();
        if (!$data)
            return $this->respond_not_found();

        return $this->respond($data);
    }

    function update(Request $request)
    {
        $form_data = $request->except(["_method", "s", "deleted_at"]);
        $table_structure = \App\daily_report::find($request->id);
        $form_data["report_date"] = $this->change_timestamp_to_int($form_data["report_date"]);
        $save_result = $table_structure->update($form_data);
        if ($save_result) {
            return $this->respond_update_success($table_structure);
        } else {
            return $this->respond_update_error_for_bad_validate();
        }
    }


    function destroy(Request $request)
    {
        $id = (int)$request->daily_report;

        $daily_report = \App\daily_report::destroy($id);

        return $this->respond(
            $daily_report
        );
    }

}
