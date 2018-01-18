<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;

class community extends Model
{
    //
    use Searchable;
    protected $guarded = [
        "id",
    ];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }

    public function contract_template()
    {
        return $this->hasOne(contract_template::class);
    }

    function community_role()
    {
        return $this->hasMany(community_role::class);
    }

    function house_amount()
    {
        return $this->hasMany(house::class)->count();
    }

    function selling_house_number()
    {
        return $this->hasMany(house::class)->where("status", "=", 1)->count();
    }

    //
    function have_someone_will_tosubscribe_house_number()
    {
        return $this->hasMany(house::class)->where("status", "=", 2)->count();
    }

    function subscribed_house_number()
    {
        return $this->hasMany(house::class)->where("status", "=", 3)->count();
    }

    function contract_house_number()
    {
        return $this->hasMany(house::class)->where("status", "=", 4)->count();
    }

    function sold_house_number()
    {
        return $this->hasMany(house::class)->where("status", "=", 0)->count();
    }

    function one_community_withdraw_money()
    {
        return $this->one_community_fund()
            ->where("reason_id", "=", 2)->sum("amount");
    }

    private function one_community_fund()
    {
        return $this->hasManyThrough(fund::class, house::class);
    }

    function one_community_subscribe_amount()
    {
        return $this->hasManyThrough(fund::class, house::class)->where("reason_id", "=", 1)->sum("amount");
    }

    function contract_amount_commission()
    {
        return $this->contract_amount() * $this->commission;
    }

    function contract_amount()
    {
        return $this->one_community_fund()
            ->sum("amount");
    }

    function one_community_bank_balance()
    {
        return "todo";
    }

    function one_community_bank_pay()
    {
        return "todo";
        $this->one_community_fund()->where("reason_id", "=", 0);
    }

    function sex()
    {
        $districts = $this->customer_info()
            ->select(\Illuminate\Support\Facades\DB::raw("count(*) as value,sex as name"))
            ->whereNotNull("sex")
            ->groupBy("sex")->get();

        $districts->map(
            function ($val) {
                $val->name = $val->district_sex($val->name);
                return $val;
            }
        );

        return $districts;

    }

    function customer_info()
    {
        return $this->hasMany(customer_info::class);
    }

    function district()
    {
        $districts = $this->customer_info()
            ->select(\Illuminate\Support\Facades\DB::raw("count(*) as value,district_id as name"))
            ->whereNotNull("district_id")
            ->groupBy("district_id")->get();

        $districts->map(
            function ($val) {
                $val->name = $val->district_name($val->name);
                return $val;
            }
        );
        return $districts;
    }

    function family()
    {
        $districts = $this->customer_info()
            ->select(\Illuminate\Support\Facades\DB::raw("count(*) as value,family as name"))
            ->whereNotNull("family")
            ->groupBy("family")->get();

        $districts->map(
            function ($val) {
                $val->name = $val->district_family($val->name);
                return $val;
            }
        );
        return $districts;
    }

    function motive()
    {
        return $this->map("motive");
    }

    function map($field)
    {
        $districts = $this->customer_info()
            ->select(\Illuminate\Support\Facades\DB::raw("count(*) as value, {$field} as name"))
            ->whereNotNull($field)
            ->groupBy($field)->get();

        $districts->map(
            function ($val) use ($field) {
                $val->name = $val->district_map($val->name, $field);
                return $val;
            }
        );
        return $districts;
    }

    function apartment_layout()
    {
        return $this->map("apartment_layout");
    }

    function channel_id()
    {
        $districts = $this->customer_info()
            ->select(\Illuminate\Support\Facades\DB::raw("count(*) as value, channel_id as name,community_id"))
            ->whereNotNull("channel_id")
            ->groupBy("channel_id")->get();

        $districts->map(
            function ($val) {
                $channel = $val->channel($val->name);
                $val->name = $channel->name;
                return $val;
            }
        );
        return $districts;
    }

    function get_last_year_month_first_day_number()
    {
        return (new \Carbon\Carbon("last year"))->format("Ym") * 100 + 1;
    }

    function sell_house_area_one_year_by_month()
    {
        return $this->sell_house_one_year_by_month_index("sum(contracts.area)");
    }

    function sell_house_one_year_by_month_index($field)
    {
        // amount area withdraw number
        return $this->contract()->where(
            [
                [
                    "date",
                    ">",
                    $this->get_last_year_today_number()
                ]
            ]
        )->select(
            DB::raw("{$field} as value  , date div 100 as month")
        )->groupBy(["month"])->get();
    }

    function contract()
    {
        return $this->hasManyThrough(contract::class, house::class);
    }

    function get_last_year_today_number()
    {
        return (new \Carbon\Carbon())->subDays(366)->format("Ymd");
    }

    function sell_house_amount_one_year_by_month()
    {
        return $this->sell_house_one_year_by_month_index("sum(amount)");
    }

    function sell_house_number_one_year_by_month()
    {
        return $this->sell_house_one_year_by_month_index("count(*)");
    }

    function sell_house_withdraw_one_year_by_month()
    {
        return $this->one_community_fund()->where(
            [
                [
                    "date",
                    ">",
                    $this->get_last_year_today_number()
                ],
                [
                    "reason_id",
                    "=",
                    2
                ]
            ]
        )->select(
            DB::raw("sum(amount) as value  , date div 100 as month")
        )->groupBy(["month"])->get();
    }

    // by day

    function sell_house_area_one_year_by_day()
    {
        return $this->sell_house_one_year_by_day_index("sum(contracts.area)");
    }

    function sell_house_one_year_by_day_index($field)
    {
        // amount area withdraw number
        return $this->contract()->where(
            [
                [
                    "date",
                    ">",
                    $this->get_last_year_today_number()
                ]
            ]
        )->select(
            DB::raw("{$field} as value  , date as day")
        )->groupBy(["day"])->get();
    }

    function sell_house_amount_one_year_by_day()
    {
        return $this->sell_house_one_year_by_day_index("sum(amount)");
    }

    function sell_house_number_one_year_by_day()
    {
        return $this->sell_house_one_year_by_day_index("count(*)");
    }

    function sell_house_withdraw_one_year_by_day()
    {
        return $this->one_community_fund()
            ->where(
                [
                    [
                        "date",
                        ">",
                        $this->get_last_year_today_number()
                    ],
                    [
                        "reason_id",
                        "=",
                        2
                    ]
                ]
            )->select(
                DB::raw("sum(amount) as value  , date as day")
            )->groupBy(["day"])->get();
    }

    function district_twelve()
    {
        $districts = $this->customer_info()
            ->select(\Illuminate\Support\Facades\DB::raw("count(*) as value,district_id as name, date_format(created_at,'%Y%m') as month ,(to_days(now()) - to_days(created_at)) as day_diff "))
            ->havingRaw(
                "day_diff < 366"
            )
            ->whereNotNull("district_id")
            ->groupBy("district_id", "month")->get();

        $districts = $districts->reduce(
            function ($carry, $item) {
                $key = $item->district_name($item->name);
                $carry[$key][(int)$item["month"]] = $item["value"];
                return $carry;
            },
            []
        );

        return $this->data_merge_with_empty_month_date_for_assoc($districts);
    }

    function data_merge_with_empty_month_date_for_assoc($data)
    {

        return array_map(function ($item) {
            $full = $this->generate_one_year_month_array_assoc();
            foreach ($item as $key => $value) {
                $full[$key] = $value;
            }
            // [20151001=>1,20151101=>2] ----> [1,2]
            // 把本月的数据弹出
            array_pop($full);
            return array_merge($full, []);
        }, $data);

    }

    function generate_one_year_month_array_assoc()
    {
        $last_year_month_number = (new \Carbon\Carbon("last year"));

        return array_reduce(
            range(1, 12),
            function ($carry) use ($last_year_month_number) {
                $carry[(int)$last_year_month_number->format("Ym")] = 0;
                $last_year_month_number->addMonth(1);
                return $carry;
            }, []
        );

    }

    function motive_twelve()
    {
        return $this->twelve_statis("motive");
    }

    function twelve_statis($field)
    {
        $districts = $this->customer_info()
            ->select(\Illuminate\Support\Facades\DB::raw("count(*) as value, {$field} as name, date_format(created_at,'%Y%m') as month ,(to_days(now()) - to_days(created_at)) as day_diff "))
            ->havingRaw(
                "day_diff < 366"
            )
            ->whereNotNull($field)
            ->groupBy($field, "month")->get();

        $districts = $districts->reduce(
            function ($carry, $item) use ($field) {
                $key = $item->district_map($item->name, $field);
                $carry[$key][(int)$item["month"]] = $item["value"];
                return $carry;
            },
            []
        );

        return $this->data_merge_with_empty_month_date_for_assoc($districts);
    }

    function sex_twelve()
    {
        return $this->twelve_statis("sex");
    }

    function apartment_layout_twelve()
    {
        return $this->twelve_statis("apartment_layout");
    }

    function family_twelve()
    {
        return $this->twelve_statis("family");
    }

    function channel_twelve()
    {
        $field = "channel_id";

        $districts = $this->customer_info()
            ->select(\Illuminate\Support\Facades\DB::raw(
                "count(*) as value, {$field} as name, date_format(created_at,'%Y%m') as month ,(to_days(now()) - to_days(created_at)) as day_diff ,community_id")
            )
            ->havingRaw(
                "day_diff < 366"
            )
            ->whereNotNull($field)
            ->groupBy($field, "month")->get();

        $districts = $districts->reduce(
            function ($carry, $item) use ($field) {
                $key = $item->channel($item->name);
                $carry[$key["name"]][(int)$item["month"]] = $item["value"];
                return $carry;
            },
            []
        );

        return $this->data_merge_with_empty_month_date_for_assoc($districts);
    }
}

