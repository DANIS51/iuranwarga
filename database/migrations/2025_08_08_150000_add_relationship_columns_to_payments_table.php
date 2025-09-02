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
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('idduescategory')->nullable()->after('iduser');
            $table->foreign('idduescategory')->references('id')->on('dues_categories')->onDelete('cascade');

            $table->unsignedBigInteger('idmember')->nullable()->after('iduser');
            $table->foreign('idmember')->references('id')->on('dues_members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['idduescategory']);
            $table->dropColumn('idduescategory');
            $table->dropForeign(['idmember']);
            $table->dropColumn('idmember');
        });
    }
};
