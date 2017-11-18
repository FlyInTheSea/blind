<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer_info extends Model
{
    public $table = "customer_info";

    protected $guarded = [];

    //


    function district_name($val)
    {
        $con = \App\config_transformation::where([
            [
                "column_id",
                "=",
                78,
            ],
            [
                "table_structure_id",
                "=",
                13,
            ],
            [
                "value",
                "=",
                $val,
            ],
        ])->get();
        return $con[0]->name;
    }

    function district_sex($val)
    {
        $con = \App\config_transformation::where([
            [
                "column_id",
                "=",
                75,
            ],
            [
                "table_structure_id",
                "=",
                13,
            ],
            [
                "value",
                "=",
                $val,
            ],
        ])->get();
        return $con[0]->name;
    }

    function district_family($val)
    {
        $con = \App\config_transformation::where([
            [
                "column_id",
                "=",
                76,
            ],
            [
                "table_structure_id",
                "=",
                13,
            ],
            [
                "value",
                "=",
                $val,
            ],
        ])->get();
        return $con[0]->name;
    }

    function district_map($val, $item)
    {


        $map = [
            "motive" => 77,
            "apartment_layout" => 82,
            "family"=>76,
            "sex"=>75,
            "district_id"=>78
        ];
        $column = $map[$item];
        $con = \App\config_transformation::where([
            [
                "column_id",
                "=",
                $column,
            ],
            [
                "table_structure_id",
                "=",
                13,
            ],
            [
                "value",
                "=",
                $val,
            ],
        ])->get();
        return $con[0]->name;
    }

    function channel($val)
    {

        return channel::where(
            [
                [
                    "community_id", "=",$this->community_id
                ],
                [
                    "value", "=", $val
                ]
            ]
        )->get()[0];
    }


}

