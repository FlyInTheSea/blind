<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConfigTransformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    private $table;

    public function __construct()
    {
        $this->table = "config_transformations";
    }

    public function up()
    {
        //
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment("");
            $table->string('name_alias')->comment("");
            $table->smallInteger("column_id")->default(0)->comment("状态 0表示正常");
            $table->smallInteger('table_structure_id');
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
