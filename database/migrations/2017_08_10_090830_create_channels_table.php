<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    private $table = "channels";

    public function up()
    {
        //
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment("渠道识别码");
            $table->string('name_alias')->comment("渠道");
            $table->integer('parent_id')->comment("上级渠道");
            $table->tinyInteger("status")->default(0)->comment("状态 0表示正常");
            $table->timestamps();// create column created_at updated_at
            $table->softDeletes();
        });

        $this->top_channel();
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

    function top_channel()
    {

        $channel_first_row = new  \App\channel();
        $channel_first_row->parent_id = 0;
        $channel_first_row->name_alias = "全部渠道";
        $channel_first_row->name = "all";
        $channel_first_row->save();
    }
}
