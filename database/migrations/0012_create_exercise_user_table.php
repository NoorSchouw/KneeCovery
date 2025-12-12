<?php

// database/migrations/2025_11_27_000002_create_exercise_user_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('exercise_user', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('exercise_id');

            $table->foreign('user_id')
                ->references('user_id')->on('user')->cascadeOnDelete();

            $table->foreign('exercise_id')
                ->references('exercise_id')->on('exercise')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exercise_user');
    }
};
