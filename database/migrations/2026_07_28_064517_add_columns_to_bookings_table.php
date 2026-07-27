<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lapangan_id')->constrained()->cascadeOnDelete();
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('total_harga');
            $table->enum('status', ['Pending', 'Dibayar', 'Selesai', 'Dibatalkan'])->default('Pending');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('lapangan_id');
            $table->dropColumn(['tanggal', 'jam_mulai', 'jam_selesai', 'total_harga', 'status']);
        });
    }
};
