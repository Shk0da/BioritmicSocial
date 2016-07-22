<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePhotosTable extends Migration
{
    public function up()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->text('path')->nullable();
        });
    }

    public function down()
    {

    }
}
