<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        $user = new  \App\User;
        $user->email = '593023966@qq.com';
        $user->phone= '13121341478';
        $user->name = "亚杰";
        $user->save();

        $user = new  \App\User;
        $user->email = "95387284@qq.com";
        $user->phone= '15230706080';
        $user->name = "吕士帅";
        $user->save();
        $user = new  \App\User;
        $user->email = "744541711@qq.com";
        $user->phone= '13121341474';
        $user->name = "杨益民";
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
