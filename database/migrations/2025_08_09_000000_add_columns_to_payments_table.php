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
            $table->string('payment_method')->default('cash')->after('nominal');
            $table->date('payment_date')->after('payment_method');
            $table->text('notes')->nullable()->after('payment_date');
            $table->string('bukti_pembayaran')->nullable()->after('notes');
            $table->string('status')->default('pending')->after('bukti_pembayaran');
            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idmember')->references('id')->on('dues_members')->onDelete('cascade');
            $table->foreign('idduescategory')->references('id')->on('dues_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('create_payment_tables', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_date', 'notes', 'bukti_pembayaran', 'status']);
            $table->dropForeign(['iduser']);
            $table->dropForeign(['idmember']);
            $table->dropForeign(['idduescategory']);
        });
    }
};
