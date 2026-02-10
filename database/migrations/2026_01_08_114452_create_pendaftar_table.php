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
        Schema::create('pendaftar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nomor_pendaftaran')->unique()->nullable();
            $table->enum('gelombang', ['1', '2', '3']);
            $table->string('pilihan_prodi');

            // Biodata
            $table->string('nik');
            $table->string('nisn');
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('golongan_darah')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');

            // Alamat
            $table->text('alamat_lengkap');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');

            // Kontak
            $table->string('email');
            $table->string('no_hp');

            // Sekolah
            $table->string('nama_sekolah');
            $table->string('jurusan_sekolah');
            $table->year('tahun_lulus');
            $table->decimal('nilai_rata_rata', 5, 2);
            $table->string('alamat_sekolah');

            // Orang Tua
            $table->string('nama_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('hp_ayah');
            $table->string('nama_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('hp_ibu');

            // Transfer (Nullable)
            $table->string('univ_asal')->nullable();
            $table->string('prodi_asal')->nullable();

            $table->enum('status', ['draft', 'submitted', 'verified', 'rejected'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftar');
    }
};
