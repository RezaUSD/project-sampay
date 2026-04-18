<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Menambah 'Dijemput' ke dalam ENUM status di MySQL
        DB::statement("ALTER TABLE reports MODIFY COLUMN status ENUM('Pending', 'Diproses', 'Dijemput', 'Selesai', 'Ditolak') NOT NULL DEFAULT 'Pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE reports MODIFY COLUMN status ENUM('Pending', 'Diproses', 'Selesai', 'Ditolak') NOT NULL DEFAULT 'Pending'");
    }
};
