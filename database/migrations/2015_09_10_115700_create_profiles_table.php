<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{

    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('birthday')->nullable();
            $table->integer('image_profile')->nullable();
            $table->string('location', 200)->nullable();
            $table->string('status', 255)->nullable();
            $table->text('about')->nullable();
        });
    }


    public function down()
    {
        Schema::drop('profiles');
    }
}
