<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {

        Schema::table('dues_categories', function (Blueprint $table) {

            $table->dropColumn('petugas');
        });


        Schema::table('dues_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('petugas')->nullable()->after('payment_type');
            $table->foreign('petugas')->references('id')->on('officers')->onDelete('set null');
        });
    }


    public function down(): void
    {
        Schema::table('dues_categories', function (Blueprint $table) {
            $table->dropForeign(['petugas']);
            $table->dropColumn('petugas');
            $table->string('petugas')->nullable()->after('payment_type');
        });
    }
};
