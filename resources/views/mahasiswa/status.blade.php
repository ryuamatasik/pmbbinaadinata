<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Halaman Cek Status Pendaftaran</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&amp;display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#135bec",
                        "primary-dark": "#0f4bc4",
                        "background-light": "#f6f6f8",
                        "background-dark": "#101622",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1a2230",
                        "border-light": "#e2e8f0",
                        "border-dark": "#2d3748",
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display antialiased transition-colors duration-200">
    <div class="flex min-h-screen flex-col">
        <header
            class="sticky top-0 z-50 w-full border-b border-border-light dark:border-border-dark bg-surface-light/80 dark:bg-surface-dark/80 backdrop-blur-md"
            x-data="{ mobileMenuOpen: false }">
            <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-4 text-[#111318] dark:text-white">
                    <div class="size-10 flex items-center justify-center">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo"
                            class="w-full h-full object-contain rounded-full">
                    </div>
                    <h2
                        class="text-[#111318] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] hidden sm:block">
                        Bina Adinata</h2>
                </div>
                <div class="flex items-center gap-4">
                    <nav class="hidden md:flex items-center gap-6 mr-2">
                        <a class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-white transition-colors"
                            href="{{ url('/') }}">Beranda</a>
                        <a class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-white transition-colors"
                            href="{{ route('mahasiswa.dashboard') }}">Dashboard</a>
                    </nav>
                    <div class="flex items-center gap-4">
                        <form method="POST" action="{{ route('logout') }}" class="hidden sm:inline">
                            @csrf
                            <button type="submit"
                                class="flex items-center justify-center rounded-lg border border-border-light dark:border-border-dark bg-transparent px-3 py-1.5 text-sm font-medium text-slate-600 dark:text-slate-300 transition-colors hover:bg-slate-100 dark:hover:bg-slate-800">
                                <span class="material-symbols-outlined mr-2 text-[18px]">logout</span>
                                Logout
                            </button>
                        </form>
                        <!-- Mobile Menu Button -->
                        <button type="button" class="md:hidden text-slate-600 dark:text-slate-300 hover:text-primary"
                            onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                            <span class="material-symbols-outlined text-[24px]">menu</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Dropdown -->
            <div id="mobile-menu"
                class="hidden md:hidden border-t border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark px-4 py-4 space-y-3 shadow-lg absolute w-full left-0 top-[64px] z-40">
                <a class="block text-base font-medium text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-white transition-colors"
                    href="{{ url('/') }}">
                    <span class="material-symbols-outlined align-bottom mr-2 text-[20px]">home</span> Beranda
                </a>
                <a class="block text-base font-medium text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-white transition-colors"
                    href="{{ route('mahasiswa.dashboard') }}">
                    <span class="material-symbols-outlined align-bottom mr-2 text-[20px]">dashboard</span> Dashboard
                </a>
                <div class="border-t border-border-light dark:border-border-dark pt-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex w-full items-center rounded-lg px-2 py-2 text-base font-medium text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/10 transition-colors">
                            <span class="material-symbols-outlined mr-2 text-[20px]">logout</span>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>
        <main class="flex-1 py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
            <div class="mb-8">
                <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white sm:text-4xl">Cek Status
                    Pendaftaran</h1>
                <p class="mt-2 text-lg text-slate-500 dark:text-slate-400">Halo, <span
                        class="font-medium text-primary dark:text-blue-400">{{ $pendaftar->nama_lengkap ?? 'Calon Mahasiswa' }}</span>.
                    Pantau proses seleksi penerimaan mahasiswa baru Anda di sini.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-6">
                    <div
                        class="overflow-hidden rounded-xl border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark shadow-sm">
                        <div class="border-b border-border-light dark:border-border-dark px-6 py-4">
                            <h2 class="text-lg font-bold text-slate-900 dark:text-white">Alur Pendaftaran</h2>
                        </div>
                        <div class="p-6">
                            <div class="relative flex gap-4 pb-8 group">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 ring-4 ring-white dark:ring-surface-dark z-10">
                                        <span class="material-symbols-outlined text-[20px]">check_circle</span>
                                    </div>
                                    <div class="absolute top-8 bottom-0 w-0.5 bg-green-200 dark:bg-green-800/50"></div>
                                </div>
                                <div class="flex-1 pt-1">
                                    <div class="flex justify-between items-start mb-1">
                                        <h3 class="text-base font-bold text-slate-900 dark:text-white">Pendaftaran Akun
                                        </h3>
                                        <span
                                            class="text-xs font-medium text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/20 px-2 py-0.5 rounded-full">Selesai</span>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Akun berhasil dibuat pada
                                        {{ $timeline['akun_created'] }}
                                    </p>
                                </div>
                            </div>
                            <div class="relative flex gap-4 pb-8 group">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 ring-4 ring-white dark:ring-surface-dark z-10">
                                        <span class="material-symbols-outlined text-[20px]">check_circle</span>
                                    </div>
                                    <div class="absolute top-8 bottom-0 w-0.5 bg-green-200 dark:bg-green-800/50"></div>
                                </div>
                                <div class="flex-1 pt-1">
                                    <div class="flex justify-between items-start mb-1">
                                        <h3 class="text-base font-bold text-slate-900 dark:text-white">Pengisian Biodata
                                            &amp; Berkas</h3>
                                        <span
                                            class="text-xs font-medium text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/20 px-2 py-0.5 rounded-full">Selesai</span>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Data diri dan berkas lengkap
                                        pada {{ $timeline['biodata_completed'] }}</p>
                                </div>
                            </div>
                            <div class="relative flex gap-4 pb-8 group">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-primary text-white ring-4 ring-primary/20 z-10 shadow-lg shadow-primary/30">
                                        <span class="material-symbols-outlined text-[20px] animate-pulse">sync</span>
                                    </div>
                                    <div class="absolute top-8 bottom-0 w-0.5 bg-border-light dark:bg-border-dark">
                                    </div>
                                </div>
                                <div class="flex-1 pt-1">
                                    <div class="flex justify-between items-start mb-1">
                                        <h3 class="text-base font-bold text-primary dark:text-blue-400">Verifikasi
                                            Dokumen</h3>
                                        <span
                                            class="text-xs font-medium text-primary dark:text-blue-300 bg-blue-50 dark:bg-blue-900/20 px-2 py-0.5 rounded-full">{{ $timeline['verifikasi_status'] }}</span>
                                    </div>
                                    @php
                                        $dokumen_terverifikasi = \App\Models\DokumenPendaftar::where('pendaftar_id', $pendaftar->id)->whereIn('status', ['valid', 'Terverifikasi'])->first();
                                        $verifikasi_time = $dokumen_terverifikasi ? $dokumen_terverifikasi->updated_at->format('d M Y, H:i') . ' WIB' : 'Sedang diverifikasi (1-3 hari kerja)';
                                    @endphp
                                    <p class="text-sm text-slate-600 dark:text-slate-300">
                                        {{ $timeline['verifikasi_status'] == 'Selesai' ? 'Dokumen berhasil diverifikasi pada ' . $verifikasi_time : 'Tim admin sedang memverifikasi validitas dokumen yang Anda unggah. Proses ini memakan waktu 1-3 hari kerja.' }}
                                    </p>
                                    <div
                                        class="mt-3 inline-flex items-center gap-2 text-xs text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-900/20 px-3 py-2 rounded-lg border border-amber-100 dark:border-amber-800">
                                        <span class="material-symbols-outlined text-[16px]">info</span>
                                        Pastikan telepon Anda aktif jika admin perlu konfirmasi.
                                    </div>
                                </div>
                            </div>
                            <div class="relative flex gap-4 pb-8 group">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 dark:bg-slate-800 text-slate-400 ring-4 ring-white dark:ring-surface-dark z-10 border border-slate-200 dark:border-slate-700">
                                        <span class="material-symbols-outlined text-[18px]">lock</span>
                                    </div>
                                    <div class="absolute top-8 bottom-0 w-0.5 bg-border-light dark:bg-border-dark">
                                    </div>
                                </div>
                                <div class="flex-1 pt-1 opacity-60">
                                    <div class="flex justify-between items-start mb-1">
                                        <h3 class="text-base font-medium text-slate-900 dark:text-white">Ujian Seleksi
                                            Masuk</h3>
                                        <span
                                            class="text-xs font-medium text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-full">Terkunci</span>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Jadwal:
                                        {{ $timeline['ujian_jadwal'] }}
                                    </p>
                                </div>
                            </div>
                            <div class="relative flex gap-4 group">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 dark:bg-slate-800 text-slate-400 ring-4 ring-white dark:ring-surface-dark z-10 border border-slate-200 dark:border-slate-700">
                                        <span class="material-symbols-outlined text-[18px]">lock</span>
                                    </div>
                                </div>
                                <div class="flex-1 pt-1 opacity-60">
                                    <div class="flex justify-between items-start mb-1">
                                        <h3 class="text-base font-medium text-slate-900 dark:text-white">Pengumuman
                                            Hasil</h3>
                                        <span
                                            class="text-xs font-medium text-slate-500 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-full">Terkunci</span>
                                    </div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Estimasi:
                                        {{ $timeline['pengumuman_estimasi'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-6">
                    <div
                        class="rounded-xl border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark p-6 shadow-sm">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-2">Status Saat Ini</p>
                        <div class="flex items-center gap-3 mb-4">
                            <span class="relative flex h-3 w-3">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span>
                            </span>
                            <h2 class="text-xl font-bold text-slate-900 dark:text-white leading-tight">
                                {{ $pendaftar->status == 'Diterima' ? 'Diterima' : ($pendaftar->status == 'Ditolak' ? 'Segera Revisi' : 'Menunggu Verifikasi') }}
                            </h2>
                        </div>

                        @if($pendaftar->status == 'Ditolak' && $pendaftar->catatan)
                            <div
                                class="mb-4 p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800">
                                <h3 class="text-sm font-bold text-red-700 dark:text-red-400 mb-1 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">warning</span>
                                    Catatan Revisi:
                                </h3>
                                <p class="text-sm text-red-600 dark:text-red-300">{{ $pendaftar->catatan }}</p>
                            </div>
                        @endif

                        <div class="h-1.5 w-full bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden">
                            <div class="h-full bg-primary rounded-full" style="width: {{ $progress }}%"></div>
                        </div>
                        <p class="text-xs text-right mt-1 text-slate-500 dark:text-slate-400">Progres {{ $progress }}%
                        </p>
                    </div>
                    <div
                        class="rounded-xl border border-blue-100 dark:border-blue-900/30 bg-blue-50/50 dark:bg-blue-900/10 p-5">
                        <div class="flex gap-3 mb-3">
                            <div class="text-primary dark:text-blue-400 shrink-0">
                                <span class="material-symbols-outlined">notification_important</span>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-slate-900 dark:text-white">Tindakan Diperlukan</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-300 mt-1 leading-relaxed">
                                    Mohon pastikan seluruh berkas yang diunggah dapat terbaca dengan jelas agar proses
                                    verifikasi lancar.
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('mahasiswa.upload') }}"
                            class="mt-2 w-full flex items-center justify-center gap-2 rounded-lg bg-primary hover:bg-primary-dark text-white text-sm font-medium h-10 px-4 transition-colors shadow-sm shadow-blue-200 dark:shadow-none">
                            <span class="material-symbols-outlined text-[18px]">description</span>
                            Lihat Detail Berkas
                        </a>
                    </div>
                    <div
                        class="rounded-xl border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark p-5">
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                            <span class="material-symbols-outlined text-slate-400 text-[18px]">support_agent</span>
                            Bantuan Pendaftaran
                        </h3>
                        <ul class="space-y-3">
                            <li>
                                <a class="flex items-center gap-3 text-sm text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-blue-400 transition-colors"
                                    href="#">
                                    <span class="material-symbols-outlined text-[18px] text-slate-400">call</span>
                                    (021) 555-0199
                                </a>
                            </li>
                            <li>
                                <a class="flex items-center gap-3 text-sm text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-blue-400 transition-colors"
                                    href="#">
                                    <span class="material-symbols-outlined text-[18px] text-slate-400">mail</span>
                                    admissions@univ.ac.id
                                </a>
                            </li>
                            <li>
                                <a class="flex items-center gap-3 text-sm text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-blue-400 transition-colors"
                                    href="#">
                                    <span class="material-symbols-outlined text-[18px] text-slate-400">chat</span>
                                    Live Chat Admin
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div
                        class="rounded-xl border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark p-5">
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-3">Dokumen Saya</h3>
                        <div
                            class="flex items-center justify-between p-2 rounded-lg border border-border-light dark:border-border-dark bg-slate-50 dark:bg-slate-800/50">
                            <div class="flex items-center gap-2">
                                <span
                                    class="material-symbols-outlined text-gray-400 text-[20px]">insert_drive_file</span>
                                <span class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                    Kartu Peserta (Segera Hadir)
                                </span>
                            </div>

                            <button class="text-slate-300 cursor-not-allowed" title="Fitur belum tersedia" disabled>
                                <span class="material-symbols-outlined text-[20px]">pending</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="mt-auto border-t border-border-light dark:border-border-dark bg-white dark:bg-surface-dark py-8">
            <div class="mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">
                <p class="text-sm text-slate-500 dark:text-slate-400">© 2026 Bina Adinata. All rights
                    reserved.</p>
                <div class="mt-2 flex justify-center gap-4">
                    <a class="text-xs text-slate-400 hover:text-slate-600 dark:hover:text-slate-300" href="#">Privacy
                        Policy</a>
                    <a class="text-xs text-slate-400 hover:text-slate-600 dark:hover:text-slate-300" href="#">Terms of
                        Service</a>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>