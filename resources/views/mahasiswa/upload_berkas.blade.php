<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Halaman Unggah Dokumen - Sistem Pendaftaran</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@100..900&amp;display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
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
                        "display": ["Lexend", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"],
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
</head>

<body
    class="bg-background-light dark:bg-background-dark font-display text-[#111318] dark:text-white transition-colors duration-200"
    x-data="{ isLoading: false }">
    <div class="relative flex min-h-screen flex-col overflow-x-hidden">
        <header
            class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-[#dbdfe6] dark:border-[#2a3441] bg-white dark:bg-[#1a202c] px-4 md:px-10 py-3">
            <div class="flex items-center gap-4 text-[#111318] dark:text-white">
                <div class="size-10 flex items-center justify-center">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo"
                        class="w-full h-full object-contain rounded-full">
                </div>
                <h2 class="text-[#111318] dark:text-white text-xl font-bold leading-tight tracking-[-0.015em]">
                    Bina Adinata
                </h2>
            </div>
            <div class="hidden md:flex items-center gap-6">
                <nav class="flex items-center gap-4">
                    <a class="text-[#111318] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors px-4 py-2"
                        href="{{ url('/') }}" onclick="confirmExit(event)">Beranda</a>
                    <a class="text-[#111318] dark:text-gray-200 text-sm font-medium leading-normal hover:text-primary transition-colors px-4 py-2"
                        href="{{ route('mahasiswa.dashboard') }}" onclick="confirmExit(event)">Dashboard</a>
                </nav>
                <div class="flex items-center gap-4">
                    <div class="text-right hidden lg:block">
                        <p class="text-sm font-bold text-[#111318] dark:text-white">
                            {{ $pendaftar->nama_lengkap ?? 'Calon Mahasiswa' }}
                        </p>
                        <p class="text-xs text-[#616f89] dark:text-gray-400">Calon Mahasiswa</p>
                    </div>
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 ring-2 ring-primary/20"
                        style='background-image: url("https://ui-avatars.com/api/?name={{ urlencode(optional($pendaftar)->nama_lengkap ?? 'User') }}&background=135bec&color=fff");'>
                    </div>
                </div>
            </div>
            <button class="md:hidden flex text-[#111318] dark:text-white p-2" onclick="toggleMobileMenu()">
                <span class="material-symbols-outlined" id="mobile-menu-icon">menu</span>
            </button>
        </header>

        <!-- Mobile Menu -->
        <div id="mobile-menu"
            class="hidden md:hidden bg-white dark:bg-[#1a202c] border-b border-[#dbdfe6] dark:border-[#2a3441] px-6 py-4 shadow-lg animate-in slide-in-from-top duration-300">
            <nav class="flex flex-col gap-4">
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#111318] dark:text-gray-200 font-bold text-sm"
                    href="{{ url('/') }}" onclick="confirmExit(event)">
                    <span class="material-symbols-outlined">home</span>
                    Beranda
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#111318] dark:text-gray-200 font-bold text-sm"
                    href="{{ route('mahasiswa.dashboard') }}" onclick="confirmExit(event)">
                    <span class="material-symbols-outlined">dashboard</span>
                    Dashboard
                </a>
            </nav>
        </div>

        <main class="flex-1 w-full max-w-[1200px] mx-auto px-4 md:px-10 py-8 pb-40 md:pb-20">
            <div class="mb-10 max-w-[800px] mx-auto">
                <div class="flex flex-col gap-3">
                    <div class="flex gap-6 justify-between items-end">
                        <p class="text-[#111318] dark:text-white text-base font-bold leading-normal">Langkah 3 dari 4
                        </p>
                        <span class="text-sm font-medium text-primary">75% Selesai</span>
                    </div>
                    <div class="rounded-full bg-[#dbdfe6] dark:bg-[#2a3441] h-3 w-full overflow-hidden">
                        <div class="h-full rounded-full bg-primary transition-all duration-500 ease-out"
                            style="width: 75%;"></div>
                    </div>
                    <p class="text-[#616f89] dark:text-gray-400 text-sm font-normal leading-normal">Kelengkapan Dokumen
                    </p>
                </div>
            </div>
            <div class="mb-8 text-center max-w-[700px] mx-auto">
                <h1
                    class="text-[#111318] dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em] mb-3">
                    Unggah Berkas Persyaratan</h1>
                <p class="text-[#616f89] dark:text-gray-300 text-base md:text-lg font-normal leading-normal">Silakan
                    unggah dokumen wajib di bawah ini untuk memverifikasi pendaftaran Anda.</p>
            </div>

            <form action="{{ route('mahasiswa.upload.store') }}" method="POST" enctype="multipart/form-data"
                id="uploadForm" @submit="isLoading = true">
                @csrf

                @if ($errors->any())
                    <div
                        class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl flex items-start gap-3">
                        <span class="material-symbols-outlined text-red-600 dark:text-red-400 mt-0.5">error</span>
                        <div>
                            <p class="text-red-800 dark:text-red-200 font-bold text-sm">Gagal Mengunggah Berkas</p>
                            <ul class="list-disc list-inside text-red-600 dark:text-red-300 text-sm mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div
                    class="mb-8 p-4 bg-primary/10 border border-primary/20 rounded-xl flex items-start gap-3 max-w-[960px] mx-auto">
                    <span class="material-symbols-outlined text-primary mt-0.5">info</span>
                    <div>
                        <p class="text-[#111318] dark:text-white font-bold text-sm">Ketentuan Umum</p>
                        <p class="text-[#616f89] dark:text-gray-300 text-sm">Gunakan pemindaian (scan) asli, bukan
                            fotokopi. Pastikan semua teks terbaca jelas dan tidak terpotong.</p>
                    </div>
                </div>

                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 max-w-[1200px] mx-auto mb-16">
                    @php
                        $uploadItems = [
                            ['id' => 'ktp', 'title' => '1. Kartu Identitas (KTP)', 'icon' => 'badge', 'max' => '2MB', 'ext' => 'PDF/JPG'],
                            ['id' => 'ktp_ortu', 'title' => '2. KTP Orang Tua/Wali', 'icon' => 'family_restroom', 'max' => '2MB', 'ext' => 'PDF/JPG'],
                            ['id' => 'akte', 'title' => '3. Akte Kelahiran', 'icon' => 'child_care', 'max' => '3MB', 'ext' => 'PDF/JPG'],
                            ['id' => 'ijazah', 'title' => '4. Ijazah/SKL', 'icon' => 'history_edu', 'max' => '5MB', 'ext' => 'PDF/JPG'],
                            ['id' => 'kk', 'title' => '5. Kartu Keluarga', 'icon' => 'groups', 'max' => '3MB', 'ext' => 'PDF/JPG'],
                            ['id' => 'foto', 'title' => '6. Pass Foto', 'icon' => 'account_box', 'max' => '2MB', 'ext' => 'JPG/PNG'],
                            ['id' => 'transkrip', 'title' => '7. Transkrip Nilai', 'icon' => 'description', 'max' => '5MB', 'ext' => 'PDF/JPG'],
                            ['id' => 'bukti_pembayaran', 'title' => '8. Bukti Pembayaran', 'icon' => 'payments', 'max' => '2MB', 'ext' => 'JPG/PDF/PNG'],
                            ['id' => 'kip', 'title' => '9. Kartu Indonesia Pintar', 'icon' => 'card_membership', 'max' => '2MB', 'ext' => 'PDF/JPG', 'optional' => true],
                        ];
                    @endphp

                    @foreach ($uploadItems as $item)
                        @php $hasDoc = isset($dokumen[$item['id']]); @endphp
                        <div
                            class="flex flex-col rounded-xl bg-white dark:bg-[#1a202c] shadow-sm border border-[#dbdfe6] dark:border-[#2a3441] overflow-hidden group hover:border-primary/50 transition-colors">
                            <div
                                class="p-3 border-b border-[#f0f2f4] dark:border-[#2a3441] flex items-center justify-between bg-gray-50 dark:bg-[#202836]">
                                <h3 class="font-bold text-[#111318] dark:text-white text-xs truncate mr-2">
                                    {{ $item['title'] }}@if(isset($item['optional']) && $item['optional']) <span
                                        class="text-[10px] bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 px-1 py-0.5 rounded ml-1 font-medium">Opsional</span>
                                    @endif
                                </h3>
                                <span class="material-symbols-outlined text-primary text-lg">{{ $item['icon'] }}</span>
                            </div>
                            <div class="p-4 flex flex-col items-center justify-center border-2 border-dashed {{ $hasDoc ? 'border-green-500 bg-green-50 dark:bg-green-900/10' : 'border-[#dbdfe6] dark:border-[#2a3441] bg-background-light/50 dark:bg-background-dark/30' }} m-3 rounded-lg group-hover:bg-primary/5 transition-colors cursor-pointer"
                                onclick="document.getElementById('file-{{ $item['id'] }}').click()">
                                <span
                                    class="material-symbols-outlined text-2xl {{ $hasDoc ? 'text-green-500' : 'text-[#9ca3af]' }} mb-1">{{ $hasDoc ? 'check_circle' : 'cloud_upload' }}</span>
                                <div class="text-center mb-3 h-8 flex flex-col justify-center">
                                    <p class="text-[11px] font-medium text-[#111318] dark:text-gray-200 line-clamp-2"
                                        id="text-{{ $item['id'] }}">
                                        {{ $hasDoc ? $dokumen[$item['id']]->original_name : 'Klik/Tarik file' }}
                                    </p>
                                    <p
                                        class="text-[9px] {{ $hasDoc ? 'text-green-600 dark:text-green-400 font-bold' : 'text-[#616f89] dark:text-gray-400' }} mt-0.5">
                                        {{ $hasDoc ? 'Tersimpan (Klik ubah)' : $item['ext'] . ', Maks: ' . $item['max'] }}
                                    </p>
                                </div>
                                <button type="button"
                                    class="flex items-center justify-center rounded-md h-7 px-3 bg-white dark:bg-[#2a3441] border border-[#dbdfe6] dark:border-[#4a5568] text-[#111318] dark:text-white text-[10px] font-bold shadow-sm hover:bg-gray-50 dark:hover:bg-[#323c4e] transition-colors w-full">Pilih
                                    Berkas</button>
                                <input type="file" name="{{ $item['id'] }}" id="file-{{ $item['id'] }}" class="hidden"
                                    accept=".pdf,.jpg,.jpeg,.png,.webp"
                                    onchange="updateFileName('{{ $item['id'] }}', this)">
                            </div>
                        </div>
                    @endforeach
                </div>

                <div
                    class="fixed bottom-0 left-0 right-0 bg-white dark:bg-[#1a202c] border-t border-[#dbdfe6] dark:border-[#2a3441] p-4 shadow-lg md:relative md:bg-transparent md:border-t-0 md:shadow-none md:p-0">
                    <div class="max-w-[1100px] mx-auto flex items-center justify-between gap-4">
                        <a href="{{ route('mahasiswa.pendaftaran') }}"
                            class="flex min-w-[120px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-white dark:bg-[#2a3441] border border-[#dbdfe6] dark:border-[#4a5568] text-[#111318] dark:text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-gray-50 dark:hover:bg-[#323c4e] transition-colors">
                            <span class="material-symbols-outlined mr-2 text-sm">arrow_back</span>
                            <span class="truncate">Kembali</span>
                        </a>
                        <div class="flex gap-3">
                            <button type="button" onclick="confirmExit(event)"
                                class="hidden sm:flex min-w-[140px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 text-[#616f89] dark:text-gray-400 font-medium hover:text-[#111318] dark:hover:text-white transition-colors">
                                <span class="material-symbols-outlined mr-2 text-[20px]">save</span>
                                <span class="truncate">Simpan Draf</span>
                            </button>
                            <button type="submit" :disabled="isLoading"
                                class="flex min-w-[140px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-blue-700 shadow-md transition-colors shadow-primary/30 disabled:opacity-70 disabled:cursor-not-allowed disabled:transform-none">
                                <span x-show="!isLoading" class="flex items-center">
                                    <span class="truncate">Selesai</span>
                                    <span class="material-symbols-outlined ml-2 text-sm">check_circle</span>
                                </span>
                                <span x-show="isLoading" class="flex items-center gap-2" style="display: none;">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    Memproses...
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>

    <!-- Modal Exit Confirmation / Notifikasi Simpan -->
    <div id="modal-exit-confirmation"
        class="fixed inset-0 z-[100] hidden items-center justify-center p-4 sm:p-6 animate-in fade-in duration-200">
        <!-- Overlay with Glass Effect -->
        <div class="absolute inset-0 bg-slate-900/30 backdrop-blur-md z-10" onclick="closeExitModal()"></div>

        <div class="relative z-20 w-full max-w-md transform transition-all duration-300 modal-animate">
            <div
                class="bg-white dark:bg-surface-dark rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.15)] overflow-hidden border border-slate-100 dark:border-slate-800">
                <div class="p-10 flex flex-col items-center text-center">
                    <div class="mb-6">
                        <div
                            class="w-16 h-16 bg-blue-50 dark:bg-blue-900/20 rounded-full flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-4xl">pending_actions</span>
                        </div>
                    </div>
                    <div class="space-y-2 mb-8">
                        <h2 class="text-xl font-bold text-slate-800 dark:text-white tracking-tight">
                            Ups! Data Belum Tersimpan
                        </h2>
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed max-w-[280px] mx-auto">
                            Pastikan Anda menyimpan progres pengisian formulir agar data tidak hilang.
                        </p>
                    </div>
                    <div class="flex flex-row items-center justify-center gap-3 w-full">
                        <a href="{{ url('/') }}"
                            class="flex items-center justify-center flex-1 px-5 py-2.5 bg-primary text-white text-sm font-semibold rounded-full hover:bg-blue-900 hover:shadow-lg transition-all active:scale-95">
                            Simpan Draft
                        </a>
                        <button type="button" onclick="closeExitModal()"
                            class="flex-1 px-5 py-2.5 bg-transparent text-slate-500 dark:text-slate-400 text-sm font-semibold rounded-full hover:bg-slate-50 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-700 transition-all active:scale-95">
                            Tetap di Halaman
                        </button>
                    </div>
                </div>
            </div>
            <p class="mt-6 text-center text-slate-400 text-xs font-medium flex items-center justify-center gap-1.5">
                <span class="material-symbols-outlined text-sm">support_agent</span>
                Butuh bantuan? Hubungi IT Support kami
            </p>
        </div>
    </div>

    <script>
        function updateFileName(id, input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const fileName = file.name;
                const fileSize = file.size / 1024; // in KB

                const maxSizes = {
                    'ktp': 2048,
                    'ktp_ortu': 2048,
                    'akte': 3072,
                    'ijazah': 5120,
                    'kk': 3072,
                    'foto': 2048,
                    'transkrip': 5120,
                    'bukti_pembayaran': 2048,
                    'kip': 2048
                };

                const maxSize = maxSizes[id] || 2048; // default 2MB

                if (fileSize > maxSize) {
                    alert('Ukuran file terlalu besar! Maksimal ' + (maxSize / 1024) + 'MB.');
                    input.value = ''; // Reset input
                    document.getElementById('text-' + id).textContent = 'Klik atau tarik file ke sini';
                    return;
                }

                document.getElementById('text-' + id).textContent = fileName;
            }
        }

        document.getElementById('uploadForm').addEventListener('submit', function (e) {
            let totalSize = 0;
            const fileInputs = this.querySelectorAll('input[type="file"]');

            fileInputs.forEach(input => {
                if (input.files && input.files[0]) {
                    totalSize += input.files[0].size;
                }
            });

            // Limit total upload to 30MB (Safety buffer for 40MB server limit)
            const maxTotalSize = 30 * 1024 * 1024;

            if (totalSize > maxTotalSize) {
                e.preventDefault();
                alert('Total ukuran semua file terlalu besar (' + (totalSize / (1024 * 1024)).toFixed(2) + ' MB). \nMohon kurangi ukuran file atau upload secara bertahap.\nMaksimal total upload: 30 MB.');
            }
        });

        function confirmExit(event) {
            event.preventDefault();
            const modal = document.getElementById('modal-exit-confirmation');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeExitModal() {
            const modal = document.getElementById('modal-exit-confirmation');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const icon = document.getElementById('mobile-menu-icon');

            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                icon.textContent = 'close';
            } else {
                menu.classList.add('hidden');
                icon.textContent = 'menu';
            }
        }
    </script>
</body>

</html>