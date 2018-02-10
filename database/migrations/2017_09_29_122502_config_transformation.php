<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConfigTransformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    private $table;

    public function __construct()
    {
        $this->table = "config_transformations";
    }

    public function up()
    {
        //
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment("选项");
            $table->integer('value')->comment("值")->nullable();
            $table->smallInteger("column_id")->default(0)->comment("状态 0表示正常");
            $table->smallInteger('table_structure_id');
            $table->unique(["table_structure_id", "column_id", "value"]);
            $table->unique(["table_structure_id", "column_id", "name"]);
            $table->timestamps();// create column created_at updated_at
            $table->softDeletes();
        });

        $columns = [
            [
                "column_id" => 62,
                "table_structure_id" => 10,
                "name" => "贷款",
                "value" => 1
            ],
            [
                "column_id" => 62,
                "table_structure_id" => 10,
                "name" => "全款",
                "value" => 2
            ],
            [
                "column_id" => 62,
                "table_structure_id" => 10,
                "name" => "分期付款",
                "value" => 3
            ],
            [
                "column_id" => 75,
                "table_structure_id" => 13,
                "name" => "男",
                "value" => 0
            ],
            [
                "column_id" => 75,
                "table_structure_id" => 13,
                "name" => "女",
                "value" => 1
            ],
            [
                "column_id" => 76,
                "table_structure_id" => 13,
                "name" => "单身",
                "value" => 0
            ],
            [
                "column_id" => 76,
                "table_structure_id" => 13,
                "name" => "夫妻",
                "value" => 1
            ],
            [
                "column_id" => 76,
                "table_structure_id" => 13,
                "name" => "三口男孩",
                "value" => 2
            ],
            [
                "column_id" => 76,
                "table_structure_id" => 13,
                "name" => "三口女孩",
                "value" => 3
            ],
            [
                "column_id" => 76,
                "table_structure_id" => 13,
                "name" => "四口及以上",
                "value" => 4
            ],
            [
                "column_id" => 77,
                "table_structure_id" => 13,
                "name" => "投资",
                "value" => 0
            ],
            [
                "column_id" => 77,
                "table_structure_id" => 13,
                "name" => "自住",
                "value" => 1
            ],
            [
                "column_id" => 82,
                "table_structure_id" => 13,
                "name" => "一室一厅",
                "value" => 0
            ],
            [
                "column_id" => 82,
                "table_structure_id" => 13,
                "name" => "两室一厅",
                "value" => 1
            ],
            [
                "column_id" => 78,
                "table_structure_id" => 13,
                "name" => "新华",
                "value" => 0
            ],
            [
                "column_id" => 78,
                "table_structure_id" => 13,
                "name" => "南皮",
                "value" => 1
            ],
            [
                "column_id" => 78,
                "table_structure_id" => 13,
                "name" => "任丘",
                "value" => 2
            ],
        ];

        array_map(function ($item) {
            $ins = new \App\config_transformation();
            $ins->column_id = $item["column_id"];
            $ins->table_structure_id = $item["table_structure_id"];
            $ins->name = $item["name"];
            $ins->value = $item["value"];
            $ins->save();
        }, $columns);
//

    }

    function generate()
    {

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists($this->table);
    }

    function get()
    {

    }
}
