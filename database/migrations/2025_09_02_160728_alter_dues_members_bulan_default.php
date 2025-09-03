<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('dues_members', 'bulan')) {
            Schema::table('dues_members', function (Blueprint $table) {
                $table->string('bulan')->default(date('Y-m'))->after('idduescategory');
            });
        } else {
            Schema::table('dues_members', function (Blueprint $table) {
                // Ubah kolom bulan agar punya default value
                $table->string('bulan')->default(date('Y-m'))->change();
            });
        }
    }

    public function down(): void
    {
        Schema::table('dues_members', function (Blueprint $table) {
            // Balikin lagi kalau rollback (tanpa default)
            $table->string('bulan')->nullable(false)->change();
        });
    }
};
