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
        Schema::table('dues_categories', function (Blueprint $table) {
            $table->string('period')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dues_categories', function (Blueprint $table) {
            $table->enum('period', ['mingguan', 'bulanan', 'tahunan'])->change();
        });
    }
};
