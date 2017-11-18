<?php

namespace App\Http\Controllers;

use App\Http\Controllers\crud\crud;
use App\Traits\change_timestamp_to_int;
use Illuminate\Http\Request;
use Mockery\Exception;

class fund extends crud
{
    use change_timestamp_to_int;

    function store(Request $request)
    {

        if ($request->reason_id == 1) {
            return $this->subscribe_fund($request);
        }

        if ($request->reason_id == 2) {
            return $this->contract_payment_fund($request);
        }


    }

    function contract_payment_fund(Request $request)
    {
        try {
            $data = $request->except(["_method", "s", "deleted_at"]);

            $house = \App\house::find((int)$request->house_id);

            if ($house->status !== 4) {
                return $this->respond_with_error("房屋 状态不对");
            }
            $amount = $request->amount;
            $this->contract_pay($house, $amount, $data);

            return $this->respond($data);

        } catch (\Exception $exception) {
            return $this->respond_with_error($exception->getMessage());
        }

    }


    function contract_pay(\App\house $house, $amount, $data)
    {
//        $house->fund()

        if (($over = $house->contract->amount - $amount - $house->contract_already_payment()) < 0) {
            throw new Exception("超出金额" . -$over);
        }

        if ($house->contract->amount - $amount - $house->contract_already_payment() == 0) {
            $house->change_to_finish_status();
        }

        $data["date"] = $this->change_js_timestamp_to_Ymd_format($data["date"]);

        \App\fund::create($data);

        $commission = new \App\commission();

        $commission->generate_all_person_commission($house, $amount);

    }


    function subscribe_fund(Request $request)
    {
        try {
            $data = $request->except(["_method", "s", "deleted_at"]);


            $house = \App\house::find((int)$request->house_id);

            if ($house->status !== 2) {
                return $this->respond_with_error("房屋 状态不对");
            }

            $data["date"] = $this->change_js_timestamp_to_Ymd_format($data["date"]);
            $save_result = \App\fund::firstOrCreate($data);

            $house->change_to_subscribed_status();

            return $this->respond($save_result);
        } catch (\Exception $exception) {
            return $this->respond_with_error($exception->getMessage());
        }

    }

    function print_fund()
    {

    }

}
