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
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->string('pilihan_prodi')->nullable()->change();
            $table->string('nik')->nullable()->change();
            $table->string('nisn')->nullable()->change();
            $table->string('nama_lengkap')->nullable()->change();
            $table->string('tempat_lahir')->nullable()->change();
            $table->date('tanggal_lahir')->nullable()->change();
            $table->text('alamat_lengkap')->nullable()->change();
            $table->string('kelurahan')->nullable()->change();
            $table->string('kecamatan')->nullable()->change();
            $table->string('kabupaten')->nullable()->change();
            $table->string('provinsi')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('no_hp')->nullable()->change();
            $table->string('nama_sekolah')->nullable()->change();
            $table->string('jurusan_sekolah')->nullable()->change();
            $table->year('tahun_lulus')->nullable()->change();
            $table->decimal('nilai_rata_rata', 5, 2)->nullable()->change();
            $table->string('alamat_sekolah')->nullable()->change();
            $table->string('nama_ayah')->nullable()->change();
            $table->string('pekerjaan_ayah')->nullable()->change();
            $table->string('hp_ayah')->nullable()->change();
            $table->string('nama_ibu')->nullable()->change();
            $table->string('pekerjaan_ibu')->nullable()->change();
            $table->string('hp_ibu')->nullable()->change();
            $table->string('status_pernikahan')->nullable()->change();
            $table->integer('tinggi_badan')->nullable()->change();
            $table->integer('berat_badan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->string('pilihan_prodi')->nullable(false)->change();
            $table->string('nik')->nullable(false)->change();
            $table->string('nisn')->nullable(false)->change();
            $table->string('nama_lengkap')->nullable(false)->change();
            $table->string('tempat_lahir')->nullable(false)->change();
            $table->date('tanggal_lahir')->nullable(false)->change();
            $table->text('alamat_lengkap')->nullable(false)->change();
            $table->string('kelurahan')->nullable(false)->change();
            $table->string('kecamatan')->nullable(false)->change();
            $table->string('kabupaten')->nullable(false)->change();
            $table->string('provinsi')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('no_hp')->nullable(false)->change();
            $table->string('nama_sekolah')->nullable(false)->change();
            $table->string('jurusan_sekolah')->nullable(false)->change();
            $table->year('tahun_lulus')->nullable(false)->change();
            $table->decimal('nilai_rata_rata', 5, 2)->nullable(false)->change();
            $table->string('alamat_sekolah')->nullable(false)->change();
            $table->string('nama_ayah')->nullable(false)->change();
            $table->string('pekerjaan_ayah')->nullable(false)->change();
            $table->string('hp_ayah')->nullable(false)->change();
            $table->string('nama_ibu')->nullable(false)->change();
            $table->string('pekerjaan_ibu')->nullable(false)->change();
            $table->string('hp_ibu')->nullable(false)->change();
            $table->string('status_pernikahan')->nullable(false)->change();
            $table->integer('tinggi_badan')->nullable(false)->change();
            $table->integer('berat_badan')->nullable(false)->change();
        });
    }
};
