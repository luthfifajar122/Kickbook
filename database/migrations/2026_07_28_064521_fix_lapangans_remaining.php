<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lapangans', function (Blueprint $table) {
            if (!Schema::hasColumn('lapangans', 'jenis')) {
                $table->enum('jenis', ['Sintetis', 'Vinyl', 'Rumput'])->default('Sintetis');
            }
            if (!Schema::hasColumn('lapangans', 'harga_per_jam')) {
                $table->integer('harga_per_jam');
            }
            if (!Schema::hasColumn('lapangans', 'foto')) {
                $table->string('foto')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('lapangans', function (Blueprint $table) {
            $table->dropColumn(['jenis', 'harga_per_jam', 'foto']);
        });
    }
};
