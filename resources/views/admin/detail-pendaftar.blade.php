<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Detail Calon Mahasiswa (Admin)</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
    <style>
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #94a3b8;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark font-display text-[#111318] dark:text-white antialiased flex flex-col min-h-screen">
    <header
        class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#e5e7eb] dark:border-b-[#2d3748] px-6 py-3 bg-white dark:bg-[#1a202c]">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 text-[#111318] dark:text-white hover:opacity-80 transition-opacity">
                <div class="size-10 flex items-center justify-center">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo"
                        class="w-full h-full object-contain rounded-full">
                </div>
                <h2
                    class="text-[#111318] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] hidden sm:block">
                    Bina Adinata</h2>
            </a>
            <label class="hidden md:flex flex-col min-w-40 !h-10 max-w-64 ml-8">
                <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                    <div
                        class="text-[#616f89] flex border-none bg-[#f0f2f4] dark:bg-[#2d3748] items-center justify-center pl-4 rounded-l-lg border-r-0">
                        <span class="material-symbols-outlined text-[20px]">search</span>
                    </div>
                    <input
                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111318] dark:text-white focus:outline-0 focus:ring-0 border-none bg-[#f0f2f4] dark:bg-[#2d3748] focus:border-none h-full placeholder:text-[#616f89] px-4 rounded-l-none border-l-0 pl-2 text-sm font-normal leading-normal"
                        placeholder="Cari pendaftar..." value="" />
                </div>
            </label>
        </div>
        <div class="flex flex-1 justify-end gap-4 items-center">
            <!-- Removed notification and profile icons as requested -->
        </div>
    </header>
    <main class="flex-1 w-full max-w-[1280px] mx-auto p-4 md:p-6 lg:p-8">
        <div class="breadcrumbs flex flex-wrap items-center gap-2 mb-6 text-sm">
            <a class="text-[#616f89] hover:text-primary transition-colors font-medium"
                href="{{ route('admin.dashboard') }}">Dashboard</a>
            <span class="material-symbols-outlined text-[#616f89] text-[16px]">chevron_right</span>
            <a class="text-[#616f89] hover:text-primary transition-colors font-medium"
                href="{{ route('admin.data_calon_mahasiswa') }}">Pendaftar</a>
            <span class="material-symbols-outlined text-[#616f89] text-[16px]">chevron_right</span>
            <span class="text-[#111318] dark:text-white font-medium">Detail Pendaftar</span>
        </div>
        <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-8">
            <div class="flex min-w-72 flex-col gap-1">
                <h1
                    class="text-[#111318] dark:text-white tracking-tight text-[28px] md:text-[32px] font-bold leading-tight">
                    Detail Calon Mahasiswa</h1>
                <p class="text-[#616f89] text-sm md:text-base font-normal">Kelola data lengkap dan status pendaftaran.
                </p>
            </div>
            <div class="flex gap-3">
                <button onclick="window.print()"
                    class="flex h-10 cursor-pointer items-center justify-center gap-2 rounded-lg bg-white dark:bg-[#1a202c] border border-[#e5e7eb] dark:border-[#2d3748] px-4 text-[#111318] dark:text-white text-sm font-medium hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors shadow-sm print:hidden">
                    <span class="material-symbols-outlined text-[20px]">print</span>
                    <span class="hidden sm:inline">Cetak / PDF</span>
                </button>
                <style>
                    @media print {
                        @page { 
                            margin: 1cm; 
                            size: auto; 
                        }
                        
                        body { 
                            -webkit-print-color-adjust: exact !important; 
                            print-color-adjust: exact !important; 
                            background-color: white !important;
                        }
                        
                        /* Hide Navs, Controls, AND TITLE to fix "Page 1 Blank" issue */
                        header, 
                        .breadcrumbs, 
                        .print\:hidden, 
                        button, 
                        .sticky, 
                        .border-b.w-full.overflow-x-auto, 
                        a[href*="admin"],
                        /* This hides the "Detail Calon Mahasiswa" title block */
                        .flex.flex-col.md\:flex-row.md\:items-start.justify-between.gap-4.mb-8
                        { 
                            display: none !important; 
                        }

                        /* Reset Layout */
                        main { 
                            padding: 0 !important; 
                            margin: 0 !important; 
                            max-width: 100% !important; 
                            width: 100% !important; 
                        }

                        /* Stack Content */
                        .lg\:grid-cols-12 {
                            display: flex !important;
                            flex-direction: column;
                            gap: 2rem !important;
                        }
                        
                        .lg\:col-span-4, .lg\:col-span-8 {
                            width: 100% !important;
                        }

                        /* UI Preservation */
                        .bg-white, .dark\:bg-\[\#1a202c\] {
                            border: 1px solid #e5e7eb !important;
                            box-shadow: none !important;
                            border-radius: 0.75rem !important;
                        }

                        /* No Spacer, just clean breaks */
                        section, .rounded-xl { 
                            break-inside: avoid; 
                            page-break-inside: avoid;
                            margin-bottom: 1.5rem !important;
                        }

                        /* Fix Profile Header */
                        .h-24.w-full.bg-gradient-to-r {
                            print-color-adjust: exact !important; 
                        }
                        
                        a { text-decoration: none !important; color: inherit !important; }
                    }
                </style>
                <button
                    class="flex h-10 cursor-pointer items-center justify-center gap-2 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-900/30 px-4 text-red-600 dark:text-red-400 text-sm font-medium hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">delete</span>
                    <span class="hidden sm:inline">Hapus Data</span>
                </button>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
            <div class="lg:col-span-4 xl:col-span-3 flex flex-col gap-6 lg:sticky lg:top-24">
                <div
                    class="bg-white dark:bg-[#1a202c] rounded-xl shadow-sm border border-[#e5e7eb] dark:border-[#2d3748] overflow-hidden">
                    <div class="h-24 w-full bg-gradient-to-r from-blue-500 to-indigo-600 relative"
                        data-alt="Blue abstract gradient background for profile header"></div>
                    <div class="px-6 pb-6 relative">
                        <div
                            class="size-24 rounded-xl border-4 border-white dark:border-[#1a202c] bg-white absolute -top-12 left-6 overflow-hidden shadow-md z-10">
                            @php
                                $pasFoto = $dokumen->where('jenis_dokumen', 'foto')->first();
                                $fotoUrl = $pasFoto ? Storage::url($pasFoto->file_path) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuBu-v__D-RqgPLTfCy7zxE4s4VkBJyrcFM_qrPl93MnfwMdjOLxyDZppUeRwzmM-Nm1FFjYLYN0VqHSFkoY1Vh6cipO1Zh_4rQdA3Yfj7F8FkgItmzATzRGu0rkLXcFemvPRDAKEfY47AbBPaw7tKCuh4hfBJN79joFkUrEopqnzGe6nRsjxV45XqqzoklnfFMi13TbAr8nVbPYKEij4jFhH5FnS8mF3rjFRzc0rMXqeBHTmCrblSSRHW5JOQJEuKl6zz_k1Fw3MoA';
                            @endphp
                            <div class="w-full h-full bg-cover bg-center"
                                data-alt="Portrait of student {{ $pendaftar->nama_lengkap }}"
                                style='background-image: url("{{ $fotoUrl }}");'>
                            </div>
                        </div>
                        <div class="mt-4 flex flex-col gap-1 pl-[110px]">
                            <h3 class="text-xl font-bold text-[#111318] dark:text-white leading-tight">
                                {{ $pendaftar->nama_lengkap ?? 'Tanpa Nama' }}</h3>
                            <p class="text-[#616f89] text-xs">ID: <span
                                    class="font-mono text-[#111318] dark:text-white bg-gray-100 dark:bg-gray-700 px-1 rounded">{{ $pendaftar->nomor_pendaftaran ?? '-' }}</span>
                            </p>
                        </div>
                        <div class="mt-8 flex flex-col gap-3">
                            <div class="flex items-center gap-2 text-sm text-[#616f89]">
                                <span class="material-symbols-outlined text-[18px]">school</span>
                                <span>{{ $pendaftar->pilihan_prodi ?? '-' }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-[#616f89]">
                                <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                                <span>Daftar:
                                    {{ $pendaftar->created_at ? $pendaftar->created_at->format('d M Y') : '-' }}</span>
                            </div>
                        </div>
                        <div class="mt-6 pt-6 border-t border-[#f0f2f4] dark:border-[#2d3748]">
                            <p class="text-xs font-semibold text-[#616f89] uppercase tracking-wider mb-3">Status
                                Pendaftaran</p>
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-yellow-100 dark:bg-yellow-900/30 px-3 py-1 text-sm font-medium text-yellow-800 dark:text-yellow-300">
                                <span class="size-2 rounded-full bg-yellow-500 animate-pulse"></span>
                                {{ ucfirst($pendaftar->status) }}
                            </span>

                            <!-- Payment Status Added Back -->
                            <p class="text-xs font-semibold text-[#616f89] uppercase tracking-wider mb-3 mt-4">Status
                                Pembayaran</p>
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full {{ $pendaftar->status_pembayaran == 'lunas' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' }} px-3 py-1 text-sm font-medium">
                                <span
                                    class="material-symbols-outlined text-[14px]">{{ $pendaftar->status_pembayaran == 'lunas' ? 'paid' : 'money_off' }}</span>
                                {{ $pendaftar->status_pembayaran == 'lunas' ? 'Lunas' : 'Belum Bayar' }}
                            </span>
                        </div>
                        <div class="mt-6 flex flex-col gap-3">
                            <form action="{{ route('admin.pendaftar.update_status', $pendaftar->id) }}" method="POST" class="w-full">
                                @csrf
                                <input type="hidden" name="status" value="Diterima">
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menerima pendaftaran ini?')" class="w-full flex items-center justify-center gap-2 rounded-lg bg-primary hover:bg-blue-700 text-white py-2.5 text-sm font-medium transition-colors shadow-sm shadow-blue-200 dark:shadow-none">
                                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                    Terima Pendaftaran
                                </button>
                            </form>
                            
                            <form action="{{ route('admin.pendaftar.update_status', $pendaftar->id) }}" method="POST" class="w-full">
                                @csrf
                                <input type="hidden" name="status" value="Revisi">
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin meminta revisi?')" class="w-full flex items-center justify-center gap-2 rounded-lg bg-white dark:bg-[#2d3748] border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-[#111318] dark:text-white py-2.5 text-sm font-medium transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">edit_note</span>
                                    Minta Revisi
                                </button>
                            </form>

                            <form action="{{ route('admin.pendaftar.update_status', $pendaftar->id) }}" method="POST" class="w-full">
                                @csrf
                                <input type="hidden" name="status" value="Ditolak">
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menolak pendaftaran ini?')" class="w-full flex items-center justify-center gap-2 rounded-lg bg-white dark:bg-[#2d3748] border border-gray-200 dark:border-gray-600 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 hover:border-red-200 dark:hover:border-red-900 text-[#616f89] py-2.5 text-sm font-medium transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">cancel</span>
                                    Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-[#1a202c] rounded-xl shadow-sm border border-[#e5e7eb] dark:border-[#2d3748] p-5">
                    <h4 class="font-bold text-[#111318] dark:text-white mb-4 text-sm uppercase tracking-wider">Kontak
                        Cepat</h4>
                    <div class="flex flex-col gap-4">
                        <a class="flex items-center gap-3 group" href="mailto:{{ $pendaftar->email }}">
                            <div
                                class="size-9 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-blue-600 dark:text-blue-400 group-hover:bg-blue-100 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">mail</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-[#616f89]">Email</span>
                                <span
                                    class="text-sm font-medium text-[#111318] dark:text-white group-hover:text-primary transition-colors">{{ $pendaftar->email }}</span>
                            </div>
                        </a>
                        <a class="flex items-center gap-3 group" href="https://wa.me/{{ $pendaftar->no_hp }}">
                            <div
                                class="size-9 rounded-full bg-green-50 dark:bg-green-900/20 flex items-center justify-center text-green-600 dark:text-green-400 group-hover:bg-green-100 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">call</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-[#616f89]">WhatsApp</span>
                                <span
                                    class="text-sm font-medium text-[#111318] dark:text-white group-hover:text-green-600 transition-colors">{{ $pendaftar->no_hp }}</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-8 xl:col-span-9 space-y-6">
                <div class="border-b border-[#e5e7eb] dark:border-[#2d3748] w-full overflow-x-auto">
                    <div class="flex gap-6 min-w-max">
                        <button
                            class="relative pb-3 px-1 text-primary font-semibold text-sm border-b-2 border-primary transition-colors">
                            Biodata &amp; Profil
                        </button>
                        <button
                            class="relative pb-3 px-1 text-[#616f89] hover:text-[#111318] dark:hover:text-white font-medium text-sm border-b-2 border-transparent hover:border-gray-300 transition-colors">
                            Dokumen ({{ count($dokumen ?? []) }})
                        </button>
                        <button
                            class="relative pb-3 px-1 text-[#616f89] hover:text-[#111318] dark:hover:text-white font-medium text-sm border-b-2 border-transparent hover:border-gray-300 transition-colors">
                            Riwayat &amp; Log
                        </button>
                    </div>
                </div>
                <!-- Informasi Pribadi -->
                <section
                    class="bg-white dark:bg-[#1a202c] rounded-xl shadow-sm border border-[#e5e7eb] dark:border-[#2d3748] p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-[#111318] dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">person</span>
                            Informasi Pribadi
                        </h3>
                        <div class="flex items-center gap-3">
                            <button class="text-sm text-primary font-medium hover:underline">Edit Data</button>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-6 gap-x-8">
                        <div>
                            <p class="text-xs text-[#616f89] mb-1">Nama Lengkap</p>
                            <p class="text-sm font-medium text-[#111318] dark:text-white">
                                {{ $pendaftar->nama_lengkap ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#616f89] mb-1">NIK (Nomor Induk Kependudukan)</p>
                            <p class="text-sm font-medium text-[#111318] dark:text-white font-mono">
                                {{ $pendaftar->nik ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#616f89] mb-1">Jenis Kelamin</p>
                            <p class="text-sm font-medium text-[#111318] dark:text-white">
                                {{ $pendaftar->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#616f89] mb-1">Tempat, Tanggal Lahir</p>
                            <p class="text-sm font-medium text-[#111318] dark:text-white">
                                {{ $pendaftar->tempat_lahir ?? '-' }}, {{ $pendaftar->tanggal_lahir ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#616f89] mb-1">Agama</p>
                            <p class="text-sm font-medium text-[#111318] dark:text-white">{{ $pendaftar->agama ?? '-' }}
                            </p>
                        </div>
                        <div class="md:col-span-2 lg:col-span-3">
                            <p class="text-xs text-[#616f89] mb-1">Alamat Lengkap</p>
                            <p class="text-sm font-medium text-[#111318] dark:text-white leading-relaxed">
                                {{ $pendaftar->alamat_lengkap }}, {{ $pendaftar->kelurahan }},
                                {{ $pendaftar->kecamatan }}, {{ $pendaftar->kabupaten }}, {{ $pendaftar->provinsi }}
                            </p>
                        </div>
                        @if ($pendaftar->univ_asal)
                            <div class="md:col-span-2 lg:col-span-3">
                                <p class="text-xs text-[#616f89] mb-1 font-bold">Data Mahasiswa Pindahan</p>
                                <p class="text-sm font-medium text-[#111318] dark:text-white">Asal Kampus:
                                    {{ $pendaftar->univ_asal }} ({{ $pendaftar->prodi_asal }})</p>
                            </div>
                        @endif
                    </div>
                    <div class="my-6 border-t border-[#f0f2f4] dark:border-[#2d3748]"></div>
                    <h3 class="text-lg font-bold text-[#111318] dark:text-white flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined text-primary">school</span>
                        Data Sekolah Asal
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-6 gap-x-8">
                        <div>
                            <p class="text-xs text-[#616f89] mb-1">Nama Sekolah</p>
                            <p class="text-sm font-medium text-[#111318] dark:text-white">
                                {{ $pendaftar->nama_sekolah ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#616f89] mb-1">Jurusan</p>
                            <p class="text-sm font-medium text-[#111318] dark:text-white">
                                {{ $pendaftar->jurusan_sekolah ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#616f89] mb-1">Tahun Lulus</p>
                            <p class="text-sm font-medium text-[#111318] dark:text-white">
                                {{ $pendaftar->tahun_lulus ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#616f89] mb-1">NISN</p>
                            <p class="text-sm font-medium text-[#111318] dark:text-white font-mono">
                                {{ $pendaftar->nisn ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#616f89] mb-1">Nilai Rata-rata Rapor</p>
                            <div class="flex items-center gap-2">
                                <span
                                    class="text-sm font-bold text-[#111318] dark:text-white bg-green-50 dark:bg-green-900/20 text-green-700 px-2 py-0.5 rounded">{{ $pendaftar->nilai_rata_rata ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="md:col-span-2 lg:col-span-3">
                            <p class="text-xs text-[#616f89] mb-1">Alamat Sekolah</p>
                            <p class="text-sm font-medium text-[#111318] dark:text-white">
                                {{ $pendaftar->alamat_sekolah ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="my-6 border-t border-[#f0f2f4] dark:border-[#2d3748]"></div>
                    <h3 class="text-lg font-bold text-[#111318] dark:text-white flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined text-primary">family_restroom</span>
                        Data Orang Tua
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-6 gap-x-8">
                        <div>
                            <p class="text-xs text-[#616f89] mb-1">Nama Ayah</p>
                            <p class="text-sm font-medium text-[#111318] dark:text-white">
                                {{ $pendaftar->nama_ayah ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#616f89] mb-1">Pekerjaan Ayah</p>
                            <p class="text-sm font-medium text-[#111318] dark:text-white">
                                {{ $pendaftar->pekerjaan_ayah ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#616f89] mb-1">Penghasilan Orang Tua</p>
                            <p class="text-sm font-medium text-[#111318] dark:text-white">
                                {{ $pendaftar->penghasilan_orang_tua ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#616f89] mb-1">Nama Ibu</p>
                            <p class="text-sm font-medium text-[#111318] dark:text-white">
                                {{ $pendaftar->nama_ibu ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#616f89] mb-1">Pekerjaan Ibu</p>
                            <p class="text-sm font-medium text-[#111318] dark:text-white">
                                {{ $pendaftar->pekerjaan_ibu ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-[#616f89] mb-1">No. Telp Orang Tua</p>
                            <p class="text-sm font-medium text-[#111318] dark:text-white font-mono">
                                {{ $pendaftar->hp_ayah ?? $pendaftar->hp_ibu ?? '-' }}</p>
                        </div>
                    </div>
                </section>
                <!-- Dokumen -->
                <section
                    class="bg-white dark:bg-[#1a202c] rounded-xl shadow-sm border border-[#e5e7eb] dark:border-[#2d3748] p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-[#111318] dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">folder_open</span>
                            Dokumen Persyaratan
                        </h3>
                        <span
                            class="text-xs font-medium bg-gray-100 dark:bg-gray-700 text-[#616f89] dark:text-gray-300 px-2 py-1 rounded">{{ count($dokumen ?? []) }}
                            Dokumen</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse($dokumen as $doc)
                            <div
                                class="group flex items-start gap-4 p-4 rounded-lg border border-[#e5e7eb] dark:border-[#2d3748] hover:border-primary/50 transition-colors bg-white dark:bg-[#202837]">
                                <div
                                    class="size-12 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-blue-500 text-2xl">description</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-start mb-1">
                                        <p
                                            class="text-sm font-semibold text-[#111318] dark:text-white truncate pr-2 uppercase">
                                            {{ str_replace('_', ' ', $doc->jenis_dokumen) }}</p>
                                        <span class="material-symbols-outlined text-green-500 text-[18px]"
                                            title="Sudah Diverifikasi">check_circle</span>
                                    </div>
                                    <p class="text-xs text-[#616f89] mb-3">{{ $doc->original_name }}</p>
                                    <div class="flex gap-2">
                                        <a href="{{ Storage::url($doc->file_path) }}" target="_blank"
                                            class="text-xs font-medium text-primary bg-primary/10 hover:bg-primary/20 px-3 py-1.5 rounded transition-colors">Lihat</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 text-center text-gray-500">Belum ada dokumen yang diunggah.</div>
                        @endforelse
                    </div>
                </section>
                <!-- Riwayat (Static for now as requested by UI) -->
                <section
                    class="bg-white dark:bg-[#1a202c] rounded-xl shadow-sm border border-[#e5e7eb] dark:border-[#2d3748] p-6">
                    <h3 class="text-lg font-bold text-[#111318] dark:text-white flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined text-primary">history</span>
                        Riwayat Pendaftaran
                    </h3>
                    <div class="relative space-y-0 ml-1.5">
                        @php
                            $latestUpload = $dokumen->sortByDesc('created_at')->first();
                            $verifiedDocs = $dokumen->whereIn('status', ['valid', 'invalid', 'Terverifikasi', 'Revisi'])->count();
                            $latestVerification = $dokumen->whereIn('status', ['valid', 'invalid', 'Terverifikasi', 'Revisi'])->sortByDesc('updated_at')->first();
                        @endphp

                        @if($latestUpload)
                        <div class="relative pl-8 pb-8">
                            <div class="absolute left-[7px] top-[20px] bottom-0 w-[2px] bg-[#e5e7eb] dark:bg-[#2d3748]"></div>
                            <div class="absolute left-0 top-[6px] size-4 bg-gray-200 dark:bg-gray-600 rounded-full border-2 border-white dark:border-[#1a202c] z-10"></div>
                            <div class="flex flex-col gap-1">
                                <span class="text-xs text-[#616f89]">{{ $latestUpload->created_at->format('d M Y, H:i') }} WIB</span>
                                <p class="text-sm font-medium text-[#111318] dark:text-white">Dokumen <span class="font-bold">Persyaratan</span> diunggah oleh peserta.</p>
                            </div>
                        </div>
                        @endif

                        @if($verifiedDocs > 0 && $latestVerification)
                        <div class="relative pl-8 pb-8">
                            <div class="absolute left-[7px] top-0 bottom-0 w-[2px] bg-[#e5e7eb] dark:bg-[#2d3748]"></div>
                            <div class="absolute left-0 top-[6px] size-4 bg-primary rounded-full border-2 border-white dark:border-[#1a202c] z-10"></div>
                            <div class="flex flex-col gap-1">
                                <span class="text-xs text-[#616f89]">{{ $latestVerification->updated_at->format('d M Y, H:i') }} WIB</span>
                                <p class="text-sm font-medium text-[#111318] dark:text-white"><span class="font-bold">Admin</span> memverifikasi {{ $verifiedDocs }} dokumen.</p>
                                @if(isset($latestVerification->catatan) && $latestVerification->catatan)
                                <div class="mt-1 p-2 bg-[#f6f6f8] dark:bg-[#2d3748] rounded text-xs text-[#616f89] italic">
                                    "{{ $latestVerification->catatan }}"
                                </div>
                                @endif
                            </div>
                        </div>
                        @else
                        <div class="relative pl-8 pb-8">
                            <div class="absolute left-[7px] top-0 bottom-0 w-[2px] bg-[#e5e7eb] dark:bg-[#2d3748]"></div>
                            <div class="absolute left-0 top-[6px] size-4 bg-gray-200 dark:bg-gray-600 rounded-full border-2 border-white dark:border-[#1a202c] z-10"></div>
                            <div class="flex flex-col gap-1">
                                <span class="text-xs text-[#616f89]">Menunggu Verifikasi</span>
                                <p class="text-sm font-medium text-[#616f89] dark:text-gray-400">Belum ada dokumen yang diverifikasi oleh Admin.</p>
                            </div>
                        </div>
                        @endif

                        <div class="relative pl-8">
                            <div class="absolute left-0 top-[6px] size-4 bg-green-500 rounded-full border-2 border-white dark:border-[#1a202c] z-10"></div>
                            <div class="flex flex-col gap-1">
                                <span class="text-xs text-[#616f89]">{{ $pendaftar->created_at ? $pendaftar->created_at->format('d M Y, H:i') : '-' }} WIB</span>
                                <p class="text-sm font-medium text-[#111318] dark:text-white">Pendaftaran Baru Diterima</p>
                                <p class="text-xs text-[#616f89]">Peserta menyelesaikan formulir pendaftaran tahap 1.</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

</body>

</html>