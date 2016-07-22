<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProfileTable extends Migration
{

    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->integer('background')->nullable();
        });
    }

    public function down()
    {

    }

}
