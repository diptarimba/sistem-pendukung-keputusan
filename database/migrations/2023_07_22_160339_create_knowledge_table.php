<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnowledgeTable extends Migration
{
    public function up()
    {
        Schema::create('knowledge', function (Blueprint $table) {
            $table->id();
            $table->string('measure_of_belief');
            $table->string('measure_of_disbelief');
            $table->string('disease_id');
            $table->string('symtom_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('knowledge');
    }
}
