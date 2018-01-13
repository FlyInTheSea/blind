<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContractTemplate extends Migration
{
    private $table = "contract_templates";

    public function up()
    {
        //
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('community_id');
            $table->longText("content");
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
