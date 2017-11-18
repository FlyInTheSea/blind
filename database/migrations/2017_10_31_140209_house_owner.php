<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HouseOwner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    private $table = "house_owners";

    public function up()
    {
        //
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('house_id')->unique();
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
        Schema::dropIfExists($this->table);
    }

}
