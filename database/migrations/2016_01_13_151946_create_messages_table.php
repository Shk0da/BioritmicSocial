<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{

    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from');
            $table->integer('to');
            $table->string('text');
            $table->integer('dialog');
            $table->smallInteger('read')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('messages');
    }
}
