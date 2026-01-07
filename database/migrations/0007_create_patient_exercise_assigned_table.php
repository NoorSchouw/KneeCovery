<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// Niet gebruiken
return new class extends Migration {
    public function up(): void {
        Schema::create('patientExerciseAssigned', function (Blueprint $table) {
            $table->id('assignment_id');
            $table->unsignedBigInteger('exercise_id')->nullable();
            $table->unsignedBigInteger('user_id');      // physio user_id
            $table->unsignedInteger('physio_number');   // physio number
            $table->unsignedBigInteger('pat_user_id');  // patient user_id
            $table->integer('frequency');
            $table->string('frequency_period', 256);
            $table->date('assigned_date');
            $table->string('personal_video_path', 256)->nullable();

            $table->foreign('exercise_id')
                ->references('exercise_id')->on('exercise')
                ->onDelete('restrict')->onUpdate('restrict');

            $table->foreign(['user_id', 'physio_number'])
                ->references(['user_id', 'physio_number'])->on('physiotherapist')
                ->onDelete('restrict')->onUpdate('restrict');

            $table->foreign('pat_user_id')
                ->references('user_id')->on('patient')
                ->onDelete('restrict')->onUpdate('restrict');
        });
    }

    public function down(): void {
        Schema::dropIfExists('patientExerciseAssigned');
    }
};

