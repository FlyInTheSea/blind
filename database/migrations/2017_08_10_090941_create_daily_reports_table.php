<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyReportsTable extends Migration
{

    private $table = "daily_reports";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger("status")->default(0)->comment("状态 0表示正常");

            $table->integer("phone_num")->default(0);
            $table->integer("valid_user_num")->default(0);
            $table->integer("dispatched_order_num")->default(0);
            $table->integer("visited_user_num")->default(0);
            $table->integer("deal_num")->default(0);
            $table->decimal("sale_amount")->default(0);
            $table->decimal("consume")->default(0);
            $table->decimal("deposit")->default(0);
            $table->integer("consult")->default(0);
            $table->integer("cover")->default(0);
            $table->integer("report_date")->default(0);
            $table->integer("city_id")->default(0);
            $table->integer("channel_id")->default(0);
            $table->integer("enrollment_num")->default(0);

            $table->timestamps();// create column created_at updated_at
            $table->softDeletes();
//            电话数量　有效用户　派单　到访　签单　业绩　消费　报名
        });
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
}
