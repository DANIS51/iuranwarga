<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing 'paid' to 'completed'
        DB::statement("UPDATE payments SET status = 'completed' WHERE status = 'paid'");

        // Modify the enum to replace 'paid' with 'completed'
        DB::statement("ALTER TABLE payments MODIFY COLUMN status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending' NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert 'completed' back to 'paid'
        DB::statement("UPDATE payments SET status = 'paid' WHERE status = 'completed'");

        // Revert the enum
        DB::statement("ALTER TABLE payments MODIFY COLUMN status ENUM('pending', 'paid', 'cancelled') DEFAULT 'pending' NOT NULL");
    }
};
