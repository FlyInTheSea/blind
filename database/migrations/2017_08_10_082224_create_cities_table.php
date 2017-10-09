<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    private $table = "cities";

    public function up()
    {
        //
        //
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment("名称");
            $table->string('province')->comment("省份");
            $table->tinyInteger("status")->default(0)->comment("状态 0表示正常");
            $table->timestamps();// create column created_at updated_at
            $table->softDeletes();
        });

        $this->init();
    }

    function init()
    {
        $path = config_path();
        $path = $path . "/sql/city.sql";


        $handle = fopen($path, "r");

        while ($city = fgetcsv($handle)) {
            $city_first_row = new  \App\city();
            $city_first_row->id = $this->get_id($city[0]);
            $city_first_row->name = str_replace("'", "", $city[1]);
            $city_first_row->province = str_replace("'", "", $city[2]);
            $city_first_row->save();
        }

    }

    function get_id($id_str)
    {
        return (int)str_replace("INSERT INTO `city` VALUES (", "", $id_str);

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
