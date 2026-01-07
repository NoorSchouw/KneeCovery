<?php
// Niet gebruiken
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('exerciseSchedule', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->unsignedBigInteger('assignment_id')->nullable();
            $table->date('scheduled_date');

            $table->foreign('assignment_id')
                ->references('assignment_id')->on('patientExerciseAssigned')
                ->onDelete('restrict')->onUpdate('restrict');
        });
    }

    public function down(): void {
        Schema::dropIfExists('exerciseSchedule');
    }
};
