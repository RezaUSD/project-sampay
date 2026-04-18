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
        Schema::create('point_transactions', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_laporan')->nullable();
            $table->unsignedBigInteger('id_redeem')->nullable();
            $table->enum('tipe_transaksi', ['Pemasukan', 'Pengeluaran']);
            $table->integer('jumlah_poin');
            $table->string('keterangan')->nullable();
            $table->timestamp('tanggal_transaksi')->useCurrent();

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('id_laporan')
                  ->references('id_laporan')
                  ->on('reports')
                  ->onDelete('set null');

            $table->foreign('id_redeem')
                  ->references('id_redeem')
                  ->on('redeems')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_transactions');
    }
};
