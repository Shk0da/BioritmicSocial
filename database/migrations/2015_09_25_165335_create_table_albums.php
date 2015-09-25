<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAlbums extends Migration
{
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->boolean('private')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('albums');
    }
}
