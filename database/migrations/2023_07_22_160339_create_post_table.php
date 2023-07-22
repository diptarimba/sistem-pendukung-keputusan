<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('determine');
            $table->longText('suggestion');
            $table->string('image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('post');
    }
}
