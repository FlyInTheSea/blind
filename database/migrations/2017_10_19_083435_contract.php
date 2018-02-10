<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contract extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    private $table = "contracts";

    public function up()
    {
        //
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->decimal("price");
            $table->decimal('area', 12, 2);
            $table->decimal('amount', 12, 2);
            $table->decimal('downpayment', 12, 2);
            $table->integer('pay_method');
            $table->string('customer_id');
            $table->string('house_id');
            $table->tinyInteger("status")->default(0)->comment("状态 0表示正常");
            $table->timestamps();// create column created_at updated_at
            $table->softDeletes();
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
