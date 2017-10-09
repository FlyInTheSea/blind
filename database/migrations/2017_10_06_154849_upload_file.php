<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UploadFile extends Migration
{


    private $table = "upload_files";

    public function up()
    {
        //
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->comment("url");
            $table->string('name')->comment("文件名");
            $table->integer('user_id')->comment();
            $table->integer('position_id')->comment();
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
