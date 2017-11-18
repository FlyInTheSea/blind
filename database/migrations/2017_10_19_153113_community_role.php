<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class  CommunityRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    private $table = "community_roles";

    public function up()
    {
        //
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('community_id');
            $table->integer('user_id');
            $table->decimal('commission_rate');
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


