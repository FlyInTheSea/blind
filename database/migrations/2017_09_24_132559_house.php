<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class House extends Migration
{
    private $table;

    public function __construct()
    {
        $this->table = "houses";
    }

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('community_id')->comment("小区id");
            $table->smallInteger('number')->comment("房间号");
            $table->smallInteger('entrance')->comment("单元");
            $table->smallInteger('unit')->comment("楼号");
            $table->smallInteger('floor')->comment("楼层");
            $table->smallInteger('status')->default(1)->comment("状态");
            $table->decimal('area')->comment("面积");
            $table->decimal('price', 12, 2)->comment("单价");
            $table->decimal('total_price', 12, 2)->comment("总价");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
