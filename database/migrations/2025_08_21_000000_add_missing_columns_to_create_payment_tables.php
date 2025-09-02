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
<<<<<<< HEAD:database/migrations/2025_08_21_000000_add_missing_columns_to_create_payment_tables.php
        Schema::table('create_payment_tables', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('nominal');
            $table->date('payment_date')->nullable()->after('payment_method');
            $table->text('notes')->nullable()->after('payment_date');
            $table->string('bukti_pembayaran')->nullable()->after('notes');
            $table->string('status')->default('pending')->after('bukti_pembayaran');
=======
        Schema::table('payments', function (Blueprint $table) {
            // Cek dan tambahkan kolom jika belum ada
            if (!Schema::hasColumn('payments', 'payment_method')) {
                $table->string('payment_method')->default('cash')->after('nominal');
            }

            if (!Schema::hasColumn('payments', 'payment_date')) {
                $table->date('payment_date')->after('payment_method');
            }

            if (!Schema::hasColumn('payments', 'notes')) {
                $table->text('notes')->nullable()->after('payment_date');
            }

            if (!Schema::hasColumn('payments', 'bukti_pembayaran')) {
                $table->string('bukti_pembayaran')->nullable()->after('notes');
            }

            if (!Schema::hasColumn('payments', 'status')) {
                $table->string('status')->default('pending')->after('bukti_pembayaran');
            }

            // Cek dan tambahkan foreign key jika belum ada
            if (!Schema::hasColumn('payments', 'iduser')) {
                $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');
            }

            if (!Schema::hasColumn('payments', 'idmember')) {
                $table->foreign('idmember')->references('id')->on('dues_members')->onDelete('cascade');
            }

            if (!Schema::hasColumn('payments', 'idduescategory')) {
                $table->foreign('idduescategory')->references('id')->on('dues_categories')->onDelete('cascade');
            }
>>>>>>> 9dd0864 (pembaruan):database/migrations/2025_08_09_000000_add_columns_to_payments_table.php
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<< HEAD:database/migrations/2025_08_21_000000_add_missing_columns_to_create_payment_tables.php
        Schema::table('create_payment_tables', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_date', 'notes', 'bukti_pembayaran', 'status']);
=======
        Schema::table('payments', function (Blueprint $table) {
            // Hapus kolom jika ada
            if (Schema::hasColumn('payments', 'payment_method')) {
                $table->dropColumn('payment_method');
            }

            if (Schema::hasColumn('payments', 'payment_date')) {
                $table->dropColumn('payment_date');
            }

            if (Schema::hasColumn('payments', 'notes')) {
                $table->dropColumn('notes');
            }

            if (Schema::hasColumn('payments', 'bukti_pembayaran')) {
                $table->dropColumn('bukti_pembayaran');
            }

            if (Schema::hasColumn('payments', 'status')) {
                $table->dropColumn('status');
            }

            // Hapus foreign key jika ada
            $table->dropForeign(['iduser']);
            $table->dropForeign(['idmember']);
            $table->dropForeign(['idduescategory']);
>>>>>>> 9dd0864 (pembaruan):database/migrations/2025_08_09_000000_add_columns_to_payments_table.php
        });
    }
};
