<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Community extends Migration
{
    private $table ;
    public function __construct()
    {
        $this->table = "communities";
    }

    public function up()
    {
        Schema::create($this->table,function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }

}
