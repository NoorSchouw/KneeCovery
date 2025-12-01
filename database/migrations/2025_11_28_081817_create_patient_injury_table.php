<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('patientInjury', function (Blueprint $table) {
            $table->id();
            $table->string('affected_area', 256);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('phy_user_id');
            $table->unsignedInteger('physio_number');

            $table->foreign('affected_area')
                ->references('affected_area')->on('injury')
                ->onDelete('restrict')->onUpdate('restrict');

            $table->foreign('user_id')
                ->references('user_id')->on('patient')
                ->onDelete('restrict')->onUpdate('restrict');
        });
    }

    public function down(): void {
        Schema::dropIfExists('patientInjury');
    }
};
