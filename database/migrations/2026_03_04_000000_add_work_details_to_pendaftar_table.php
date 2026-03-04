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
            $table->string('nama_perusahaan')->nullable()->after('pekerjaan_wali');
            $table->string('alamat_perusahaan')->nullable()->after('nama_perusahaan');
            $table->string('telp_perusahaan')->nullable()->after('alamat_perusahaan');
            $table->string('jabatan')->nullable()->after('telp_perusahaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->dropColumn(['nama_perusahaan', 'alamat_perusahaan', 'telp_perusahaan', 'jabatan']);
        });
    }
};
