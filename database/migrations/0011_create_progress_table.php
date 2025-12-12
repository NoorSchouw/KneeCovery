<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('progress', function (Blueprint $table) {
            $table->id('progress_id'); // FIXED TYPO
            $table->unsignedBigInteger('user_id');
            $table->string('metric_name', 256);
            $table->integer('metric_value');
            $table->dateTime('recorded_at');

            $table->foreign('user_id')
                ->references('user_id')->on('patient')
                ->onDelete('restrict')->onUpdate('restrict');
        });
    }

    public function down(): void {
        Schema::dropIfExists('progress');
    }
};
