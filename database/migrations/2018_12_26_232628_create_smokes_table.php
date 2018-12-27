<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmokesTable extends Migration
{
    public function up()
    {
        Schema::create('smokes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('map');
            $table->string('difficulty');
            $table->string('video');
            $table->string('slug');
            $table->integer('user_id');
            $table->boolean('approved');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('smokes');
    }
}
