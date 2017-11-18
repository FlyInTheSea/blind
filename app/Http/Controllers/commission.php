<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\api;
use App\Http\Controllers\crud\crud;
use Illuminate\Http\Request;

class commission extends crud
{
    function user_commission(\App\User $user)
    {
        $user_commission = $user->commission()
            ->paginate();


        foreach ($user_commission as $commission) {

            $commission->community_id = $commission->community->name;
        }

        return $this->respond(
            $user_commission);

    }

    function user_commission_amount(\App\User $user)
    {
        return $this->respond(
            [
                [
                    "name" => "总佣金",
                    "id" => $user->commission_amount()
                ]
            ]
        );
    }

}
