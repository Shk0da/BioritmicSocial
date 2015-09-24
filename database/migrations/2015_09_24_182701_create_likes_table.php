<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('like_id')->nullable();
            $table->string('like_type')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('likes');
    }
}
