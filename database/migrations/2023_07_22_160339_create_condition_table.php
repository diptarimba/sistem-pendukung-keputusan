<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConditionTable extends Migration
{
    public function up()
    {
        Schema::create('conditions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->double('value', 11, 1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('condition');
    }
}
