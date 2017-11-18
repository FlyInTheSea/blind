<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class  Commission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    private $table = "commission";

    public function up()
    {
        //
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('house_id');
            $table->integer('user_id');
            $table->integer('community_id');
            $table->string('role');
            $table->decimal('commission', 12, 2);//佣金
            $table->decimal('rate');//费率
            $table->decimal('amount', 12, 2);//金额
            $table->smallInteger('status')->default(1);
            $table->timestamps();// create column created_at updated_at
            $table->softDeletes();
//        * 张三　销售经理　天通苑１００１　提点　１．０　
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
