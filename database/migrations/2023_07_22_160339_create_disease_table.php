<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseaseTable extends Migration
{
    public function up()
    {
        Schema::create('disease', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('determine');
            $table->string('suggestion');
            $table->string('image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('disease');
    }
}
