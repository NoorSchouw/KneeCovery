<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('excerciseExecution', function (Blueprint $table) {

            // 1️⃣ schedule_id loslaten
            $table->dropForeign(['schedule_id']);
            $table->dropColumn('schedule_id');

            // 2️⃣ calendar_entry_id toevoegen
            $table->unsignedBigInteger('calendar_entry_id')->after('execution_id');

            $table->foreign('calendar_entry_id')
                ->references('id')
                ->on('calendar_entries')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('excerciseExecution', function (Blueprint $table) {

            $table->dropForeign(['calendar_entry_id']);
            $table->dropColumn('calendar_entry_id');

            $table->unsignedBigInteger('schedule_id');

            $table->foreign('schedule_id')
                ->references('schedule_id')
                ->on('exerciseSchedule');
        });
    }
};

