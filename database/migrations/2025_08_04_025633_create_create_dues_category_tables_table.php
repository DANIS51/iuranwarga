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
        if (!Schema::hasTable('dues_categories')){
            Schema::create('dues_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->enum("period", ['mingguan', 'bulanan', 'tahunan']);
            $table->integer("nominal");
            $table->string('status');
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dues_categories');
    }
};
