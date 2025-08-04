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
        Schema::create('create_payment_tables', function (Blueprint $table) {
            $table->id();
            $table->integer("id");
            $table->enum("period", ['mingguan', 'bulanan', 'tahunan']);
            $table->integer('nominal');
            $table->string('petugas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('create_payment_tables');
    }
};
