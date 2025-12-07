<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('injury', function (Blueprint $table) {
            $table->string('affected_area', 256)->primary();
        });
    }

    public function down(): void {
        Schema::dropIfExists('injury');
    }
};

