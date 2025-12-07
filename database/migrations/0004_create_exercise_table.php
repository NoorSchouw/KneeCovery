<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(){
        Schema::create('exercise', function (Blueprint $table){
            $table->id('exercise_id');
            $table->string('exercise_name');
            $table->text('exercise_description')->nullable();
            $table->timestamps();
        });
    }
    public function down(){
        Schema::dropIfExists('exercise');
    }
};
