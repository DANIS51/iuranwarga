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
            // Drop the existing foreign key with cascade delete
            $table->dropForeign(['iduser']);

            // Add new foreign key without cascade delete
            $table->foreign('iduser')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dues_members', function (Blueprint $table) {
            // Drop the foreign key without cascade delete
            $table->dropForeign(['iduser']);

            // Add back the foreign key with cascade delete
            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
