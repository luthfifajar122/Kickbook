<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->string('metode')->default('transfer');
            $table->string('bukti_bayar')->nullable();
            $table->integer('total_bayar');
            $table->string('status')->default('Pending');
        });
    }

    public function down(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->dropConstrainedForeignId('booking_id');
            $table->dropColumn(['metode', 'bukti_bayar', 'total_bayar', 'status']);
        });
    }
};
