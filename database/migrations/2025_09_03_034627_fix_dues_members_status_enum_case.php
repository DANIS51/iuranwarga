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
        // Temporarily alter the enum to include invalid values to allow updates
        DB::statement("ALTER TABLE dues_members MODIFY COLUMN status ENUM('belum_bayar', 'sebagian', 'LUNAS', 'pending', 'paid') DEFAULT 'belum_bayar'");

        // Update invalid statuses
        DB::statement("UPDATE dues_members SET status = 'belum_bayar' WHERE status = 'pending'");
        DB::statement("UPDATE dues_members SET status = 'lunas' WHERE status = 'paid'");
        DB::statement("UPDATE dues_members SET status = 'lunas' WHERE status = 'LUNAS'");

        // Alter the enum to final lowercase values
        DB::statement("ALTER TABLE dues_members MODIFY COLUMN status ENUM('belum_bayar', 'sebagian', 'lunas') DEFAULT 'belum_bayar'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert 'lunas' back to 'LUNAS'
        DB::table('dues_members')->where('status', 'lunas')->update(['status' => 'LUNAS']);

        // Alter the enum back to uppercase 'LUNAS'
        DB::statement("ALTER TABLE dues_members MODIFY COLUMN status ENUM('belum_bayar', 'sebagian', 'LUNAS') DEFAULT 'belum_bayar'");
    }
};
