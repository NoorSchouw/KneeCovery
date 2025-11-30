<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('exercise', function (Blueprint $table) {
            $table->id('exercise_id');
            $table->string('exercise_video_path', 256)->nullable();
            $table->string('exercise_name', 256);
            $table->string('exercise_description', 256);
        });
    }

    public function down(): void {
        Schema::dropIfExists('exercise');
    }
};
