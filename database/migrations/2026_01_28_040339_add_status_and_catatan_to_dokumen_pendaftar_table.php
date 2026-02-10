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
        Schema::table('dokumen_pendaftar', function (Blueprint $table) {
            $table->enum('status', ['pending', 'valid', 'invalid'])->default('pending')->after('original_name');
            $table->text('catatan')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumen_pendaftar', function (Blueprint $table) {
            $table->dropColumn(['status', 'catatan']);
        });
    }
};
