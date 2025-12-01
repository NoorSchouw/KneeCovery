<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('physiotherapist', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');      // must match users.user_id (BIGINT)
            $table->unsignedInteger('physio_number');   // stays INT

            // Composite PK
            $table->primary(['user_id', 'physio_number']);

            // FK to user
            $table->foreign('user_id')
                ->references('user_id')->on('user')
                ->onDelete('restrict')->onUpdate('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('physiotherapist');
    }
};
