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
            if (!Schema::hasColumn('dues_members', 'idpayment')) {
                $table->unsignedBigInteger('idpayment')->nullable()->after('bulan');
            }
            if (!Schema::hasColumn('dues_members', 'tanggal_bayar')) {
                $table->date('tanggal_bayar')->nullable()->after('idpayment');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dues_members', function (Blueprint $table) {
            if (Schema::hasColumn('dues_members', 'idpayment')) {
                $table->dropColumn('idpayment');
            }
        });
    }
};
