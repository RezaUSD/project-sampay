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
        Schema::create('reports', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('foto_sampah_masuk')->nullable();
            $table->string('foto_sampah_selesai')->nullable();
            $table->double('latitude');
            $table->double('longitude');
            $table->enum('kategori', ['Organik', 'Anorganik', 'Sampah Sungai']);
            $table->text('keterangan_warga')->nullable();
            $table->enum('status', ['Pending', 'Diproses', 'Selesai', 'Ditolak'])->default('Pending');
            $table->timestamp('tanggal_lapor')->useCurrent();
            $table->unsignedBigInteger('id_petugas')->nullable();

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('id_petugas')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
