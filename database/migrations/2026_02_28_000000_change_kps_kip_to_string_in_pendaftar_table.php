<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->string('penerima_kps')->default('Tidak')->change();
            $table->string('peserta_kip')->default('Tidak')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->boolean('penerima_kps')->default(false)->change();
            $table->boolean('peserta_kip')->default(false)->change();
        });
    }
};
