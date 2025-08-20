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
            $table->unsignedBigInteger('iduser');
            $table->unsignedBigInteger('idmember')->nullable();
            $table->unsignedBigInteger('idduescategory')->nullable();
            $table->enum('period', ['mingguan', 'bulanan', 'tahunan']);
            $table->integer('nominal');
            $table->string('petugas');
            $table->timestamps();

            // foreign keys
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
        Schema::dropIfExists('create_payment_tables');
    }
};
