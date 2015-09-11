<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProfilesTable extends Migration
{

    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->tinyInteger('gender')->nullable();
            $table->tinyInteger('zodiac')->nullable();
            $table->tinyInteger('animal')->nullable();
        });
    }

}
