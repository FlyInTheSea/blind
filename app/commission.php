<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;

class commission extends Model
{

    protected $table = "commission";

    protected $guarded = [
        "id"
    ];

    function community(){
        return $this->belongsTo(community::class);
    }


    function generate_all_person_commission(house $house, $amount)
    {
        $this->generate_direct_saleman_commission($house, $amount)
            ->generate_leader_commission($house, $amount);
    }

    private function generate_leader_commission(house $house, $amount)
    {

        try {

            foreach ($house->community->community_role as $role) {

                $this->create([
                    "house_id" => $house->id,
                    "community_id" => $house->community->id,
                    "user_id" => $role->user_id,
                    "role" => $role->name,
                    "rate" => $role->commission_rate,
                    "commission" => $amount * $role->commission_rate,
                    "amount" => $amount,
                ]);
            }
        } catch (\throwable $exception) {
            throw new exception("计算非直接销售人员佣金错误" . $exception->getMessage());
        }

        return $this;
    }

    private function generate_direct_saleman_commission(house $house, $amount)
    {
        try {

            $this->create([
                "house_id" => $house->id,
                "community_id" => $house->community->id,
                "user_id" => $house->house_owner->customer->customer_owner->user_id,
                "role" => "直接销售人员",
                "rate" => $house->community->sales_commission,
                "commission" => $amount * $house->community->sales_commission,
                "amount" => $amount,
            ]);

        } catch (\Throwable $exception) {
            throw new Exception("计算直接销售人员佣金错误" . $exception->getMessage());
        }

        return $this;

    }

}
