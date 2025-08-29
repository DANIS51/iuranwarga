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
        Schema::table('create_payment_tables', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('nominal');
            $table->date('payment_date')->nullable()->after('payment_method');
            $table->text('notes')->nullable()->after('payment_date');
            $table->string('bukti_pembayaran')->nullable()->after('notes');
            $table->string('status')->default('pending')->after('bukti_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('create_payment_tables', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_date', 'notes', 'bukti_pembayaran', 'status']);
        });
    }
};
