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
        // Update status values to match the new enum
        DB::table('dues_members')
            ->where('status', 'pending')
            ->update(['status' => 'belum_bayar']);

        DB::table('dues_members')
            ->where('status', 'paid')
            ->update(['status' => 'lunas']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert status values
        DB::table('dues_members')
            ->where('status', 'belum_bayar')
            ->update(['status' => 'pending']);

        DB::table('dues_members')
            ->where('status', 'lunas')
            ->update(['status' => 'paid']);
    }
};
