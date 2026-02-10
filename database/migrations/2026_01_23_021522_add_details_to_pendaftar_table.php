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
            $columns = [
                'agama' => 'string',
                'tinggi_badan' => 'integer',
                'berat_badan' => 'integer',
                'kewarganegaraan' => 'string',
                'status_pernikahan' => 'string',
                'npwp' => 'string',
                'transportasi' => 'string',
                'tinggal_bersama' => 'string',
                'rt' => 'string',
                'rw' => 'string',
                'kode_pos' => 'string',
                'negara' => 'string',
                'penerima_kps' => 'string',
                'no_kps' => 'string',
                'peserta_kip' => 'string',
                'no_kip' => 'string',
                'alamat_sekolah_rt' => 'string',
                'alamat_sekolah_rw' => 'string',
                'alamat_sekolah_kelurahan' => 'string',
                'alamat_sekolah_kecamatan' => 'string',
                'alamat_sekolah_kota' => 'string',
                'alamat_sekolah_provinsi' => 'string',
                'alamat_sekolah_negara' => 'string',
                'no_ijazah' => 'string',
                'status_ayah' => 'string',
                'nik_ayah' => 'string',
                'agama_ayah' => 'string',
                'tempat_lahir_ayah' => 'string',
                'tanggal_lahir_ayah' => 'date',
                'pendidikan_ayah' => 'string',
                'penghasilan_ayah' => 'string',
                'no_hp_ayah' => 'string',
                'alamat_ayah' => 'string',
                'rt_ayah' => 'string',
                'rw_ayah' => 'string',
                'kelurahan_ayah' => 'string',
                'kecamatan_ayah' => 'string',
                'kota_ayah' => 'string',
                'provinsi_ayah' => 'string',
                'negara_ayah' => 'string',
                'status_ibu' => 'string',
                'nik_ibu' => 'string',
                'agama_ibu' => 'string',
                'tempat_lahir_ibu' => 'string',
                'tanggal_lahir_ibu' => 'date',
                'pendidikan_ibu' => 'string',
                'penghasilan_ibu' => 'string',
                'no_hp_ibu' => 'string',
                'alamat_ibu' => 'string',
                'rt_ibu' => 'string',
                'rw_ibu' => 'string',
                'kelurahan_ibu' => 'string',
                'kecamatan_ibu' => 'string',
                'kota_ibu' => 'string',
                'provinsi_ibu' => 'string',
                'negara_ibu' => 'string',
                'nama_wali' => 'string',
                'hubungan_wali' => 'string',
                'penghasilan_wali' => 'string',
                'no_hp_wali' => 'string',
                'pekerjaan_wali' => 'string',
                'sumber_biaya' => 'string',
                'status_akreditasi_asal' => 'string',
                'ipk' => 'string',
            ];

            foreach ($columns as $column => $type) {
                if (!Schema::hasColumn('pendaftar', $column)) {
                    if ($type === 'string') {
                        $table->string($column)->nullable();
                    } elseif ($type === 'integer') {
                        $table->integer($column)->nullable();
                    } elseif ($type === 'date') {
                        $table->date($column)->nullable();
                    }
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->dropColumn([
                'agama',
                'tinggi_badan',
                'berat_badan',
                'kewarganegaraan',
                'status_pernikahan',
                'npwp',
                'transportasi',
                'tinggal_bersama',
                'rt',
                'rw',
                'kode_pos',
                'negara',
                'penerima_kps',
                'no_kps',
                'peserta_kip',
                'no_kip',
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
                'agama_ibu',
                'tempat_lahir_ibu',
                'tanggal_lahir_ibu',
                'pendidikan_ibu',
                'penghasilan_ibu',
                'no_hp_ibu',
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
