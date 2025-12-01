    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up(): void
        {
            Schema::create('patient', function (Blueprint $table) {

                $table->unsignedBigInteger('user_id')->primary(); // must match user.user_id
                $table->unsignedBigInteger('phy_user_id');        // must match physiotherapist.user_id
                $table->unsignedInteger('physio_number');         // must match physiotherapist.physio_number

                $table->date('start_date');
                $table->string('treatment_status', 256);
                $table->string('medical_notes', 256)->nullable();

                // FK to user
                $table->foreign('user_id')
                    ->references('user_id')->on('user')
                    ->onDelete('restrict')->onUpdate('restrict');

                // Composite FK to physiotherapist
                $table->foreign(['phy_user_id', 'physio_number'])
                    ->references(['user_id', 'physio_number'])
                    ->on('physiotherapist')
                    ->onDelete('restrict')->onUpdate('restrict');
            });
        }


        public function down(): void
        {
            Schema::dropIfExists('patient');
        }
    };

