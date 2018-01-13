<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\api;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\Request;
use function React\Promise\reduce;

class overview extends api
{
    //
    function community(\App\community $community)
    {


        return $this->respond(
            [
                [
                    "name" => "房屋总数量",
                    "id" => $community->house_amount()
                ],
                [
                    "name" => "已签订合约房屋总额",
                    "id" => $community->contract_amount()
                ],
                [
                    "name" => "已售出合约对应佣金",
                    "id" => $community->contract_amount_commission()
                ],
                [
                    "name" => "已收回资金",
                    "id" => $community->one_community_withdraw_money()
                ],
                [
                    "name" => "佣金比率",
                    "id" => $community->commission
                ],
                [
                    "name" => "应获得佣金",
                    "id" => $community->one_community_withdraw_money() * $community->commission
                ],
                [
                    //
                    "name" => "认购金额",
                    "id" => $community->one_community_subscribe_amount()
                ],
                [
                    "name" => "无认购房屋数量",
                    "id" => $community->selling_house_number()
                ],
                [
                    "name" => "已有意向客户房屋数量",
                    "id" => $community->have_someone_will_tosubscribe_house_number()
                ],
                [
                    "name" => "已认购房屋数量",
                    "id" => $community->subscribed_house_number()
                ],
                [
                    "name" => "已签合同房屋数量",
                    "id" => $community->contract_house_number()
                ],
                [
                    "name" => "已售出且收回全款房屋数量",
                    "id" => $community->sold_house_number()
                ],

                [
                    "name" => "已售出且收回全款房屋数量",
                    "id" => $community->sold_house_number()
                ],

//                [
//                    "name" => "贷款待收回金额",
//                    "id" => $community->one_community_bank_balance()
//                ],

//                [
//                    "name" => "全款待收回金额",
//                    "id" => $community->sold_house_number()
//                ],
            ]
        );


        // 每日 净资金流入

        // 每日 总资金流入

        // 每日 总资金流出

    }

    function community_channel_twelve(\App\community $community)
    {
        return $this->respond($community->channel_twelve());
    }

    function community_district_twelve(\App\community $community)
    {
        return $this->respond($community->district_twelve());
    }

    function community_motive_twelve(\App\community $community)
    {
        return $this->respond($community->motive_twelve());
    }

    function community_sex_twelve(\App\community $community)
    {
        return $this->respond($community->sex_twelve());
    }

    function community_apartment_layout_twelve(\App\community $community)
    {
        return $this->respond($community->apartment_layout_twelve());
    }

    function community_family_twelve(\App\community $community)
    {
        return $this->respond($community->family_twelve());
    }

    function community_district(\App\community $community)
    {
        return $this->respond($community->district());
    }

    function community_sex(\App\community $community)
    {
        return $this->respond($community->sex());
    }

    function community_channel(\App\community $community)
    {
        return $this->respond($community->channel_id());
    }

    function community_family(\App\community $community)
    {
        return $this->respond($community->family());
    }

    function community_apartment_layout(\App\community $community)
    {
        return $this->respond($community->apartment_layout());
    }

    function community_motive(\App\community $community)
    {
        return $this->respond($community->motive());
    }


    function data_merge_with_empty_month_date($data)
    {
        return array_reduce(
            $data,
            function ($carry, $item) {

                $key = array_search(
                    [
                        "value" => 0,
                        "month" => $item["month"]
                    ], $carry
                );
                $item["value"] = floatval($item["value"]);
                $carry[$key] = $item;
                return $carry;
            },
            $this->generate_one_year_month_array()
        );

    }

    function data_merge_with_empty_day_date($data)
    {
        return array_reduce(
            $data,
            function ($carry, $item) {

                $key = array_search(
                    [
                        "value" => 0,
                        "day" => $item["day"]
                    ], $carry
                );
                $item["value"] = floatval($item["value"]);
                $carry[$key] = $item;
                return $carry;
            },
            $this->generate_one_year_day_array()
        );

    }


