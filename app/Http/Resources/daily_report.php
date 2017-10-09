<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class daily_report extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {

        return [
            "id"=>$this->id,
            "status" => $this->status,
            "phone_num" => (int)$this->phone_num,
            "valid_user_num" => $this->valid_user_num,
            "dispatched_order_num" => $this->dispatched_order_num,
            "visited_user_num" => $this->visited_user_num,
            "deal_num" => $this->deal_num,
            "sale_amount" => $this->sale_amount,
            "consume" => $this->consume,
            "deposit" => $this->deposit,
            "consult" => $this->consult,
            "cover" => $this->cover,
            "report_date" => $this->change_int_to_timestamp($this->report_date),
            "city_id" => $this->city_id,
            "channel_id" => $this->channel_id,
            "enrollment_num" => $this->enrollment_num,
        ];
    }

    function change_int_to_timestamp($date) //20170920
    {
        return (int)Carbon::createFromFormat("Ymd", $date)->timestamp * 1000;
    }
}
