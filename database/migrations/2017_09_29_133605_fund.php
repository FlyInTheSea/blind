<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fund extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $table;

    public function __construct()
    {
        $this->table = "funds";
    }

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount')->comment("");
            $table->integer('room_id')->comment("");
            $table->smallInteger('reason_id')->comment("");
            $table->string('comment')->comment("")->nullable();
            $table->timestamps();// create column created_at updated_at
            $table->softDeletes();
            //
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
