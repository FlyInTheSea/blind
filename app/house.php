<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class house extends Model
{
    //
    protected $guarded = [
        "id",
    ];

    function trans()
    {
        $this->joiningTable("");
    }

    function community()
    {
        return $this->belongsTo(community::class);
    }

    function change_to_subscribed_status()
    {
        $this->status = 3;

        $this->save();

        return $this;
    }


    function change_to_contract_status()
    {
        $this->status = 4;

        $this->save();

        return $this;
    }

    function change_to_finish_status()
    {
        $this->status = 0;

        $this->save();

        return $this;
    }

    function house_owner()
    {
        return $this->hasOne(house_owner::class);
    }

    function fund()
    {
        return $this->hasMany(fund::class);
    }


    function contract()
    {
        return $this->hasOne(contract::class);
    }


    function contract_fund()
    {
        return
            $this->fund()
                ->where("reason_id", "=", 2);
    }

    function contract_already_payment()
    {
        return $this->contract_fund()->sum("amount");
    }



}
