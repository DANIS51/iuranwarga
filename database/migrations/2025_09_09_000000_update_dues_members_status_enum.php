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
        // First, update existing 'sebagian' to 'belum_lunas'
        DB::statement("UPDATE dues_members SET status = 'belum_lunas' WHERE status = 'sebagian'");

        // Then, alter the enum to replace 'sebagian' with 'belum_lunas'
        DB::statement("ALTER TABLE dues_members MODIFY COLUMN status ENUM('belum_bayar', 'belum_lunas', 'lunas') DEFAULT 'belum_bayar'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse: change 'belum_lunas' back to 'sebagian'
        DB::statement("UPDATE dues_members SET status = 'sebagian' WHERE status = 'belum_lunas'");

        // Alter back to original enum
        DB::statement("ALTER TABLE dues_members MODIFY COLUMN status ENUM('belum_bayar', 'sebagian', 'lunas') DEFAULT 'belum_bayar'");
    }
};
