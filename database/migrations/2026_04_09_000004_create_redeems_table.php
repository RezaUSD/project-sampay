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
        Schema::create('redeems', function (Blueprint $table) {
            $table->id('id_redeem');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_reward_katalog')->nullable();
            $table->integer('jumlah_poin');
            $table->enum('status_redeem', ['Pending', 'Persetujuan', 'Ditolak', 'Selesai'])->default('Pending');
            $table->timestamp('tanggal_redeem')->useCurrent();

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('id_reward_katalog')
                  ->references('id_reward_katalog')
                  ->on('reward_katalog')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redeems');
    }
};
