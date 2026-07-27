<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->foreignId('lapangan_id')->constrained()->cascadeOnDelete();
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->enum('status', ['Tersedia', 'Tidak Tersedia'])->default('Tersedia');
        });
    }

    public function down(): void
    {
        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropConstrainedForeignId('lapangan_id');
            $table->dropColumn(['hari', 'jam_mulai', 'jam_selesai', 'status']);
        });
    }
};
