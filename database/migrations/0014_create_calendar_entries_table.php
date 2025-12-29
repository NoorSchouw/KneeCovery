<?php

// database/migrations/2025_11_27_000003_create_calendar_entries_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('calendar_entries', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');       // patient_id
            $table->unsignedBigInteger('exercise_id');

            $table->date('date');
            $table->json('settings')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')->on('user')->cascadeOnDelete();

            $table->foreign('exercise_id')
                ->references('exercise_id')->on('exercise')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calendar_entries');
    }
};