    function one_year_sell_station_by_month(\App\community $community)
    {
        // 特定时间 套数 面积 金额  回款
        // 每天     套数 面积 金额
        //  回款

        $number = $this->data_merge_with_empty_month_date($community->sell_house_number_one_year_by_month()->toArray());
        $amount = $this->data_merge_with_empty_month_date($community->sell_house_amount_one_year_by_month()->toArray());
        $area = $this->data_merge_with_empty_month_date($community->sell_house_area_one_year_by_month()->toArray());
        $withdraw = $this->data_merge_with_empty_month_date($community->sell_house_withdraw_one_year_by_month()->toArray());


        $date = array_map(
            function ($item) {
                return $item["month"];
            }, $number
        );

        $number = array_map(
            function ($item) {
                return $item["value"];
            }, $number
        );
        $amount = array_map(
            function ($item) {
                return $item["value"];
            }, $amount
        );
        $area = array_map(
            function ($item) {
                return $item["value"];
            }, $area
        );
        $withdraw = array_map(
            function ($item) {
                return $item["value"];
            }, $withdraw
        );

        $data = [
            "date" => [
                "data" => $date,
                "name" => "日期"
            ],
            "number" => [
                "data" => $number,
                "name" => "套数"
            ],
            "sales_amount" => [
                "data" => $amount,
                "name" => "合约金额"
            ],
            "area" => [
                "data" => $area,
                "name" => "面积"
            ],
            "withdraw" => [
                "data" => $withdraw,
                "name" => "回款金额"
            ],
        ];

        return $this->respond($data);
    }


    function one_year_sell_station_by_day(\App\community $community)
    {
        // 特定时间 套数 面积 金额  回款
        // 每天     套数 面积 金额
        //  回款


        $number = $this->data_merge_with_empty_day_date($community->sell_house_number_one_year_by_day()->toArray());
        $amount = $this->data_merge_with_empty_day_date($community->sell_house_amount_one_year_by_day()->toArray());
        $area = $this->data_merge_with_empty_day_date($community->sell_house_area_one_year_by_day()->toArray());
        $withdraw = $this->data_merge_with_empty_day_date($community->sell_house_withdraw_one_year_by_day()->toArray());

        $date = array_map(
            function ($item) {
                return $item["day"];
            }, $number
        );

        $number = array_map(
            function ($item) {
                return $item["value"];
            }, $number
        );
        $amount = array_map(
            function ($item) {
                return $item["value"];
            }, $amount
        );
        $area = array_map(
            function ($item) {
                return $item["value"];
            }, $area
        );
        $withdraw = array_map(
            function ($item) {
                return $item["value"];
            }, $withdraw
        );
        $data = [
            "date" => [
                "data" => $date,
                "name" => "日期"
            ],
            "number" => [
                "data" => $number,
                "name" => "套数"
            ],
            "sales_amount" => [
                "data" => $amount,
                "name" => "合约金额"
            ],
            "area" => [
                "data" => $area,
                "name" => "面积"
            ],
            "withdraw" => [
                "data" => $withdraw,
                "name" => "回款金额"
            ],
        ];

        return $this->respond($data);
    }


    function generate_one_year_month_array()
    {
        $last_year_month_number = (new \Carbon\Carbon("last year"));

        return array_reduce(
            range(1, 12),
            function ($carry, $item) use ($last_year_month_number) {

                $item = [
                    "value" => 0,
                    "month" => (int)$last_year_month_number->format("Ym"),
                ];
                $last_year_month_number->addMonth(1);

                $carry[] = $item;
                return $carry;

            }, []
        );

    }


    function generate_one_year_day_array()
    {
        $last_year_month_number = (new \Carbon\Carbon())->subDays(365);

        return array_reduce(
            range(1, 365),
            function ($carry, $item) use ($last_year_month_number) {

                $item = [
                    "value" => 0,
                    "day" => (int)$last_year_month_number->format("Ymd"),
                ];
                $last_year_month_number->addDay();

                $carry[] = $item;
                return $carry;

            }, []
        );

    }

    function data_merge_with_empty_month_date_for_just_value($data)
    {
        return array_reduce(
            $data,
            function ($carry, $item) {
                $this->generate_one_year_month_array();


                $key = array_search(
                    [
                        "value" => 0,
                        "month" => $item["month"]
                    ], $carry
                );
                $item["value"] = floatval($item["value"]);
                $carry[$key] = $item;
                return $carry;
            }, []
        );

    }


    function sell_station_by_custom(\App\community $community)
    {
        $begin = 20180101;
        $end = 20180101;
        $community->contract()->where(
            [
                [
                    "date", ">", $begin
                ],
                [
                    "date", "<", $end
                ]
            ]
        );
    }

}
