<?php

namespace App\Http\Controllers;

use App\Http\Controllers\crud\crud;
use App\Traits\change_timestamp_to_int;
use Illuminate\Http\Request;

class contract extends crud
{
    use change_timestamp_to_int;

    function store(Request $request)
    {
        try {


            $data = $request->except(["_method", "s", "deleted_at"]);

            $house = \App\house::find((int)$request->house_id);

            if ($house->status !== 3) {
                return $this->respond_with_error("房屋 状态不对");
            }


            $data["customer_id"] = $house->house_owner->id;
            $data["date"] = $this->change_js_timestamp_to_Ymd_format($data["date"]);

            $fund = \App\fund::where(
                [
                    [
                        "house_id", "=", (int)$request->house_id,
                    ],
                    ["reason_id", "=", 1],
                ]
            )->first();

            $fund->reason_id = 2;

            $fund->save();


            $data["amount"] = $data["price"] * $house->area;

            $save_result = \App\contract::firstOrCreate($data);

            $house->change_to_contract_status();
            return $this->respond($save_result);
        } catch (\Exception $exception) {
            return $this->respond_with_error($exception->getMessage());
        }
    }


}
