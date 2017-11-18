<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    private $table = "customer_info";

    public function up()
    {
        //
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unique()->nullable();
            $table->smallInteger('family')->nullable();
            $table->smallInteger('motive')->nullable();
            $table->smallInteger('channel_id')->nullable();
            $table->smallInteger('district_id')->nullable();
            $table->string('address')->nullable();
            $table->string('identification')->nullable();
            $table->smallInteger('apartment_layout')->nullable();
            $table->tinyInteger('sex')->nullable();
            $table->tinyInteger('level')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
