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
        Schema::table('officers', function (Blueprint $table) {
            // Tambahkan kolom position
            $table->string('position')->default('Petugas')->after('iduser');

            // Ubah iduser menjadi unsignedBigInteger untuk konsistensi dengan Laravel
            $table->unsignedBigInteger('iduser')->change();

            // Tambahkan foreign key constraint
            $table->foreign('iduser')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            // Tambahkan index untuk performa
            $table->index('iduser');
        });
    }

    /**
     * Reverse the migrations.
     */
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
