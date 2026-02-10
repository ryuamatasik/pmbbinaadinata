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
            // Modal 2 Additional Details
            $table->boolean('penerima_kps')->default(false);
            $table->string('no_kps', 30)->nullable();
            $table->boolean('peserta_kip')->default(false);
            $table->string('no_kip', 30)->nullable();
            $table->string('transportasi', 50)->nullable();
            $table->string('tinggal_bersama', 50)->nullable();
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->string('negara', 50)->nullable();

            // Modal 3 School Detailed Address & Ijazah
            $table->string('alamat_sekolah_rt', 5)->nullable();
            $table->string('alamat_sekolah_rw', 5)->nullable();
            $table->string('alamat_sekolah_kelurahan', 60)->nullable();
            $table->string('alamat_sekolah_kecamatan', 60)->nullable();
            $table->string('alamat_sekolah_kota', 60)->nullable();
            $table->string('alamat_sekolah_provinsi', 60)->nullable();
            $table->string('alamat_sekolah_negara', 50)->nullable();
            $table->string('no_ijazah', 50)->nullable();

            // Modal 4 Parents - Ayah
            $table->string('status_ayah', 20)->nullable();
            $table->string('nik_ayah', 20)->nullable();
            $table->string('agama_ayah', 20)->nullable();
            $table->string('tempat_lahir_ayah', 60)->nullable();
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->string('pendidikan_ayah', 50)->nullable();
            $table->string('penghasilan_ayah', 50)->nullable();
            $table->string('no_hp_ayah', 20)->nullable();
            // Ayah Address
            $table->string('alamat_ayah', 150)->nullable();
            $table->string('rt_ayah', 5)->nullable();
            $table->string('rw_ayah', 5)->nullable();
            $table->string('kelurahan_ayah', 60)->nullable();
            $table->string('kecamatan_ayah', 60)->nullable();
            $table->string('kota_ayah', 60)->nullable();
            $table->string('provinsi_ayah', 60)->nullable();
            $table->string('negara_ayah', 50)->nullable();

            // Modal 4 Parents - Ibu
            $table->string('status_ibu', 20)->nullable();
            $table->string('nik_ibu', 20)->nullable();
            $table->string('no_hp_ibu', 20)->nullable();
            $table->string('penghasilan_ibu', 50)->nullable();
            // Ibu Address
            $table->string('alamat_ibu', 150)->nullable();
            $table->string('rt_ibu', 5)->nullable();
            $table->string('rw_ibu', 5)->nullable();
            $table->string('kelurahan_ibu', 60)->nullable();
            $table->string('kecamatan_ibu', 60)->nullable();
            $table->string('kota_ibu', 60)->nullable();
            $table->string('provinsi_ibu', 60)->nullable();
            $table->string('negara_ibu', 50)->nullable();

            // Modal 4 Parents - Wali
            $table->string('nama_wali', 100)->nullable();
            $table->string('hubungan_wali', 30)->nullable();
            $table->string('penghasilan_wali', 50)->nullable();
            $table->string('no_hp_wali', 20)->nullable();
            $table->string('pekerjaan_wali', 50)->nullable();

            // Modal 4 Funding
            $table->string('sumber_biaya', 20)->nullable();

            // Modal 5 Transfer
            $table->string('status_akreditasi_asal', 10)->nullable();
            $table->decimal('ipk', 3, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->dropColumn([
                'penerima_kps',
                'no_kps',
                'peserta_kip',
                'no_kip',
                'transportasi',
                'tinggal_bersama',
                'rt',
                'rw',
                'kode_pos',
                'negara',
                'alamat_sekolah_rt',
                'alamat_sekolah_rw',
                'alamat_sekolah_kelurahan',
                'alamat_sekolah_kecamatan',
                'alamat_sekolah_kota',
                'alamat_sekolah_provinsi',
                'alamat_sekolah_negara',
                'no_ijazah',
                'status_ayah',
                'nik_ayah',
                'agama_ayah',
                'tempat_lahir_ayah',
                'tanggal_lahir_ayah',
                'pendidikan_ayah',
                'penghasilan_ayah',
                'no_hp_ayah',
                'alamat_ayah',
                'rt_ayah',
                'rw_ayah',
                'kelurahan_ayah',
                'kecamatan_ayah',
                'kota_ayah',
                'provinsi_ayah',
                'negara_ayah',
                'status_ibu',
                'nik_ibu',
                'no_hp_ibu',
                'penghasilan_ibu',
                'alamat_ibu',
                'rt_ibu',
                'rw_ibu',
                'kelurahan_ibu',
                'kecamatan_ibu',
                'kota_ibu',
                'provinsi_ibu',
                'negara_ibu',
                'nama_wali',
                'hubungan_wali',
                'penghasilan_wali',
                'no_hp_wali',
                'pekerjaan_wali',
                'sumber_biaya',
                'status_akreditasi_asal',
                'ipk'
            ]);
        });
    }
};
