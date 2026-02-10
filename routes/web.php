<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProfileController; // Added this line
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/pendaftar/{id}', [\App\Http\Controllers\AdminController::class, 'detail'])->name('admin.pendaftar.detail');
    Route::get('/pendaftar/{id}/edit', [\App\Http\Controllers\AdminController::class, 'edit'])->name('admin.pendaftar.edit');
    Route::put('/pendaftar/{id}', [\App\Http\Controllers\AdminController::class, 'update'])->name('admin.pendaftar.update');
    Route::delete('/pendaftar/{id}', [\App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.pendaftar.destroy');
    Route::post('/pendaftar/{id}/update-status', [\App\Http\Controllers\AdminController::class, 'updateStatus'])->name('admin.pendaftar.update_status');
    Route::get('/data-calon-mahasiswa', [\App\Http\Controllers\AdminController::class, 'dataCalonMahasiswa'])->name('admin.data_calon_mahasiswa');
    Route::get('/data-calon-mahasiswa/export', [\App\Http\Controllers\AdminController::class, 'exportDataCalonMahasiswa'])->name('admin.data_calon_mahasiswa.export');
    Route::put('/data-calon-mahasiswa/{id}/toggle-bayar', [\App\Http\Controllers\AdminController::class, 'updateStatusPembayaran'])->name('admin.pendaftar.toggle_bayar');
    Route::get('/verifikasi-berkas/{id?}', [AdminController::class, 'verifikasiBerkas'])->name('admin.verifikasi_berkas');
    Route::post('/verifikasi-berkas/store', [AdminController::class, 'storeVerifikasi'])->name('admin.verifikasi.store');
    Route::post('/verifikasi-berkas/dokumen/{id}', [AdminController::class, 'updateDokumenStatus'])->name('admin.verifikasi.dokumen_update');
    Route::get('/jadwal-seleksi', [\App\Http\Controllers\AdminController::class, 'jadwalSeleksi'])->name('admin.jadwal_seleksi');
    Route::post('/jadwal-seleksi', [\App\Http\Controllers\AdminController::class, 'storeJadwal'])->name('admin.jadwal_seleksi.store');
    Route::put('/jadwal-seleksi/{id}', [\App\Http\Controllers\AdminController::class, 'updateJadwal'])->name('admin.jadwal_seleksi.update');
    Route::delete('/jadwal-seleksi/{id}', [\App\Http\Controllers\AdminController::class, 'destroyJadwal'])->name('admin.jadwal_seleksi.destroy');
    Route::get('/kelola-dokumen', [\App\Http\Controllers\AdminController::class, 'kelolaDokumen'])->name('admin.kelola_dokumen');
    Route::post('/kelola-dokumen', [\App\Http\Controllers\AdminController::class, 'storeDokumen'])->name('admin.kelola_dokumen.store');
    Route::put('/kelola-dokumen/{id}', [\App\Http\Controllers\AdminController::class, 'updateDokumen'])->name('admin.kelola_dokumen.update');
    Route::delete('/kelola-dokumen/{id}', [\App\Http\Controllers\AdminController::class, 'destroyDokumen'])->name('admin.kelola_dokumen.destroy');
    Route::get('/pengaturan', [\App\Http\Controllers\AdminController::class, 'pengaturan'])->name('admin.pengaturan');
    Route::post('/pengaturan/profil', [\App\Http\Controllers\AdminController::class, 'saveProfil'])->name('admin.pengaturan.save_profil');
    Route::post('/pengaturan/gelombang', [\App\Http\Controllers\AdminController::class, 'storeGelombang'])->name('admin.pengaturan.store_gelombang');
    Route::patch('/pengaturan/gelombang/{id}', [\App\Http\Controllers\AdminController::class, 'updateGelombangStatus'])->name('admin.pengaturan.update_gelombang_status');
    Route::post('/pengaturan/akun', [\App\Http\Controllers\AdminController::class, 'updateAkun'])->name('admin.pengaturan.update_akun');

    // Pengumuman Routes
    Route::get('/pengumuman', [\App\Http\Controllers\AdminController::class, 'pengumuman'])->name('admin.pengumuman');
    Route::post('/pengumuman', [\App\Http\Controllers\AdminController::class, 'storePengumuman'])->name('admin.pengumuman.store');
    Route::put('/pengumuman/{id}', [\App\Http\Controllers\AdminController::class, 'updatePengumuman'])->name('admin.pengumuman.update');
    Route::delete('/pengumuman/{id}', [\App\Http\Controllers\AdminController::class, 'destroyPengumuman'])->name('admin.pengumuman.destroy');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::middleware(['auth', 'role:pimpinan'])->prefix('pimpinan')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\PimpinanController::class, 'dashboard'])->name('dashboard.pimpinan');
    Route::get('/analitik', [\App\Http\Controllers\PimpinanController::class, 'analitik'])->name('pimpinan.analitik');
    Route::get('/laporan', [\App\Http\Controllers\PimpinanController::class, 'laporan'])->name('pimpinan.laporan');
    Route::get('/laporan/export', [\App\Http\Controllers\PimpinanController::class, 'exportLaporan'])->name('pimpinan.laporan.export');
    Route::get('/pengaturan', [\App\Http\Controllers\PimpinanController::class, 'pengaturan'])->name('pimpinan.pengaturan');
    Route::post('/pengaturan', [\App\Http\Controllers\PimpinanController::class, 'updatePengaturan'])->name('pimpinan.pengaturan.update');
    Route::get('/pendaftar/{id}', [\App\Http\Controllers\PimpinanController::class, 'detail'])->name('pimpinan.pendaftar.detail');
    Route::post('/pendaftar/{id}/approve', [\App\Http\Controllers\PimpinanController::class, 'approve'])->name('pimpinan.pendaftar.approve');
});

Route::get('/dashboard-admin', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard.admin');


Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/formulir-pendaftaran', [PendaftaranController::class, 'index'])->name('mahasiswa.pendaftaran');
    Route::post('/formulir-pendaftaran', [PendaftaranController::class, 'store'])->name('mahasiswa.store');

    Route::get('/formulir-pendaftaran/upload', [PendaftaranController::class, 'uploadIndex'])->name('mahasiswa.upload');
    Route::post('/formulir-pendaftaran/upload', [PendaftaranController::class, 'uploadStore'])->name('mahasiswa.upload.store');

    Route::get('/dashboard-mahasiswa', [PendaftaranController::class, 'dashboard'])->name('mahasiswa.dashboard');
    Route::get('/cek-status', [PendaftaranController::class, 'status'])->name('mahasiswa.status');
    Route::get('/cetak-kartu', [PendaftaranController::class, 'cetakKartu'])->name('mahasiswa.cetak_kartu');
});

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.submit');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [App\Http\Controllers\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [App\Http\Controllers\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [App\Http\Controllers\ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [App\Http\Controllers\ForgotPasswordController::class, 'reset'])->name('password.update');
