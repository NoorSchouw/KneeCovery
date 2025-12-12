<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(){
        Schema::create('reference_videos', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('exercise_id')->unique(); // 1 video per oefening ⭐

            // File storage + link voor frontend
            $table->string('video_path')->nullable(); // opslaan in storage/app/public/videos
            $table->string('video_url')->nullable();  // getoond in popup calendar

            // JSON analyse data
            $table->json('payload')->nullable();
            $table->timestamps();

            // Foreign key naar exercise tabel
            $table->foreign('exercise_id')
                ->references('exercise_id')->on('exercise')
                ->cascadeOnDelete();
        });
    }

    public function down(){
        Schema::dropIfExists('reference_videos');
    }
};
