<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumnsTable extends Migration
{
    use SoftDeletes;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('columns', function (Blueprint $table) {
            $table->string('name')->comment("字段名");
            $table->increments('id');
            $table->integer('table_structure_id');
            $table->tinyInteger("status")->default(0)->comment('0 stand for show 1 stand for not show ');
            $table->tinyInteger("sort_id")->default(0)->comment("排序id");
            $table->tinyInteger("writable")->default(0)->comment("是否可写　0 默认可写");
            $table->tinyInteger("type")->default(1)->comment("1 默认text");
//            $table->tinyInteger("input_type")->default(0)->comment("是否可写　0 默认可写");
            $table->string("name_alias");
            $table->timestamps();// create column created_at updated_at
            $table->softDeletes();
        });

        $this->insert_table_structures();
        $this->insert_columns();
        $this->insert_city();
        $this->insert_channel();
        $this->insert_daily_report();
        $this->insert_user();
        $this->insert_comunnity();
        $this->insert_house();
        $this->insert_config_transformation();
        $this->insert_fund();
        $this->insert_upload_files();
    }


    function insert_daily_report()
    {

        $table_structure_columns = [
            [
                "name" => "status",
                "name_alias" => "状态",
                "writable" => 1,
                "type" => 3
            ],
            [
                "name" => "city_id",
                "type" => 2,
                "name_alias" => "城市",
            ],
            [
                "name" => "report_date",
                "name_alias" => "日期",
                "type" => 4,
            ],
            [
                "name" => "channel_id",
                "type" => 2,
                "name_alias" => "渠道",
            ],
            [
                "name" => "enrollment_num",
                "type" => 3,
                "name_alias" => "报名",
            ],
            [
                "name" => "consult",
                "name_alias" => "咨询",
                "type" => 3,
            ],
            [
                "name" => "cover",
                "name_alias" => "覆盖",
                "type" => 3,
            ],
            [
                "name" => "valid_user_num",
                "type" => 3,
                "name_alias" => "有效用户",
            ],

            [
                "name" => "dispatched_order_num",
                "type" => 3,
                "name_alias" => "派单",
            ],
            [
                "name" => "visited_user_num",
                "type" => 3,
                "name_alias" => "到访",
            ],
            [
                "name" => "deal_num",
                "type" => 3,
                "name_alias" => "签单人数",
            ],
            [
                "name" => "deposit",
                "name_alias" => "定金",
                "type" => 3,
            ],
            [
                "name" => "sale_amount",
                "type" => 3,
                "name_alias" => "业绩",
            ],
            [
                "name" => "consume",
                "type" => 3,
                "name_alias" => "消费",
            ],


        ];

        $this->save_column($table_structure_columns, 5);


    }

    function save_column($table_structure_columns, $id)
    {
        array_map(function ($item) use ($id) {
            $column = new  \App\column();
            $column->table_structure_id = $id;
            $column->name = $item["name"];
            $column->name_alias = $item["name_alias"];
            if (isset($item["writable"])) {
                $column->writable = $item["writable"];
            }
            if (isset($item["type"])) {
                $column->type = $item["type"];
            }
            $column->save();

        }, $table_structure_columns);
    }

    function insert_channel()
    {


        $table_structure_columns = [
            [
                "name" => "name",
                "name_alias" => "渠道识别码"
            ],
            [
                "name" => "name_alias",
                "name_alias" => "渠道",
            ],
            [
                "name" => "status",
                "name_alias" => "状态",
            ],
            [
                "name" => "parent_id",
                "name_alias" => "上级渠道",
                "type" => 2
            ],

        ];

        array_map(function ($item) {
            $column = new  \App\column();
            $column->table_structure_id = 4;
            $column->name = $item["name"];
            $column->name_alias = $item["name_alias"];
            if (isset($item["writable"])) {
                $column->writable = $item["writable"];
            }
            if (isset($item["type"])) {
                $column->type = $item["type"];
            }
            $column->save();

        }, $table_structure_columns);

    }


    function insert_city()
    {


        $table_structure_columns = [
            [
                "name" => "name",
                "name_alias" => "城市"
            ],
            [
                "name" => "id",
                "name_alias" => "id",
                "writable" => 1
            ],
            [
                "name" => "status",
                "name_alias" => "状态",
            ],
            [
                "name" => "province",
                "name_alias" => "省份",
            ],

        ];

        array_map(function ($item) {
            $column = new  \App\column();
            $column->table_structure_id = 3;
            $column->name = $item["name"];
            $column->name_alias = $item["name_alias"];
            if (isset($item["writable"])) {
                $column->writable = $item["writable"];
            }
            $column->save();

        }, $table_structure_columns);

    }


    function insert_table_structures()
    {


        $table_structure_columns = [
            [
                "name" => "name",
                "name_alias" => "表名英文"
            ],
            [
                "name" => "id",
                "name_alias" => "id",
                "writable" => 1
            ],
            [
                "name" => "status",
                "name_alias" => "状态",
                "writable" => 1
            ],
            [
                "name" => "name_alias",
                "name_alias" => "表名",
            ],
            [
                "name" => "deleted_at",
                "name_alias" => "删除状态",
                "writable" => 1
            ]


        ];

        array_map(function ($item) {
            $column = new  \App\column();
            $column->table_structure_id = 1;
            $column->name = $item["name"];
            $column->name_alias = $item["name_alias"];
            if (isset($item["writable"])) {
                $column->writable = $item["writable"];
            }

            $column->save();

        }, $table_structure_columns);

    }

    function insert_columns()
    {
        $columns = [
            [
                "name" => "id",
                "name_alias" => "id",
                "writable" => 1,
            ],
            [
                "name" => "table_structure_id",
                "name_alias" => "外联id",
                "type" => 2
            ],
            [
                "name" => "name",
                "name_alias" => "字段名英文"
            ],

            [
                "name" => "status",
                "name_alias" => "状态",
                "writable" => 1,
            ],
            [
                "name" => "name_alias",
                "name_alias" => "字段",
            ],
            [
                "name" => "sort_id",
                "name_alias" => "排序id",
            ],

            [
                "name" => "writable",
                "name_alias" => "是否可写",
            ],
            [
                "name" => "deleted_at",
                "name_alias" => "删除状态",
                "writable" => 1
            ],
            [
                "name" => "type",
                "name_alias" => "字段类型",
            ]


        ];

        array_map(function ($item) {
            $column = new  \App\column();
            $column->table_structure_id = 2;
            $column->name = $item["name"];
            $column->name_alias = $item["name_alias"];
            if (isset($item["writable"])) {
                $column->writable = $item["writable"];
            }
            if (isset($item["type"])) {
                $column->type = $item["type"];
            }
            $column->save();

        }, $columns);
    }


    /**
     *
     */
    function insert_user()
    {

        $table_structure_columns = [

            [
                "name" => "id",
                "name_alias" => "id",
                "writable" => 1
            ],
            [
                "name" => "name",
                "name_alias" => "用户名",
            ],
            [
                "name" => "email",
                "name_alias" => "email",
            ],
        ];

        $this->save_column($table_structure_columns, 6);

    }

    function insert_comunnity()
    {

        $table_structure_columns = [
            [
                "name" => "id",
                "name_alias" => "id",
                "writable" => 1
            ],

            [
                "name" => "name",
                "name_alias" => "小区名",
            ],
        ];

        $this->save_column($table_structure_columns, 7);

    }

    function insert_house()
    {


        $table_structure_columns = [
            [
                "name" => "id",
                "name_alias" => "id",
                "writable" => 1
            ],
            [
                "name" => "community_id",
                "name_alias" => "小区名",
                "type" => 2
            ],
            [
                "name" => "number",
                "name_alias" => "房间号",
            ],
            [
                "name" => "unit",
                "name_alias" => "单元",
            ],
            [
                "name" => "floor",
                "name_alias" => "楼层",
            ],
            [
                "name" => "status",
                "name_alias" => "状态",
            ],
            [
                "name" => "area",
                "name_alias" => "面积",
            ],
            [
                "name" => "price",
                "name_alias" => "单价",
            ],
            [
                "name" => "total_price",
                "name_alias" => "总价",
            ],
        ];

        $this->save_column($table_structure_columns, 8);

    }


    function insert_config_transformation()
    {

        $table_structure_columns = [
            [
                "name" => "id",
                "name_alias" => "id",
                "writable" => 1
            ],
            [
                "name" => "column_id",
                "name_alias" => "配置字段",
                "type" => 2,
            ],
            [
                "name" => "name_alias",
                "name_alias" => "值",
            ],

            [
                "name" => "name",
                "name_alias" => "数字",
                "writable" => 1
            ],

            [
                "name" => "table_structure_id",
                "type" => 2,
                "name_alias" => "表",
            ],
        ];

        $this->save_column($table_structure_columns, 9);

    }

    function insert_fund()
    {
        $table_structure_columns = [
            [
                "name" => "id",
                "name_alias" => "id",
                "writable" => 1
            ],
            [
                "name" => "room_id",
                "name_alias" => "房号",
//                "type"=>2
            ],
            [
                "name" => "reason_id",
                "name_alias" => "付款类型",
            ],
            [
                "name" => "comment",
                "name_alias" => "备注",
            ],
            [
                "name" => "amount",
                "name_alias" => "总价",
            ],
        ];

        $this->save_column($table_structure_columns, 10);

    }
    function insert_upload_files()
    {

        $table_structure_columns = [
            [
                "name" => "id",
                "name_alias" => "id",
                "writable" => 1
            ],
            [
                "name" => "url",
                "name_alias" => "url",
                "type" => 5,
            ],
            [
                "name" => "name",
                "name_alias" => "文件名",
            ],
            [
                "name" => "user_id",
                "name_alias" => "上传用户",
            ],
            [
                "name" => "position_id",
                "name_alias" => "位置",
            ],
        ];

        $this->save_column($table_structure_columns, 11);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //structure_tables

        Schema::dropIfExists('columns');
    }
}



