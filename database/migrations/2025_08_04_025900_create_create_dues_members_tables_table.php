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
        Schema::create('dues_members', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger("iduser");
        $table->unsignedBigInteger("idduescategory");
        $table->string("bulan"); // contoh format: 2025-01, 2025-02
        $table->enum("status", ['pending', 'paid'])->default('pending');
        $table->date("tanggal_bayar")->nullable();
        $table->unsignedBigInteger("idpayment")->nullable();
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dues_members');
    }
};
