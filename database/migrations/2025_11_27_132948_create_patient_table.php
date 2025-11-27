<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('patient', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary(); // PK, verwijst naar User
            $table->unsignedBigInteger('phy_user_id')->nullable();
            $table->string('physio_number')->nullable();
            $table->date('start_date')->nullable();
            $table->string('treatment_status')->nullable();
            $table->text('medical_notes')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient');
    }
};
