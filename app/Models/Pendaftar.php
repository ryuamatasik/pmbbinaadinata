<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;

    protected $table = 'pendaftar';

    protected $fillable = [
        'user_id',
        'nomor_pendaftaran',
        'gelombang',
        'pilihan_prodi',
        'nik',
        'nisn',
        'nama_lengkap',
        'jenis_kelamin',
        'golongan_darah',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat_lengkap',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'email',
        'no_hp',
        'nama_sekolah',
        'jurusan_sekolah',
        'tahun_lulus',
        'nilai_rata_rata',
        'alamat_sekolah',
        'nama_ayah',
        'pekerjaan_ayah',
        'hp_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'hp_ibu',
        'univ_asal',
        'prodi_asal',
        'status',
        'status_pembayaran',
        'catatan',
        // Modal 2 Additional
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
        // Modal 3 School Address
        'alamat_sekolah_rt',
        'alamat_sekolah_rw',
        'alamat_sekolah_kelurahan',
        'alamat_sekolah_kecamatan',
        'alamat_sekolah_kota',
        'alamat_sekolah_provinsi',
        'alamat_sekolah_negara',
        'no_ijazah',
        // Modal 4 Parents - Ayah
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
        // Modal 4 Parents - Ibu
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
        // Modal 4 Parents - Wali
        'nama_wali',
        'hubungan_wali',
        'penghasilan_wali',
        'no_hp_wali',
        'pekerjaan_wali',
        // Funding
        'sumber_biaya',
        // Modal 5 Transfer
        'status_akreditasi_asal',
        'ipk',
        // Additional Missing Fields
        'agama',
        'tinggi_badan',
        'berat_badan',
        'kewarganegaraan',
        'status_pernikahan',
        'npwp',
    ];

    public function dokumen()
    {
        return $this->hasMany(DokumenPendaftar::class);
    }
}
