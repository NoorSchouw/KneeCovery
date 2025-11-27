<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('user_id'); // primary key
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 256)->unique();
            $table->string('password', 256);
            $table->string('gender', 256);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
