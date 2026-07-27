<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ulasans', function (Blueprint $table) {
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('rating');
            $table->text('komentar')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('ulasans', function (Blueprint $table) {
            $table->dropConstrainedForeignId('booking_id');
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn(['rating', 'komentar']);
        });
    }
};
