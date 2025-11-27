<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('physiotherapist', function (Blueprint $table) {
            $table->id('user_id'); // PK en FK naar User
            $table->string('physio_number', 50)->unique(); // Unieke identifier voor physio
        });
    }

    public $timestamps = false; // Geen created_at / updated_at

    public function down(): void
    {
        Schema::dropIfExists('physiotherapist');
    }
};
