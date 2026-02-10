@php
    /** @var \App\Models\Pendaftar|null $pendaftar */
    /** @var \Illuminate\Support\Collection|\App\Models\DokumenPendaftar[] $dokumen */
    /** @var \Illuminate\Support\Collection|\App\Models\Pengumuman[] $pengumuman */
    /** @var \App\Models\JadwalSeleksi|null $jadwalUjian */
    $title = 'Dashboard Calon Mahasiswa';
@endphp
@use('Illuminate\Support\Str')

@extends('layouts.student')

@section('content')
    <div class="flex flex-col max-w-[1280px] mx-auto px-6 lg:px-12 py-8 gap-8">
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 pb-2 border-b border-gray-100 dark:border-gray-800/50 animate-fade-in-up delay-100">
            <div class="flex flex-col gap-1">
                <p class="text-sm font-medium text-primary uppercase tracking-wide">Dashboard Calon Mahasiswa</p>
                <h1 class="text-3xl md:text-4xl font-black tracking-tight text-[#111318] dark:text-white">Selamat
                    Datang,
                    {{ isset($pendaftar->nama_lengkap) ? explode(' ', $pendaftar->nama_lengkap)[0] : 'Calon Mahasiswa' }}
                </h1>
                <p class="text-[#616f89] dark:text-gray-400 text-sm md:text-base">Jalur Reguler Gelombang 1 • Tahun
                    Akademik 2024/2025</p>
            </div>
            <div class="flex gap-3">
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 animate-fade-in-up delay-200">
            <div
                class="group bg-surface-light dark:bg-surface-dark p-5 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between h-full gap-3">
                <div class="flex items-center justify-between text-[#616f89] dark:text-gray-400">
                    <p class="text-sm font-medium">Status Pendaftaran</p>
                    <span class="material-symbols-outlined group-hover:text-primary transition-colors">assignment_ind</span>
                </div>
                <div>
                    @if(isset($pendaftar) && $pendaftar->status == 'Diterima')
                        <div class="flex items-center gap-2 mb-1">
                            <span class="size-2 rounded-full bg-green-500 animate-pulse"></span>
                            <p class="text-xl font-bold text-[#111318] dark:text-white">Mahasiswa Baru</p>
                        </div>
                        <p class="text-xs text-gray-500">Selamat! Anda resmi diterima.</p>
                    @elseif(isset($pendaftar) && $pendaftar->status == 'Ditolak')
                        <div class="flex items-center gap-2 mb-1">
                            <span class="size-2 rounded-full bg-red-500 animate-pulse"></span>
                            <p class="text-xl font-bold text-[#111318] dark:text-white">Segera Revisi</p>
                        </div>
                        <p class="text-xs text-gray-500">Mohon perbaiki dokumen Anda sesuai catatan.</p>
                        @if($pendaftar->catatan)
                            <div class="mt-2 p-3 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-800">
                                <p class="text-[10px] font-bold text-red-700 dark:text-red-400 mb-0.5">Catatan Admin:</p>
                                <p class="text-xs text-red-600 dark:text-red-300 leading-tight">{{ $pendaftar->catatan }}</p>
                            </div>
                        @endif
                    @else
                        <div class="flex items-center gap-2 mb-1">
                            <span class="size-2 rounded-full bg-yellow-500 animate-pulse"></span>
                            <p class="text-xl font-bold text-[#111318] dark:text-white">
                                {{ isset($pendaftar) ? ($pendaftar->status ?? 'Menunggu Verifikasi') : 'Belum Mendaftar' }}
                            </p>
                        </div>
                        <p class="text-xs text-gray-500">
                            {{ isset($pendaftar) ? 'Data sedang diperiksa admin.' : 'Silakan lengkapi formulir pendaftaran.' }}
                        </p>
                    @endif
                </div>
            </div>
            <div
                class="group bg-surface-light dark:bg-surface-dark p-5 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between h-full gap-3">
                <div class="flex items-center justify-between text-[#616f89] dark:text-gray-400">
                    <p class="text-sm font-medium">Dokumen</p>
                    <span class="material-symbols-outlined group-hover:text-primary transition-colors">folder_open</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-[#111318] dark:text-white">{{ count($dokumen ?? []) }} <span
                            class="text-gray-400 text-lg font-normal">/ 8</span></p>
                    <p
                        class="text-xs {{ count($dokumen ?? []) < 8 ? 'text-red-500 bg-red-50 dark:bg-red-900/20' : 'text-green-500 bg-green-50 dark:bg-green-900/20' }} mt-1 font-medium inline-block px-2 py-0.5 rounded">
                        {{ 8 - count($dokumen ?? []) }} belum diunggah
                    </p>
                </div>
            </div>
            <div
                class="group bg-surface-light dark:bg-surface-dark p-5 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between h-full gap-3">
                <div class="flex items-center justify-between text-[#616f89] dark:text-gray-400">
                    <p class="text-sm font-medium">Tagihan</p>
                    <span class="material-symbols-outlined group-hover:text-primary transition-colors">payments</span>
                </div>
                <div>
                    @if(isset($pendaftar) && $pendaftar->status_pembayaran == 'lunas')
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">Lunas</p>
                        <p class="text-xs text-gray-500 mt-1">Pembayaran terverifikasi</p>
                    @else
                        <p class="text-2xl font-bold text-red-600 dark:text-red-400">Belum Lunas</p>
                        <p class="text-xs text-gray-500 mt-1">Segera lakukan pembayaran</p>
                    @endif
                </div>
            </div>
            <div
                class="group bg-surface-light dark:bg-surface-dark p-5 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between h-full gap-3">
                <div class="flex items-center justify-between text-[#616f89] dark:text-gray-400">
                    <p class="text-sm font-medium">Jadwal Ujian</p>
                    <span class="material-symbols-outlined group-hover:text-primary transition-colors">event</span>
                </div>
                <div>
                    @if($jadwalUjian)
                        <p class="text-xl font-bold text-[#111318] dark:text-white">
                            {{ \Carbon\Carbon::parse($jadwalUjian->tanggal)->translatedFormat('d F Y') }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ \Carbon\Carbon::parse($jadwalUjian->waktu)->format('H:i') }} WIB
                        </p>
                    @else
                        <p class="text-xl font-bold text-[#111318] dark:text-white">Belum Ada Jadwal</p>
                        <p class="text-xs text-gray-500 mt-1">Pantau terus pengumuman</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 flex flex-col gap-6 animate-fade-in-up delay-300">
                <div
                    class="bg-surface-light dark:bg-surface-dark rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm p-6 md:p-8 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 pointer-events-none">
                    </div>
                    <div
                        class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2 relative z-10">
                        <div>
                            <h3 class="text-lg font-bold text-[#111318] dark:text-white">Progress Pendaftaran</h3>
                            <p class="text-sm text-gray-500">Langkah-langkah menuju kampus impian</p>
                        </div>
                        <span
                            class="bg-blue-50 dark:bg-blue-900/30 text-primary dark:text-blue-300 text-xs font-bold px-3 py-1 rounded-full border border-blue-100 dark:border-blue-800">Tahap
                            2 dari 5</span>
                    </div>
                    <div class="flex flex-col gap-4 relative z-10">
                        <div class="flex justify-between text-sm font-medium">
                            <span class="text-[#111318] dark:text-white">Kelengkapan Data</span>
                            <span class="text-primary font-bold">60%</span>
                        </div>
                        <div class="h-3 w-full bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-primary rounded-full relative" style="width: 60%">
                                <div class="absolute inset-0 bg-white/20 w-full h-full"></div>
                            </div>
                        </div>
                        <p class="text-sm text-[#616f89] dark:text-gray-400 leading-relaxed">
                            Lengkapi formulir biodata dan unggah dokumen pendukung (Ijazah &amp; Transkrip) untuk
                            melanjutkan ke tahap verifikasi admin.
                        </p>
                    </div>
                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4 relative z-10">
                        <a class="group flex items-center gap-4 p-4 rounded-xl border border-gray-100 dark:border-gray-700 hover:border-primary/50 hover:bg-blue-50 dark:hover:bg-blue-900/10 transition-all cursor-pointer bg-white dark:bg-surface-dark"
                            href="{{ route('mahasiswa.pendaftaran') }}">
                            <div
                                class="size-12 rounded-lg bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center text-primary group-hover:scale-110 transition-transform shadow-sm">
                                <span class="material-symbols-outlined">description</span>
                            </div>
                            <div>
                                <p
                                    class="font-bold text-sm group-hover:text-primary transition-colors text-[#111318] dark:text-white">
                                    Isi Biodata</p>
                                <p class="text-xs text-gray-500">Data diri &amp; sekolah</p>
                            </div>
                            <span
                                class="material-symbols-outlined ml-auto text-gray-300 group-hover:text-primary">arrow_forward_ios</span>
                        </a>
                        <a class="group flex items-center gap-4 p-4 rounded-xl border border-gray-100 dark:border-gray-700 hover:border-primary/50 hover:bg-blue-50 dark:hover:bg-blue-900/10 transition-all cursor-pointer bg-white dark:bg-surface-dark"
                            href="{{ route('mahasiswa.upload') }}">
                            <div
                                class="size-12 rounded-lg bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center text-primary group-hover:scale-110 transition-transform shadow-sm">
                                <span class="material-symbols-outlined">upload_file</span>
                            </div>
                            <div>
                                <p
                                    class="font-bold text-sm group-hover:text-primary transition-colors text-[#111318] dark:text-white">
                                    Unggah Dokumen</p>
                                <p class="text-xs text-gray-500">Ijazah, Foto, dll</p>
                            </div>
                            <span
                                class="material-symbols-outlined ml-auto text-gray-300 group-hover:text-primary">arrow_forward_ios</span>
                        </a>
                    </div>
                </div>
                <div
                    class="bg-surface-light dark:bg-surface-dark rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-[#111318] dark:text-white">Dokumen Terunggah</h3>
                        <a class="text-sm text-primary font-medium hover:underline"
                            href="{{ route('mahasiswa.upload') }}">Lihat Semua</a>
                    </div>
                    <div class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse($dokumen ?? [] as $type => $doc)
                            <div
                                class="flex items-center justify-between p-4 bg-white dark:bg-surface-dark hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors {{ $doc->status == 'invalid' ? 'border-l-4 border-red-500 bg-red-50/10 dark:bg-red-900/10' : '' }}">
                                <div class="flex flex-col w-full">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="size-10 shrink-0 rounded-full {{ $doc->status == 'invalid' ? 'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400' : 'bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400' }} flex items-center justify-center">
                                            <span
                                                class="material-symbols-outlined text-xl">{{ $doc->status == 'invalid' ? 'warning' : 'check_circle' }}</span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2">
                                                <p class="font-bold text-sm text-[#111318] dark:text-white uppercase truncate">
                                                    {{ str_replace('_', ' ', $type) }}
                                                </p>
                                                @if($doc->status == 'invalid')
                                                    <span
                                                        class="text-[10px] font-bold bg-red-100 text-red-700 px-2 py-0.5 rounded-full">Perlu
                                                        Revisi</span>
                                                @endif
                                            </div>
                                            <p class="text-xs text-gray-500 truncate">
                                                {{ Str::limit($doc->original_name, 25) }}
                                            </p>
                                        </div>
                                        <button
                                            class="shrink-0 p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-400 hover:text-primary transition-colors"><span
                                                class="material-symbols-outlined">visibility</span></button>
                                    </div>
                                    @if($doc->status == 'invalid' && $doc->catatan)
                                        <div
                                            class="mt-3 ml-14 p-3 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-800">
                                            <p
                                                class="text-[10px] font-bold text-red-700 dark:text-red-400 mb-0.5 flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[12px]">edit_note</span> Catatan
                                                Revisi:
                                            </p>
                                            <p class="text-xs text-red-600 dark:text-red-300 leading-tight">{{ $doc->catatan }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="p-6 text-center text-gray-500 text-sm">Belum ada dokumen yang diunggah.</div>
                        @endforelse

                        @if(count($dokumen ?? []) < 8)
                            <div
                                class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors bg-red-50/50 dark:bg-red-900/10">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="size-10 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-red-600 dark:text-red-400">
                                        <span class="material-symbols-outlined text-xl">warning</span>
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm text-red-700 dark:text-red-300">Dokumen Belum Lengkap
                                        </p>
                                        <p class="text-xs text-red-500 dark:text-red-400 font-medium">Dokumen wajib belum
                                            tersedia</p>
                                    </div>
                                </div>
                                <a href="{{ route('mahasiswa.upload') }}"
                                    class="text-white bg-primary hover:bg-blue-700 font-bold text-xs px-4 py-2 rounded-lg shadow-sm hover:shadow-md transition-all flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">upload</span>
                                    Upload
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-6 animate-fade-in-up delay-400">
                <div
                    class="bg-surface-light dark:bg-surface-dark rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm p-6">
                    <h3 class="text-lg font-bold mb-5 flex items-center gap-2 text-[#111318] dark:text-white">
                        <span class="material-symbols-outlined text-primary">campaign</span>
                        Pengumuman Terbaru
                    </h3>
                    <div class="space-y-6">
                        @forelse($pengumuman as $info)
                            <div class="flex gap-3 items-start relative pl-4 border-l-2 border-primary">
                                <div>
                                    <p class="text-sm font-bold text-[#111318] dark:text-white">{{ $info->judul }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5 leading-relaxed">
                                        {{ Str::limit($info->isi, 100) }}
                                    </p>
                                    <span
                                        class="text-[10px] text-gray-400 mt-2 block font-medium">{{ $info->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <p class="text-sm text-gray-400 italic">Belum ada pengumuman.</p>
                            </div>
                        @endforelse
                    </div>
                    @if(count($pengumuman) > 0)
                        <!-- Optional: Link simply scrolls or reloads for now since there is no detailed page yet -->
                        <button class="w-full mt-6 text-center text-xs font-bold text-primary hover:underline">Lihat
                            Semua</button>
                    @endif
                </div>
                <div
                    class="relative overflow-hidden rounded-xl bg-gradient-to-br from-primary to-blue-600 p-6 text-white shadow-lg group">
                    <div
                        class="absolute -right-4 -top-4 size-24 rounded-full bg-white/10 blur-xl group-hover:bg-white/20 transition-all duration-700">
                    </div>
                    <div
                        class="absolute -bottom-4 -left-4 size-32 rounded-full bg-white/10 blur-xl group-hover:bg-white/20 transition-all duration-700">
                    </div>
                    <div class="relative z-10 flex flex-col items-start">
                        <div class="bg-white/20 p-2 rounded-lg mb-3 backdrop-blur-sm">
                            <span class="material-symbols-outlined text-2xl">support_agent</span>
                        </div>
                        <h3 class="text-lg font-bold">Butuh Bantuan?</h3>
                        <p class="text-blue-100 text-sm mt-2 leading-relaxed">
                            Tim admin kami siap membantu Anda Senin - Jumat (08:00 - 16:00).
                        </p>
                        <button
                            class="mt-5 w-full bg-white text-primary font-bold text-sm py-3 rounded-lg shadow-md hover:bg-gray-50 transition-colors flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-lg">chat</span>
                            Hubungi Kami
                        </button>
                    </div>
                </div>
                <a class="bg-surface-light dark:bg-surface-dark rounded-xl border border-gray-100 dark:border-gray-800 p-4 flex items-center gap-4 hover:border-primary/50 hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition-all cursor-pointer group shadow-sm"
                    href="{{ route('mahasiswa.status') }}">
                    <div
                        class="size-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">manage_search</span>
                    </div>
                    <div class="flex-1">
                        <p
                            class="text-sm font-bold text-[#111318] dark:text-white group-hover:text-primary transition-colors">
                            Cek Status</p>
                        <p class="text-xs text-gray-500">Lihat status pendaftaran Anda</p>
                    </div>
                    <span
                        class="material-symbols-outlined text-gray-400 group-hover:text-primary transition-colors">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
@endsection