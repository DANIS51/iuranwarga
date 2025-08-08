<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('officers', function (Blueprint $table) {

            $table->string('position')->default('Petugas')->after('iduser');


            $table->unsignedBigInteger('iduser')->change();


            $table->foreign('iduser')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');


            $table->index('iduser');
        });
    }

     
    public function down(): void
    {
        Schema::table('officers', function (Blueprint $table) {
            $table->dropForeign(['iduser']);
            $table->dropIndex(['iduser']);
            $table->dropColumn('position');
            $table->integer('iduser')->change();
        });
    }
};
