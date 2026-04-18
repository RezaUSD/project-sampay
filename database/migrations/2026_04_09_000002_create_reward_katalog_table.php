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
        Schema::create('reward_katalog', function (Blueprint $table) {
            $table->id('id_reward_katalog');
            $table->unsignedBigInteger('id_mitra')->nullable();
            $table->string('nama_reward');
            $table->integer('harga_poin');
            $table->text('deskripsi_reward')->nullable();
            $table->string('foto_reward')->nullable();

            $table->foreign('id_mitra')
                  ->references('id_mitra')
                  ->on('mitras')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_katalog');
    }
};
