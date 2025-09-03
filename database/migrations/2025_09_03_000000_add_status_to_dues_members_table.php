<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('dues_members', function (Blueprint $table) {
            if (!Schema::hasColumn('dues_members', 'status')) {
                $table->enum('status', ['belum_bayar', 'sebagian', 'LUNAS'])->default('belum_bayar')->after('idduescategory');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dues_members', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
