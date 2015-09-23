<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePosts extends Migration
{

    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->text('body');
            $table->text('attach')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('posts');
    }
}
