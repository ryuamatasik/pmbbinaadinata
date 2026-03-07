<!DOCTYPE html>

<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Detail Calon Maba (Pimpinan) - Sistem PMB</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#135bec",
                        "background-light": "#f6f6f8",
                        "background-dark": "#101622",
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Lexend', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark min-h-screen text-[#111318] dark:text-white transition-colors duration-200">
    <div class="layout-container flex h-full grow flex-col">
        <!-- TopNavBar -->
        <header
            class="flex items-center justify-between whitespace-nowrap border-b border-solid border-[#dbdfe6] dark:border-[#2a303c] bg-white dark:bg-background-dark px-10 py-3 sticky top-0 z-50">
            <div class="flex items-center gap-4 text-[#111318] dark:text-white">
                <div class="size-6 text-primary">
                    <svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M24 4C25.7818 14.2173 33.7827 22.2182 44 24C33.7827 25.7818 25.7818 33.7827 24 44C22.2182 33.7827 14.2173 25.7818 4 24C14.2173 22.2182 22.2182 14.2173 24 4Z"
                            fill="currentColor"></path>
                    </svg>
                </div>
                <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">Sistem PMB</h2>
            </div>
            <div class="flex flex-1 justify-end gap-8">
                <div class="flex items-center gap-9">
                    <a class="text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="{{ route('dashboard.pimpinan') }}">Dashboard</a>
                    <a class="text-primary text-sm font-bold leading-normal" href="#">Daftar Calon Maba</a>
                    <a class="text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="#">Laporan</a>
                </div>
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 border-2 border-primary/20"
                    data-alt="User profile picture for campus leadership"
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDiDrLW3pbbtvClAbkg_Gwcu9Vg-lvl-IblGBSI0reQlhuEmuAYfHZ4dx2MHIvB6jYVNk4xiJNTbZHNUs4_6d26Icb96NwdUwgOu3lW7JYEqMct8BA876TzyjARK1O7y8qYySJzpRozW7PoRhgT1aCnRpUWJxv1ca-BnCEvWMymYnWTJ9cmo-_NDoN1lXxcULhUHH5nyEVNQgRb_IBFq9b2QgdbAc1-gjsoaXIwMfP4FyuueLSX7Ds7TfJ0dTEZe9a96FFMQasmACU");'>
                </div>
            </div>
        </header>
        <main class="flex flex-1 justify-center py-8">
            <div class="layout-content-container flex flex-col max-w-[1024px] flex-1 px-4 md:px-10">
                <!-- Breadcrumbs -->
                <nav class="flex flex-wrap gap-2 py-2 mb-4">
                    <a class="text-[#616f89] dark:text-gray-400 text-sm font-medium leading-normal hover:text-primary transition-colors flex items-center gap-1"
                        href="{{ route('dashboard.pimpinan') }}">
                        <span class="material-symbols-outlined text-sm">home</span> Daftar Calon Maba
                    </a>
                    <span class="text-[#616f89] text-sm font-medium">/</span>
                    <span class="text-primary text-sm font-medium">Detail Eksekutif</span>
                </nav>
                <!-- ProfileHeader -->
                <div
                    class="bg-white dark:bg-[#1a2130] rounded-xl shadow-sm border border-[#dbdfe6] dark:border-[#2a303c] overflow-hidden mb-6">
                    <div class="flex p-6 flex-col md:flex-row gap-6 items-center md:items-start">
                        <div
                            class="flex w-full flex-col gap-6 md:flex-row md:justify-between items-center md:items-start">
                            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-xl size-32 shadow-md border-4 border-white dark:border-[#2a303c]"
                                    data-alt="Formal portrait of a male student applicant"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAbX1FMUWI_TK87AS-I2tDl-PrSgBP3WLS_FxiEXkgSErKKXKOYka1opbQJz8PdwPFeYOHIU5Y-eBKG_g0d3uUuM6miMXmjlkldldHt6WOJqsgVIVHaE3t-5G8mYTXmErfqpPgp7UBcdFM7bcMCjWCOhp5HZdWDU0juqjac4Ln1Ir_lMNTrrSkW274A9nTz4pbqx6SqjIrT079N6nRFJmYtogNtDw3RspuI7ug53rbmv_v7Nor04ge4aLAsFNqh1anKtPbxiRC5V4Q");'>
                                </div>
                                <div class="flex flex-col text-center md:text-left justify-center h-full">
                                    <h1
                                        class="text-[#111318] dark:text-white text-3xl font-bold leading-tight tracking-tight">
                                        {{ $pendaftar->nama_lengkap ?? 'Budi Santoso' }}
                                    </h1>
                                    <p class="text-[#616f89] dark:text-gray-400 text-lg font-medium">ID:
                                        {{ $pendaftar->nomor_pendaftaran ?? 'PMB2023001' }}
                                    </p>
                                    <div
                                        class="mt-3 inline-flex items-center gap-2 px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-bold w-fit mx-auto md:mx-0">
                                        <span class="relative flex h-2 w-2">
                                            <span
                                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                                        </span>
                                        {{ ucfirst($pendaftar->status ?? 'Menunggu Persetujuan') }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-3 w-full md:w-auto">
                                <button
                                    onclick="openConfirmModal('{{ route('pimpinan.pendaftar.approve', $pendaftar->id) }}', 'Konfirmasi Persetujuan', 'Apakah Anda yakin ingin menyetujui calon mahasiswa ini? Status akan berubah menjadi Diterima.', 'POST', 'green')"
                                    class="flex min-w-[140px] cursor-pointer items-center justify-center gap-2 rounded-lg h-11 px-5 bg-primary text-white text-sm font-bold shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                                    {{ $pendaftar->status == 'Diterima' ? 'disabled' : '' }}>
                                    <span class="material-symbols-outlined text-lg">check_circle</span>
                                    <span>{{ $pendaftar->status == 'Diterima' ? 'Disetujui' : 'Setujui' }}</span>
                                </button>
                                <button
                                    class="flex min-w-[140px] cursor-pointer items-center justify-center gap-2 rounded-lg h-11 px-5 bg-[#f0f2f4] dark:bg-[#2a303c] text-[#111318] dark:text-white text-sm font-bold hover:bg-[#e2e5e9] transition-all">
                                    <span class="material-symbols-outlined text-lg">arrow_back</span>
                                    <span>Kembali</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Main Content (2/3) -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Informasi Pribadi -->
                        <div
                            class="bg-white dark:bg-[#1a2130] rounded-xl shadow-sm border border-[#dbdfe6] dark:border-[#2a303c] p-6">
                            <div class="flex items-center gap-2 mb-6 text-primary">
                                <span class="material-symbols-outlined">person</span>
                                <h3 class="text-lg font-bold">Informasi Pribadi</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-6 gap-x-8 text-sm">
                                <div>
                                    <p class="text-[#616f89] dark:text-gray-400 mb-1">NIK</p>
                                    <p class="font-medium font-mono tracking-wider">{{ $pendaftar->nik ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-[#616f89] dark:text-gray-400 mb-1">Status Pernikahan</p>
                                    <p class="font-medium">{{ $pendaftar->status_pernikahan ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-[#616f89] dark:text-gray-400 mb-1">Tempat, Tanggal Lahir</p>
                                    <p class="font-medium">{{ $pendaftar->tempat_lahir ?? '-' }},
                                        {{ $pendaftar->tanggal_lahir ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-[#616f89] dark:text-gray-400 mb-1">NPWP</p>
                                    <p class="font-medium">{{ $pendaftar->npwp ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-[#616f89] dark:text-gray-400 mb-1">Agama</p>
                                    <p class="font-medium">{{ $pendaftar->agama ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-[#616f89] dark:text-gray-400 mb-1">Jenis Kelamin</p>
                                    <p class="font-medium">
                                        {{ $pendaftar->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                </div>
                                <div class="md:col-span-2 lg:col-span-3">
                                    <p class="text-[#616f89] dark:text-gray-400 mb-1">Alamat Lengkap</p>
                                    <p class="font-medium leading-relaxed">
                                        {{ $pendaftar->alamat_lengkap }}, {{ $pendaftar->kelurahan }},
                                        {{ $pendaftar->kecamatan }}, {{ $pendaftar->kabupaten }},
                                        {{ $pendaftar->provinsi }}
                                        <span class="text-xs text-[#616f89] ml-1">(Kode Pos:
                                            {{ $pendaftar->kode_pos ?? '-' }})</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Akademik & Sekolah -->
                        <div
                            class="bg-white dark:bg-[#1a2130] rounded-xl shadow-sm border border-[#dbdfe6] dark:border-[#2a303c] p-6">
                            <div class="flex items-center gap-2 mb-6 text-primary">
                                <span class="material-symbols-outlined">school</span>
                                <h3 class="text-lg font-bold">Informasi Akademik & Sekolah</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-6 gap-x-8 text-sm">
                                <div>
                                    <p class="text-[#616f89] dark:text-gray-400 mb-1">Nama Sekolah</p>
                                    <p class="font-medium">{{ $pendaftar->nama_sekolah ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-[#616f89] dark:text-gray-400 mb-1">Jurusan</p>
                                    <p class="font-medium">{{ $pendaftar->jurusan_sekolah ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-[#616f89] dark:text-gray-400 mb-1">Tahun Lulus</p>
                                    <p class="font-medium">{{ $pendaftar->tahun_lulus ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-[#616f89] dark:text-gray-400 mb-1">NISN</p>
                                    <p class="font-medium font-mono">{{ $pendaftar->nisn ?? '-' }}</p>
                                </div>
                                <div class="bg-primary/5 dark:bg-primary/10 p-3 rounded-lg border border-primary/10">
                                    <p class="text-primary text-[10px] font-bold uppercase tracking-wider mb-1">Nilai
                                        Rata-rata Rapor</p>
                                    <p class="text-2xl font-black text-primary">{{ $pendaftar->nilai_rata_rata ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Data Pekerjaan & KIP/KPS -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div
                                class="bg-white dark:bg-[#1a2130] rounded-xl shadow-sm border border-[#dbdfe6] dark:border-[#2a303c] p-6">
                                <div class="flex items-center gap-2 mb-4 text-primary">
                                    <span class="material-symbols-outlined text-lg">work</span>
                                    <h3 class="text-base font-bold">Detail Pekerjaan</h3>
                                </div>
                                <div class="space-y-3 text-sm">
                                    <div>
                                        <p class="text-xs text-[#616f89] dark:text-gray-400">Nama Perusahaan</p>
                                        <p class="font-medium">{{ $pendaftar->nama_perusahaan ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-[#616f89] dark:text-gray-400">Jabatan</p>
                                        <p class="font-medium">{{ $pendaftar->jabatan ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-[#616f89] dark:text-gray-400">Alamat Kerja</p>
                                        <p class="font-medium truncate"
                                            title="{{ $pendaftar->alamat_perusahaan ?? '-' }}">
                                            {{ $pendaftar->alamat_perusahaan ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-white dark:bg-[#1a2130] rounded-xl shadow-sm border border-[#dbdfe6] dark:border-[#2a303c] p-6">
                                <div class="flex items-center gap-2 mb-4 text-primary">
                                    <span class="material-symbols-outlined text-lg">card_membership</span>
                                    <h3 class="text-base font-bold">Data KIP / KPS</h3>
                                </div>
                                <div class="space-y-3 text-sm">
                                    <div>
                                        <p class="text-xs text-[#616f89] dark:text-gray-400">No. KIP (Kartu Indonesia
                                            Pintar)</p>
                                        <p class="font-medium font-mono">{{ $pendaftar->no_kip ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-[#616f89] dark:text-gray-400">No. KPS / PKH</p>
                                        <p class="font-medium font-mono">{{ $pendaftar->no_kps ?? '-' }}</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="px-2 py-0.5 rounded bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-[10px] font-bold">
                                            {{ $pendaftar->peserta_kip == 'Ya' ? 'Peserta KIP' : 'Bukan KIP' }}
                                        </span>
                                        <span
                                            class="px-2 py-0.5 rounded bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 text-[10px] font-bold">
                                            {{ $pendaftar->penerima_kps == 'Ya' ? 'Penerima KPS' : 'Bukan KPS' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dokumen Persyaratan -->
                        <div
                            class="bg-white dark:bg-[#1a2130] rounded-xl shadow-sm border border-[#dbdfe6] dark:border-[#2a303c] p-6">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-2 text-primary">
                                    <span class="material-symbols-outlined">folder_open</span>
                                    <h3 class="text-lg font-bold">Dokumen Persyaratan</h3>
                                </div>
                                <span
                                    class="bg-[#f0f2f4] dark:bg-[#2a303c] px-3 py-1 rounded-full text-xs font-bold">{{ $pendaftar->dokumen->count() }}
                                    Berkas</span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @forelse($pendaftar->dokumen as $doc)
                                    <div
                                        class="flex items-center justify-between p-3 rounded-lg border border-[#dbdfe6] dark:border-[#2a303c] bg-[#fbfbfb] dark:bg-[#202737]">
                                        <div class="flex items-center gap-3 overflow-hidden">
                                            <div
                                                class="size-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                                <span class="material-symbols-outlined text-xl">description</span>
                                            </div>
                                            <div class="overflow-hidden">
                                                <p class="text-xs font-bold truncate uppercase">
                                                    {{ str_replace('_', ' ', $doc->jenis_dokumen) }}</p>
                                                <p class="text-[10px] text-[#616f89] dark:text-gray-400 truncate">
                                                    {{ $doc->original_name }}</p>
                                            </div>
                                        </div>
                                        <a href="{{ Storage::url($doc->file_path) }}" target="_blank"
                                            class="shrink-0 size-8 flex items-center justify-center rounded-lg hover:bg-primary/10 text-primary transition-colors">
                                            <span class="material-symbols-outlined text-lg">visibility</span>
                                        </a>
                                    </div>
                                @empty
                                    <div
                                        class="col-span-2 py-8 text-center bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-dashed border-gray-200 dark:border-gray-700">
                                        <span class="material-symbols-outlined text-4xl text-gray-300 mb-2">cloud_off</span>
                                        <p class="text-sm text-[#616f89]">Belum ada dokumen yang diunggah</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar Content (1/3) -->
                    <div class="space-y-6">
                        <!-- Registration Timeline -->
                        <div
                            class="bg-white dark:bg-[#1a2130] rounded-xl shadow-sm border border-[#dbdfe6] dark:border-[#2a303c] p-6">
                            <div class="flex items-center gap-2 mb-6">
                                <span class="material-symbols-outlined text-primary">timeline</span>
                                <h3 class="text-lg font-bold">Riwayat Pendaftaran</h3>
                            </div>
                            <div class="relative flex flex-col gap-6 ml-3 border-l-2 border-primary/20 pl-6 pb-2">
                                <!-- Step 1 -->
                                <div class="relative">
                                    <span
                                        class="absolute -left-[33px] top-0 size-4 bg-primary rounded-full border-4 border-white dark:border-[#1a2130]"></span>
                                    <p class="text-xs font-bold text-primary mb-1">
                                        {{ $pendaftar->created_at ? $pendaftar->created_at->format('d M Y') : '12 Juli 2023' }}
                                    </p>
                                    <p class="text-sm font-bold leading-tight">Formulir Terkirim</p>
                                    <p class="text-xs text-[#616f89] dark:text-gray-400">Calon maba melengkapi biodata
                                    </p>
                                </div>
                                <!-- Step 2 -->
                                <div class="relative">
                                    <span
                                        class="absolute -left-[33px] top-0 size-4 bg-primary rounded-full border-4 border-white dark:border-[#1a2130]"></span>
                                    <p class="text-xs font-bold text-primary mb-1">13 Juli 2023</p>
                                    <p class="text-sm font-bold leading-tight">Pembayaran Terverifikasi</p>
                                    <p class="text-xs text-[#616f89] dark:text-gray-400">ID: TRX-992810</p>
                                </div>
                                <!-- Step 3 -->
                                <div class="relative">
                                    <span
                                        class="absolute -left-[33px] top-0 size-4 bg-primary rounded-full border-4 border-white dark:border-[#1a2130]"></span>
                                    <p class="text-xs font-bold text-primary mb-1">15 Juli 2023</p>
                                    <p class="text-sm font-bold leading-tight">Verifikasi Berkas Admin</p>
                                    <p class="text-xs text-[#616f89] dark:text-gray-400">Berkas dinyatakan lengkap</p>
                                </div>
                                <!-- Active/Next Step -->
                                <div class="relative opacity-50">
                                    <span
                                        class="absolute -left-[33px] top-0 size-4 bg-[#dbdfe6] dark:bg-[#2a303c] rounded-full border-4 border-white dark:border-[#1a2130]"></span>
                                    <p class="text-xs font-bold text-gray-400 mb-1">Sedang Proses</p>
                                    <p class="text-sm font-bold leading-tight">Review Pimpinan</p>
                                    <p class="text-xs text-[#616f89] dark:text-gray-400">Menunggu tanda tangan digital
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Action Card -->
                        <div class="bg-primary/5 dark:bg-primary/10 rounded-xl border border-primary/20 p-6">
                            <h4 class="text-sm font-bold text-primary mb-2">Butuh Ringkasan?</h4>
                            <p class="text-xs text-[#616f89] dark:text-gray-400 mb-4">Unduh ringkasan profil calon
                                mahasiswa untuk keperluan rapat evaluasi.</p>
                            <button
                                class="w-full flex items-center justify-center gap-2 rounded-lg h-10 px-4 bg-white dark:bg-[#1a2130] border border-primary text-primary text-xs font-bold hover:bg-primary hover:text-white transition-all">
                                <span class="material-symbols-outlined text-base">download</span>
                                <span>Download PDF Profil</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer simple -->
        <footer class="border-t border-[#dbdfe6] dark:border-[#2a303c] bg-white dark:bg-background-dark py-6 mt-10">
            <div class="max-w-[1024px] mx-auto px-4 text-center">
                <p class="text-[#616f89] dark:text-gray-500 text-xs">© 2023 Sistem PMB Universitas Nusantara. Akses
                    Pimpinan Terbatas.</p>
            </div>
        </footer>
    </div>
</body>

</html>