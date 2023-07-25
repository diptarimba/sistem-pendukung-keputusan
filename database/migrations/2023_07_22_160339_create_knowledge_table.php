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
            $table->decimal('measure_of_belief', 11, 1);
            $table->decimal('measure_of_disbelief', 11, 1);
            $table->unsignedBigInteger('disease_id');
            $table->unsignedBigInteger('symptom_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('knowledge');
    }
}
