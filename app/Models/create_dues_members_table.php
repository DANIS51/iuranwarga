<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDuesMembersTable extends Migration
{
    public function up()
    {
        Schema::create('dues_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iduser');
            $table->unsignedBigInteger('idduescategory');
            $table->string('bulan'); // format YYYY-MM
            $table->enum('status', ['belum_bayar', 'sebagian', 'lunas'])->default('belum_bayar');
            $table->date('tanggal_bayar')->nullable();
            $table->unsignedBigInteger('idpayment')->nullable();
            $table->timestamps();

            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idduescategory')->references('id')->on('dues_categories')->onDelete('cascade');
            $table->foreign('idpayment')->references('id')->on('payments')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dues_members');
    }
}
