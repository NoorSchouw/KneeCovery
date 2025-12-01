<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration {
    /**
     * Run the migrations in the correct order.
     *
     * @return void
     */
    public function up()
    {
        // Run each migration individually in order
        $migrations = [
            '0001_01_01_000000_create_users_table',
            '0001_01_01_000001_create_cache_table',
            '0001_01_01_000002_create_jobs_table',
            '2025_11_27_123704_create_user_table',
            '2025_11_27_134350_create_physiotherapist_table',
            '2025_11_28_081813_create_exercise_table',
            '2025_11_28_081816_create_injury_table',
            '2025_11_27_132948_create_patient_table',
            '2025_11_28_081815_create_patient_exercise_assigned_table',
            '2025_11_28_081813_create_exercise_schedule_table',
            '2025_11_28_081814_create_exercise_execution_table',
            '2025_11_28_081817_create_patient_injury_table',
            '2025_11_28_081817_create_progress_table',
        ];

        foreach ($migrations as $migration) {
            // call artisan migrate for a single file by class name
            Artisan::call('migrate', [
                '--path' => "database/migrations/$migration.php",
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Rollback in precise reverse order
        $migrations = array_reverse([
            '0001_01_01_000000_create_users_table',
            '0001_01_01_000001_create_cache_table',
            '0001_01_01_000002_create_jobs_table',
            '2025_11_27_123704_create_user_table',
            '2025_11_27_134350_create_physiotherapist_table',
            '2025_11_28_081813_create_exercise_table',
            '2025_11_28_081816_create_injury_table',
            '2025_11_27_132948_create_patient_table',
            '2025_11_28_081815_create_patient_exercise_assigned_table',
            '2025_11_28_081813_create_exercise_schedule_table',
            '2025_11_28_081814_create_exercise_execution_table',
            '2025_11_28_081817_create_patient_injury_table',
            '2025_11_28_081817_create_progress_table',
        ]);

        foreach ($migrations as $migration) {
            Artisan::call('migrate:rollback', [
                '--path' => "database/migrations/$migration.php",
            ]);
        }
    }
};
