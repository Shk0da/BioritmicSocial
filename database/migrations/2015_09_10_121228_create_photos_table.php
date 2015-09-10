<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('tag', 255)->nullable();
            $table->timestamp('created_at');
        });
    }

    public function down()
    {
        Schema::drop('photos');
    }
}
