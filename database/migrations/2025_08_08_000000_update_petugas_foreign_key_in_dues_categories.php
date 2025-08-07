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
        // First, let's update the petugas column to be an integer and add foreign key
        Schema::table('dues_categories', function (Blueprint $table) {
            // Drop the existing petugas column
            $table->dropColumn('petugas');
        });

        // Add new petugas column as foreign key
        Schema::table('dues_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('petugas')->nullable()->after('payment_type');
            $table->foreign('petugas')->references('id')->on('officers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dues_categories', function (Blueprint $table) {
            $table->dropForeign(['petugas']);
            $table->dropColumn('petugas');
            $table->string('petugas')->nullable()->after('payment_type');
        });
    }
};
