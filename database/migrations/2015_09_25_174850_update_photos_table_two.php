<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePhotosTableTwo extends Migration
{

    public function up()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->integer('album_id')->nullable();
        });
    }

    public function down()
    {

    }

}
