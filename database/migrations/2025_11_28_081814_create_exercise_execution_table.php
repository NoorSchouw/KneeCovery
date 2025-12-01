<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('excerciseExecution', function (Blueprint $table) {
            $table->id('execution_id');
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('assignment_id')->nullable();

            $table->date('execution_date');
            $table->string('feedback', 1000);
            $table->integer('score');
            $table->time('start_time');
            $table->time('end_time');
            $table->time('duration');
            $table->string('execution_video_path', 256)->nullable();

            $table->foreign('assignment_id')
                ->references('assignment_id')->on('patientExerciseAssigned')
                ->onDelete('restrict')->onUpdate('restrict');

            $table->foreign('schedule_id')
                ->references('schedule_id')->on('exerciseSchedule')
                ->onDelete('restrict')->onUpdate('restrict');
        });
    }

    public function down(): void {
        Schema::dropIfExists('excerciseExecution');
    }
};

