<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Halaman Pendaftaran - Kampus Merdeka</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&amp;family=Noto+Sans:wght@300..900&amp;display=swap"
        rel="stylesheet" />
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
                        "primary": "#2563eb",
                        "primary-dark": "#1d4ed8",
                        "background-light": "#f8fafc",
                        "background-dark": "#0f172a",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1e293b",
                        "border-light": "#e2e8f0",
                        "border-dark": "#334155",
                        "success": "#10b981"
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"],
                    },
                    boxShadow: {
                        'soft': '0 4px 20px -2px rgba(0, 0, 0, 0.05)',
                        'glow': '0 0 15px rgba(37, 99, 235, 0.3)',
                    }
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        @layer base {
            body:has(.modal-toggle:checked) {
                overflow: hidden;
            }
        }
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
        }
        .dark ::-webkit-scrollbar-thumb {
            background-color: #475569;
        }
        /* Animation Keyframes */
        @keyframes modal-pop {
            0% { opacity: 0; transform: scale(0.95) translateY(10px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }
        .modal-animate {
            animation: modal-pop 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        
        /* Custom Radio & Checkbox Styles matches User HTML */
        .custom-radio {
            @apply w-5 h-5 text-primary border-gray-300 focus:ring-primary focus:ring-offset-0;
        }
        .custom-checkbox {
            @apply w-5 h-5 rounded text-primary border-gray-300 focus:ring-primary focus:ring-offset-0;
        }
        .form-select {
            @apply w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-[#1a202c] focus:border-primary focus:ring-primary text-sm h-11 transition-all;
        }
        .btn-disabled {
            @apply bg-gray-200 dark:bg-gray-700 text-gray-400 dark:text-gray-500 cursor-not-allowed shadow-none;
        }
        .btn-active {
            @apply bg-primary hover:bg-blue-700 text-white shadow-md cursor-pointer;
        }
    </style>
</head>

</head>

<body x-data="registrationForm" @input.debounce.300ms="checkCompletion" @change="checkCompletion"
    class="bg-background-light dark:bg-background-dark font-body text-slate-800 dark:text-slate-200 transition-colors duration-200 selection:bg-primary/20 selection:text-primary">
    <div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
        <!-- Header -->
        <div
            class="w-full bg-surface-light/80 dark:bg-surface-dark/80 backdrop-blur-md border-b border-border-light dark:border-border-dark sticky top-0 z-40 transition-all duration-300">
            <div class="flex justify-center px-4 md:px-8 lg:px-12 py-4">
                <div class="flex max-w-7xl flex-1 items-center justify-between">
                    <div class="flex items-center gap-4 text-[#111318] dark:text-white">
                        <div class="size-10 flex items-center justify-center">
                            <img src="{{ asset('images/logo.jpg') }}" alt="Logo"
                                class="w-full h-full object-contain rounded-full">
                        </div>
                        <h2 class="text-[#111318] dark:text-white text-xl font-bold leading-tight tracking-[-0.015em]">
                            Bina Adinata
                        </h2>
                    </div>
                    <div class="flex items-center gap-6 ml-auto">
                        <nav class="flex items-center gap-4">
                            <a class="text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors px-4 py-2"
                                href="{{ url('/') }}" @click="checkUnsaved($event, '{{ url('/') }}')">Beranda</a>
                            <a class="text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors px-4 py-2"
                                href="{{ route('mahasiswa.dashboard') }}"
                                @click="checkUnsaved($event, '{{ route('mahasiswa.dashboard') }}')">Dashboard</a>
                            @auth
                                <form action="{{ route('logout') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-700 font-bold text-sm px-4 py-2 transition-colors">
                                        Keluar
                                    </button>
                                </form>
                            @endauth
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <form id="pendaftaran-form" action="{{ route('mahasiswa.store', [], false) }}" method="POST"
            class="flex flex-col grow" enctype="multipart/form-data" @submit="isLoading = true">
            @csrf
            <input type="hidden" name="action" id="form-action" value="submit">
            <!-- Modal Toggles (using checkbox hack from User HTML) -->
            <input class="peer/modal1 hidden modal-toggle" id="modal-1" type="checkbox" />
            <input class="peer/modal2 hidden modal-toggle" id="modal-2" type="checkbox" />
            <input class="peer/modal3 hidden modal-toggle" id="modal-3" type="checkbox" />
            <input class="peer/modal4 hidden modal-toggle" id="modal-4" type="checkbox" />
            <input class="peer/modal5 hidden modal-toggle" id="modal-5" type="checkbox" />

            <main class="flex flex-col items-center px-4 md:px-8 lg:px-12 py-10 grow">
                <div class="flex flex-col max-w-4xl w-full gap-10">
                    <!-- Validation Errors Alert -->
                    @if ($errors->any())
                        <div class="bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 p-4 rounded shadow-md mb-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <span class="material-symbols-outlined text-red-500">error</span>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                                        Terdapat kesalahan pada isian formulir:
                                    </h3>
                                    <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Title Section -->
                    <div class="flex flex-col gap-6 text-center md:text-left md:flex-row md:items-end justify-between">
                        <div class="flex flex-col gap-3 max-w-2xl">
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 dark:bg-blue-900/30 border border-blue-100 dark:border-blue-800 w-fit">
                                <span class="relative flex h-2 w-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                                </span>
                                <span class="text-xs font-bold uppercase tracking-wide text-primary">Pendaftaran
                                    Aktif</span>
                            </div>
                            <h1
                                class="text-3xl md:text-4xl lg:text-5xl font-display font-black leading-tight text-slate-900 dark:text-white">
                                Formulir Mahasiswa Baru
                            </h1>
                            <p class="text-slate-500 dark:text-slate-400 text-base md:text-lg leading-relaxed">
                                Silakan lengkapi setiap bagian di bawah ini. Pastikan data yang Anda masukkan akurat
                                sesuai dengan dokumen resmi.
                            </p>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div
                        class="relative overflow-hidden flex flex-col sm:flex-row gap-4 bg-white dark:bg-surface-dark border border-blue-100 dark:border-blue-900/50 rounded-2xl p-5 shadow-soft">
                        <div class="absolute top-0 left-0 w-1 h-full bg-primary"></div>
                        <div class="flex items-start gap-4 z-10">
                            <div class="p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-primary shrink-0">
                                <span class="material-symbols-outlined">verified_user</span>
                            </div>
                            <div class="flex flex-col gap-1">
                                <h3 class="font-bold text-slate-900 dark:text-white">Kelengkapan Data</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400">
                                    Ikon centang hijau menandakan bagian tersebut telah lengkap. Anda dapat mengedit
                                    kembali data tersebut sebelum menekan tombol Lanjut.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-4 w-full">
                        <!-- Step 1: Program Studi -->
                        <label
                            class="group bg-white dark:bg-surface-dark rounded-2xl shadow-soft border border-border-light dark:border-border-dark p-5 md:p-6 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all hover:border-primary/30 hover:shadow-md flex items-center justify-between"
                            for="modal-1">
                            <div class="flex items-center gap-4 md:gap-6">
                                <div
                                    class="flex items-center justify-center size-12 rounded-xl bg-blue-50 text-primary dark:bg-blue-900/20 shrink-0 group-hover:scale-110 transition-transform duration-300">
                                    <span class="material-symbols-outlined text-[24px]">school</span>
                                </div>
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-2">
                                        <h2
                                            class="text-lg md:text-xl font-display font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors">
                                            I. Program Studi</h2>
                                        <span x-show="step1Complete"
                                            class="material-symbols-outlined text-success text-xl">check_circle</span>
                                    </div>
                                    <span class="text-sm text-slate-400 dark:text-slate-500 font-normal">Gelombang I -
                                        Sistem Informasi</span>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="flex items-center justify-center size-10 rounded-full border border-slate-200 dark:border-slate-700 text-slate-400 group-hover:border-primary group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                </div>
                            </div>
                        </label>

                        <!-- Step 2: Identitas Diri -->
                        <label
                            class="group bg-white dark:bg-surface-dark rounded-2xl shadow-soft border border-border-light dark:border-border-dark p-5 md:p-6 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all hover:border-primary/30 hover:shadow-md flex items-center justify-between"
                            for="modal-2">
                            <div class="flex items-center gap-4 md:gap-6">
                                <div
                                    class="flex items-center justify-center size-12 rounded-xl bg-purple-50 text-purple-600 dark:bg-purple-900/20 dark:text-purple-400 shrink-0 group-hover:scale-110 transition-transform duration-300">
                                    <span class="material-symbols-outlined text-[24px]">person</span>
                                </div>
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-2">
                                        <h2
                                            class="text-lg md:text-xl font-display font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors">
                                            II. Identitas Diri</h2>
                                        <span x-show="step2Complete"
                                            class="material-symbols-outlined text-success text-xl">check_circle</span>
                                    </div>
                                    <span class="text-sm text-slate-400 dark:text-slate-500 font-normal">Sesuai KTP dan
                                        Ijazah Terakhir</span>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="flex items-center justify-center size-10 rounded-full border border-slate-200 dark:border-slate-700 text-slate-400 group-hover:border-primary group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                </div>
                            </div>
                        </label>

                        <!-- Step 3: Identitas SMA -->
                        <label
                            class="group bg-white dark:bg-surface-dark rounded-2xl shadow-soft border border-border-light dark:border-border-dark p-5 md:p-6 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all hover:border-primary/30 hover:shadow-md flex items-center justify-between"
                            for="modal-3">
                            <div class="flex items-center gap-4 md:gap-6">
                                <div
                                    class="flex items-center justify-center size-12 rounded-xl bg-orange-50 text-orange-600 dark:bg-orange-900/20 dark:text-orange-400 shrink-0 group-hover:scale-110 transition-transform duration-300">
                                    <span class="material-symbols-outlined text-[24px]">apartment</span>
                                </div>
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-2">
                                        <h2
                                            class="text-lg md:text-xl font-display font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors">
                                            III. Identitas SMA/Sederajat</h2>
                                        <span x-show="step3Complete"
                                            class="material-symbols-outlined text-success text-xl">check_circle</span>
                                    </div>
                                    <span class="text-sm text-slate-400 dark:text-slate-500 font-normal">Belum diisi -
                                        Asal sekolah dan nilai</span>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="flex items-center justify-center size-10 rounded-full border border-slate-200 dark:border-slate-700 text-slate-400 group-hover:border-primary group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                    <span class="material-symbols-outlined text-sm"
                                        x-text="step3Complete ? 'edit' : 'add'">add</span>
                                </div>
                            </div>
                        </label>

                        <!-- Step 4: Orang Tua -->
                        <label
                            class="group bg-white dark:bg-surface-dark rounded-2xl shadow-soft border border-border-light dark:border-border-dark p-5 md:p-6 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all hover:border-primary/30 hover:shadow-md flex items-center justify-between"
                            for="modal-4">
                            <div class="flex items-center gap-4 md:gap-6">
                                <div
                                    class="flex items-center justify-center size-12 rounded-xl bg-teal-50 text-teal-600 dark:bg-teal-900/20 dark:text-teal-400 shrink-0 group-hover:scale-110 transition-transform duration-300">
                                    <span class="material-symbols-outlined text-[24px]">family_restroom</span>
                                </div>
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-2">
                                        <h2
                                            class="text-lg md:text-xl font-display font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors">
                                            IV. Identitas Ortu/Wali</h2>
                                        <span x-show="step4Complete"
                                            class="material-symbols-outlined text-success text-xl">check_circle</span>
                                    </div>
                                    <span class="text-sm text-slate-400 dark:text-slate-500 font-normal">Belum diisi -
                                        Data orang tua atau wali</span>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="flex items-center justify-center size-10 rounded-full border border-slate-200 dark:border-slate-700 text-slate-400 group-hover:border-primary group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                    <span class="material-symbols-outlined text-sm"
                                        x-text="step4Complete ? 'edit' : 'add'">add</span>
                                </div>
                            </div>
                        </label>

                        <!-- Step 5: Transfer -->
                        <label
                            class="group bg-white dark:bg-surface-dark rounded-2xl shadow-soft border border-border-light dark:border-border-dark p-5 md:p-6 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all hover:border-primary/30 hover:shadow-md flex items-center justify-between"
                            for="modal-5">
                            <div class="flex items-center gap-4 md:gap-6">
                                <div
                                    class="flex items-center justify-center size-12 rounded-xl bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400 shrink-0 group-hover:scale-110 transition-transform duration-300">
                                    <span class="material-symbols-outlined text-[24px]">move_up</span>
                                </div>
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-2">
                                        <h2
                                            class="text-lg md:text-xl font-display font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors">
                                            V. Mahasiswa Transfer (Opsional)</h2>
                                    </div>
                                    <span class="text-sm text-slate-400 dark:text-slate-500 font-normal">Kosongkan jika
                                        bukan mahasiswa pindahan</span>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div
                                    class="flex items-center justify-center size-10 rounded-full border border-slate-200 dark:border-slate-700 text-slate-400 group-hover:border-primary group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                    <span class="material-symbols-outlined text-sm">add</span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <div
                        class="flex flex-col-reverse md:flex-row justify-end gap-4 mt-8 pt-8 border-t border-slate-200 dark:border-slate-700">
                        <button
                            class="flex items-center justify-center gap-2 h-14 px-8 rounded-xl border-2 border-slate-200 dark:border-slate-700 bg-transparent text-slate-600 dark:text-white font-bold hover:bg-slate-50 dark:hover:bg-slate-800 hover:border-slate-300 transition-all"
                            type="submit" onclick="document.getElementById('form-action').value='draft'">
                            <span class="material-symbols-outlined text-[20px]">save</span>
                            <span>Simpan Draf</span>
                        </button>
                        <button
                            class="flex items-center justify-center gap-2 h-14 px-10 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:scale-[1.02] hover:-translate-y-0.5 active:scale-[0.98] transition-all transform w-full md:w-auto disabled:opacity-70 disabled:cursor-not-allowed disabled:transform-none"
                            type="submit" onclick="document.getElementById('form-action').value='submit'" @click="const isDraftSaved = {{ session('was_draft') ? 'true' : 'false' }};
                                    if(!isDraftSaved && (!step1Complete || !step2Complete || !step3Complete || !step4Complete)) { 
                                        $event.preventDefault(); 
                                        showToast('Data belum lengkap. Silakan lengkapi atau klik \'Simpan Draf\' terlebih dahulu agar bisa melanjutkan.', 'warning'); 
                                    }" :disabled="isLoading">

                            <!-- Loading Spinner -->
                            <svg x-show="isLoading" class="animate-spin h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                style="display: none;">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>

                            <!-- Button Text (Always Visible) -->
                            <span>Lanjut</span>

                            <!-- Icon (Hidden when loading) -->
                            <span x-show="!isLoading" class="material-symbols-outlined text-[20px]">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </main>

            <!-- MODALS -->

            <!-- Modal 1: Program Studi (Updated with New UI) -->
            <div
                class="fixed inset-0 z-[60] hidden peer-checked/modal1:flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm transition-all duration-300">
                <label class="absolute inset-0" for="modal-1"></label>
                <div
                    class="relative w-full max-w-[580px] flex flex-col bg-white dark:bg-[#1a202c] rounded-xl shadow-2xl transform transition-all scale-100 overflow-hidden modal-animate">
                    <div
                        class="flex items-center justify-between px-6 py-5 border-b border-[#dbdfe6] dark:border-gray-700">
                        <div class="flex flex-col">
                            <h2
                                class="text-[#111318] dark:text-white text-[20px] font-bold leading-tight tracking-[-0.015em]">
                                I. Program Studi
                            </h2>
                        </div>
                        <label for="modal-1"
                            class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-500 dark:text-gray-400 transition-colors cursor-pointer">
                            <span class="material-symbols-outlined">close</span>
                        </label>
                    </div>
                    <div class="flex flex-col gap-6 px-8 py-8">
                        <div class="flex flex-col gap-1">
                            <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Silakan pilih program studi
                                utama
                                dan cadangan Anda</p>
                        </div>
                        <div class="flex flex-col w-full">
                            <p class="text-[#111318] dark:text-gray-200 text-base font-semibold leading-normal pb-3">
                                Gelombang</p>
                            <div class="flex flex-wrap gap-6">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input class="custom-radio" name="gelombang" type="radio" value="1" {{ old('gelombang', $pendaftar->gelombang ?? '') == '1' ? 'checked' : '' }} />
                                    <span
                                        class="text-base text-[#111318] dark:text-gray-300 group-hover:text-primary transition-colors">Gelombang
                                        I</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input class="custom-radio" name="gelombang" type="radio" value="2" {{ old('gelombang', $pendaftar->gelombang ?? '') == '2' ? 'checked' : '' }} />
                                    <span
                                        class="text-base text-[#111318] dark:text-gray-300 group-hover:text-primary transition-colors">Gelombang
                                        II</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input class="custom-radio" name="gelombang" type="radio" value="3" {{ old('gelombang', $pendaftar->gelombang ?? '') == '3' ? 'checked' : '' }} />
                                    <span
                                        class="text-base text-[#111318] dark:text-gray-300 group-hover:text-primary transition-colors">Gelombang
                                        III</span>
                                </label>
                            </div>
                        </div>
                        <div class="flex flex-col w-full gap-5">
                            <div class="flex items-center justify-between">
                                <p class="text-[#111318] dark:text-gray-200 text-base font-semibold leading-normal">
                                    Pilihan
                                    Program Studi</p>
                                <div class="flex flex-col items-end">
                                    <span id="prodi-counter-new"
                                        class="text-xs font-medium px-2 py-1 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 rounded-md">0/2
                                        terpilih</span>
                                </div>
                            </div>
                            <p id="prodi-error-new" class="text-xs text-red-500 dark:text-red-400 -mt-4 font-medium">
                                *Wajib
                                memilih minimal 2 program studi</p>

                            <!-- Hidden input for backend compatibility -->
                            <input type="hidden" name="pilihan_prodi" id="real-pilihan-prodi-new">

                            <div class="grid grid-cols-1 gap-4">
                                <div class="flex flex-col gap-2">
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Pilihan
                                        Utama</label>
                                    <select x-model="prodiUtama" @change="updateProdiValue()"
                                        class="form-select w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-[#1a202c] focus:border-primary focus:ring-primary text-sm h-11 transition-all"
                                        id="select-utama">
                                        <option value="">Pilih Program Studi Utama</option>
                                        <option value="Sistem Informasi S1">Sistem Informasi S1</option>
                                        <option value="Sistem Komputer S1">Sistem Komputer S1</option>
                                        <option value="Bisnis Digital S1">Bisnis Digital S1</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Pilihan
                                        Cadangan</label>
                                    <select x-model="prodiCadangan" @change="updateProdiValue()"
                                        class="form-select w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-[#1a202c] focus:border-primary focus:ring-primary text-sm h-11 transition-all"
                                        id="select-cadangan">
                                        <option value="">Pilih Program Studi Cadangan</option>
                                        <option value="Sistem Informasi S1">Sistem Informasi S1</option>
                                        <option value="Sistem Komputer S1">Sistem Komputer S1</option>
                                        <option value="Bisnis Digital S1">Bisnis Digital S1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex gap-3 bg-primary/5 dark:bg-primary/10 p-4 rounded-lg border border-primary/10 dark:border-primary/20 items-start">
                            <span class="material-symbols-outlined text-primary text-[20px] mt-0.5">info</span>
                            <p class="text-[13px] text-gray-600 dark:text-gray-400 leading-snug">
                                Pastikan pilihan program studi sudah sesuai dengan minat Anda. Pilihan tidak dapat
                                diubah setelah pembayaran formulir dikonfirmasi.
                            </p>
                        </div>
                    </div>
                    <div
                        class="px-8 py-5 bg-[#fcfcfd] dark:bg-[#1e2532] border-t border-[#dbdfe6] dark:border-gray-700 flex flex-col-reverse sm:flex-row gap-3 justify-end items-center">
                        <label for="modal-1"
                            class="flex w-full sm:w-auto min-w-[100px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-6 bg-transparent hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-600 dark:text-gray-300 text-sm font-bold leading-normal tracking-[0.015em] transition-colors">
                            <span class="truncate">Batal</span>
                        </label>
                        <div @click="validateStep(1)"
                            class="flex items-center gap-2 px-6 py-3 rounded-xl bg-primary text-white font-bold shadow-lg shadow-blue-500/20 hover:bg-primary-dark cursor-pointer transition-colors">
                            <span>Simpan & Lanjutkan</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal 2: Identitas Diri (WRAPPER from User HTML, FIELDS from Old Code) -->
            <div
                class="fixed inset-0 z-[60] hidden peer-checked/modal2:flex items-center justify-center p-4 sm:p-6 opacity-0 peer-checked/modal2:opacity-100 transition-opacity duration-300">
                <label class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"
                    for="modal-2"></label>
                <div
                    class="relative w-full max-w-4xl max-h-[90vh] overflow-y-auto bg-white dark:bg-surface-dark rounded-2xl shadow-2xl flex flex-col modal-animate">
                    <div
                        class="sticky top-0 z-10 flex items-center justify-between p-6 border-b border-slate-100 dark:border-slate-800 bg-white/95 dark:bg-surface-dark/95 backdrop-blur-md">
                        <h3 class="text-xl font-bold font-display text-slate-900 dark:text-white">II. Identitas Diri
                        </h3>
                        <label
                            class="cursor-pointer p-2 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-full transition-colors text-slate-500 dark:text-slate-400"
                            for="modal-2">
                            <span class="material-symbols-outlined">close</span>
                        </label>
                    </div>
                    <div class="p-6 md:p-8 grid grid-cols-12 gap-4">
                        <!-- Row 1: NIK & NISN -->
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">NIK <span
                                    class="text-red-500">*</span></label>
                            <input name="nik" value="{{ old('nik', $pendaftar->nik ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                type="text" placeholder="16 digit NIK" maxlength="16"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57" required />
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">NISN</label>
                            <input name="nisn" value="{{ old('nisn', $pendaftar->nisn ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                type="text" placeholder="10 digit NISN (Opsional)" maxlength="10"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
                        </div>

                        <!-- Status Pernikahan & NPWP -->
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Status Pernikahan <span
                                    class="text-red-500">*</span></label>
                            <select name="status_pernikahan"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                                <option value="" disabled {{ !old('status_pernikahan', $pendaftar->status_pernikahan ?? '') ? 'selected' : '' }}>Pilih</option>
                                <option value="Belum Menikah" {{ (old('status_pernikahan', $pendaftar->status_pernikahan ?? '') == 'Belum Menikah') ? 'selected' : '' }}>Belum Menikah</option>
                                <option value="Menikah" {{ (old('status_pernikahan', $pendaftar->status_pernikahan ?? '') == 'Menikah') ? 'selected' : '' }}>Menikah</option>
                                <option value="Janda/Duda" {{ (old('status_pernikahan', $pendaftar->status_pernikahan ?? '') == 'Janda/Duda') ? 'selected' : '' }}>Janda/Duda</option>
                            </select>
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Nomor NPWP</label>
                            <input name="npwp" value="{{ old('npwp', $pendaftar->npwp ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                type="text" placeholder="Opsional (Jika ada)" />
                        </div>

                        <!-- Row 2: Nama & Jenis Kelamin -->
                        <div class="col-span-12 md:col-span-8 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <input name="nama_lengkap"
                                value="{{ old('nama_lengkap', $pendaftar->nama_lengkap ?? Auth::user()->name ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                type="text" placeholder="Sesuai ijazah" required />
                        </div>
                        <div class="col-span-12 md:col-span-4 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Jenis Kelamin <span
                                    class="text-red-500">*</span></label>
                            <select name="jenis_kelamin"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                                <option value="" disabled>Pilih</option>
                                <option value="L" {{ (old('jenis_kelamin', $pendaftar->jenis_kelamin ?? '') == 'L') ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ (old('jenis_kelamin', $pendaftar->jenis_kelamin ?? '') == 'P') ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- Row 3: Tempat & Tanggal Lahir -->
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Tempat Lahir <span
                                    class="text-red-500">*</span></label>
                            <input name="tempat_lahir" value="{{ old('tempat_lahir', $pendaftar->tempat_lahir ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                type="text" />
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Tanggal Lahir <span
                                    class="text-red-500">*</span></label>
                            <input name="tanggal_lahir"
                                value="{{ old('tanggal_lahir', $pendaftar->tanggal_lahir ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                type="date" />
                        </div>

                        <!-- Row 4: Agama & Physical -->
                        <div class="col-span-12 md:col-span-4 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Agama <span
                                    class="text-red-500">*</span></label>
                            <select name="agama"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                                <option value="Islam" {{ (old('agama', $pendaftar->agama ?? '') == 'Islam') ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ (old('agama', $pendaftar->agama ?? '') == 'Kristen') ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ (old('agama', $pendaftar->agama ?? '') == 'Katolik') ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ (old('agama', $pendaftar->agama ?? '') == 'Hindu') ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ (old('agama', $pendaftar->agama ?? '') == 'Buddha') ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ (old('agama', $pendaftar->agama ?? '') == 'Konghucu') ? 'selected' : '' }}>Konghucu
                                </option>
                            </select>
                        </div>
                        <div class="col-span-6 md:col-span-4 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Tinggi (cm)</label>
                            <input name="tinggi_badan" value="{{ old('tinggi_badan', $pendaftar->tinggi_badan ?? '') }}"
                                type="number"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm" />
                        </div>
                        <div class="col-span-6 md:col-span-4 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Berat (kg)</label>
                            <input name="berat_badan" value="{{ old('berat_badan', $pendaftar->berat_badan ?? '') }}"
                                type="number"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm" />
                        </div>

                        <!-- Row 5: Alamat -->
                        <div class="col-span-12 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <h4 class="font-bold text-primary text-sm uppercase tracking-wide">Alamat Lengkap</h4>
                        </div>
                        <div class="col-span-12 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Jalan / Dusun / Lingkungan
                                <span class="text-red-500">*</span></label>
                            <input name="alamat_lengkap"
                                value="{{ old('alamat_lengkap', $pendaftar->alamat_lengkap ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                type="text" />
                        </div>
                        <div class="col-span-6 md:col-span-3 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">RT</label>
                            <input name="rt" value="{{ old('rt', $pendaftar->rt ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                type="number" />
                        </div>
                        <div class="col-span-6 md:col-span-3 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">RW</label>
                            <input name="rw" value="{{ old('rw', $pendaftar->rw ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                type="number" />
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Kelurahan/Desa <span
                                    class="text-red-500">*</span></label>
                            <input name="kelurahan" value="{{ old('kelurahan', $pendaftar->kelurahan ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                type="text" />
                        </div>
                        <div class="col-span-12 md:col-span-4 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Kecamatan <span
                                    class="text-red-500">*</span></label>
                            <input name="kecamatan" value="{{ old('kecamatan', $pendaftar->kecamatan ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                type="text" />
                        </div>
                        <div class="col-span-12 md:col-span-4 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Kabupaten/Kota <span
                                    class="text-red-500">*</span></label>
                            <input name="kabupaten" value="{{ old('kabupaten', $pendaftar->kabupaten ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                type="text" />
                        </div>
                        <div class="col-span-12 md:col-span-4 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Provinsi <span
                                    class="text-red-500">*</span></label>
                            <input name="provinsi" value="{{ old('provinsi', $pendaftar->provinsi ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                type="text" />
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Tinggal Bersama <span
                                    class="text-red-500">*</span></label>
                            <select name="tinggal_bersama"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                                <option value="" disabled {{ !old('tinggal_bersama', $pendaftar->tinggal_bersama ?? '') ? 'selected' : '' }}>Pilih</option>
                                <option value="Orang Tua" {{ (old('tinggal_bersama', $pendaftar->tinggal_bersama ?? '') == 'Orang Tua') ? 'selected' : '' }}>Orang Tua</option>
                                <option value="Wali" {{ (old('tinggal_bersama', $pendaftar->tinggal_bersama ?? '') == 'Wali') ? 'selected' : '' }}>Wali</option>
                                <option value="Kos" {{ (old('tinggal_bersama', $pendaftar->tinggal_bersama ?? '') == 'Kos') ? 'selected' : '' }}>Kos</option>
                                <option value="Asrama" {{ (old('tinggal_bersama', $pendaftar->tinggal_bersama ?? '') == 'Asrama') ? 'selected' : '' }}>Asrama</option>
                                <option value="Lainnya" {{ (old('tinggal_bersama', $pendaftar->tinggal_bersama ?? '') == 'Lainnya') ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Kode Pos <span
                                    class="text-red-500">*</span></label>
                            <input name="kode_pos" value="{{ old('kode_pos', $pendaftar->kode_pos ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                type="text" placeholder="5 digit kode pos" />
                        </div>

                        <!-- Row 6: Kontak -->
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Email <span
                                    class="text-red-500">*</span></label>
                            <input name="email"
                                value="{{ old('email', $pendaftar->email ?? Auth::user()->email ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                type="email" />
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">No HP / WA <span
                                    class="text-red-500">*</span></label>
                            <input name="no_hp" value="{{ old('no_hp', $pendaftar->no_hp ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                type="tel" />
                        </div>
                        <!-- Data KIP/KPS (Moved from Keluarga) -->
                        <div class="col-span-12 pt-6 border-t border-gray-100 dark:border-gray-700">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-[20px]">card_membership</span>
                                <h4 class="font-bold text-primary text-sm uppercase tracking-wide">Data KIP/KPS
                                    (Opsional)</h4>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Peserta KIP (Kartu Indonesia
                                Pintar)?</label>
                            <select name="peserta_kip"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                                <option value="Tidak" {{ old('peserta_kip', $pendaftar->peserta_kip ?? '') == 'Tidak' ? 'selected' : '' }}>Bukan Peserta KIP</option>
                                <option value="Ya" {{ old('peserta_kip', $pendaftar->peserta_kip ?? '') == 'Ya' ? 'selected' : '' }}>Ya, Peserta KIP</option>
                            </select>
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Nomor KIP</label>
                            <input name="no_kip" value="{{ old('no_kip', $pendaftar->no_kip ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                placeholder="Opsional (Jika ada)" />
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Penerima KPS/PKH?</label>
                            <select name="penerima_kps"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                                <option value="Tidak" {{ old('penerima_kps', $pendaftar->penerima_kps ?? '') == 'Tidak' ? 'selected' : '' }}>Bukan Penerima</option>
                                <option value="Ya" {{ old('penerima_kps', $pendaftar->penerima_kps ?? '') == 'Ya' ? 'selected' : '' }}>Ya, Penerima</option>
                            </select>
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Nomor KPS/PKH</label>
                            <input name="no_kps" value="{{ old('no_kps', $pendaftar->no_kps ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                placeholder="Opsional (Jika ada)" />
                        </div>

                        <!-- Row 7: Detail Pekerjaan -->
                        <div class="col-span-12 pt-6 border-t border-gray-100 dark:border-gray-700">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-[20px]">work</span>
                                <h4 class="font-bold text-primary text-sm uppercase tracking-wide">Detail Pekerjaan
                                    (Jika sudah bekerja)</h4>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Nama Perusahaan</label>
                            <input name="nama_perusahaan"
                                value="{{ old('nama_perusahaan', $pendaftar->nama_perusahaan ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                placeholder="Nama perusahaan tempat bekerja" />
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">No. Telp Perusahaan</label>
                            <input name="telp_perusahaan"
                                value="{{ old('telp_perusahaan', $pendaftar->telp_perusahaan ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                placeholder="Nomor telepon kantor" />
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Jabatan Saat Ini</label>
                            <input name="jabatan" value="{{ old('jabatan', $pendaftar->jabatan ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                placeholder="Posisi / Jabatan" />
                        </div>
                        <div class="col-span-12 md:col-span-12 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Alamat Perusahaan</label>
                            <input name="alamat_perusahaan"
                                value="{{ old('alamat_perusahaan', $pendaftar->alamat_perusahaan ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                placeholder="Alamat lengkap perusahaan" />
                        </div>
                    </div>
                    <div
                        class="p-6 border-t border-slate-100 dark:border-slate-800 flex justify-end gap-3 bg-slate-50 dark:bg-black/20 rounded-b-2xl">
                        <label for="modal-2"
                            class="px-6 py-3 rounded-xl border border-slate-200 dark:border-slate-600 font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 cursor-pointer transition-colors">Batal</label>
                        <div @click="validateStep(2)"
                            class="flex items-center gap-2 px-6 py-3 rounded-xl bg-primary text-white font-bold shadow-lg shadow-blue-500/20 hover:bg-primary-dark cursor-pointer transition-colors">
                            <span>Simpan &amp; Lanjutkan</span>
                            <span class="material-symbols-outlined text-sm">check</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal 3: Identitas SMA / Sederajat -->
            <div
                class="fixed inset-0 z-[60] hidden peer-checked/modal3:flex items-center justify-center p-4 sm:p-6 opacity-0 peer-checked/modal3:opacity-100 transition-opacity duration-300">
                <label class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"
                    for="modal-3"></label>
                <div
                    class="relative w-full max-w-4xl max-h-[90vh] overflow-y-auto bg-white dark:bg-surface-dark rounded-2xl shadow-2xl flex flex-col modal-animate">
                    <div
                        class="sticky top-0 z-10 flex items-center justify-between p-6 border-b border-slate-100 dark:border-slate-800 bg-white/95 dark:bg-surface-dark/95 backdrop-blur-md">
                        <div class="flex flex-col gap-1">
                            <h3 class="text-xl font-bold font-display text-slate-900 dark:text-white">III. Identitas SMA
                                / Sederajat</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Lengkapi data sekolah asal Anda sesuai
                                dengan ijazah kelulusan.</p>
                        </div>
                        <label
                            class="cursor-pointer p-2 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-full transition-colors text-slate-500 dark:text-slate-400"
                            for="modal-3">
                            <span class="material-symbols-outlined">close</span>
                        </label>
                    </div>
                    <div class="p-6 md:p-8 grid grid-cols-12 gap-6">
                        <!-- Row 1: Nama Sekolah -->
                        <div class="col-span-12 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Nama Sekolah</label>
                            <input name="nama_sekolah" value="{{ old('nama_sekolah', $pendaftar->nama_sekolah ?? '') }}"
                                class="w-full h-12 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                type="text" placeholder="Contoh: SMA Negeri 1 Jakarta" />
                        </div>

                        <!-- Row 2: Jurusan & Nilai -->
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Jurusan / Program</label>
                            <select name="jurusan_sekolah"
                                class="w-full h-12 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">
                                <option value="" disabled selected>Pilih Jurusan</option>
                                <option value="IPA" {{ old('jurusan_sekolah', $pendaftar->jurusan_sekolah ?? '') == 'IPA' ? 'selected' : '' }}>IPA</option>
                                <option value="IPS" {{ old('jurusan_sekolah', $pendaftar->jurusan_sekolah ?? '') == 'IPS' ? 'selected' : '' }}>IPS</option>
                                <option value="Bahasa" {{ old('jurusan_sekolah', $pendaftar->jurusan_sekolah ?? '') == 'Bahasa' ? 'selected' : '' }}>Bahasa
                                </option>
                                <option value="Kejuruan" {{ old('jurusan_sekolah', $pendaftar->jurusan_sekolah ?? '') == 'Kejuruan' ? 'selected' : '' }}>
                                    SMK/Kejuruan</option>
                                <option value="Lainnya" {{ old('jurusan_sekolah', $pendaftar->jurusan_sekolah ?? '') == 'Lainnya' ? 'selected' : '' }}>
                                    Lainnya</option>
                            </select>
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Nilai UN / Rata-rata
                                Ijazah</label>
                            <input name="nilai_rata_rata"
                                value="{{ old('nilai_rata_rata', $pendaftar->nilai_rata_rata ?? '') }}"
                                class="w-full h-12 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                type="text" placeholder="0.00" />
                        </div>

                        <!-- Row 3: Tahun Lulus -->
                        <div class="col-span-12 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Tahun Lulus</label>
                            <select name="tahun_lulus"
                                class="w-full h-12 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">
                                <option value="" disabled selected>Pilih Tahun</option>
                                @for ($i = date('Y'); $i >= 2015; $i--)
                                    <option value="{{ $i }}" {{ old('tahun_lulus', $pendaftar->tahun_lulus ?? '') == $i ? 'selected' : '' }}>{{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <!-- Row 4: Alamat Sekolah Heading -->
                        <div class="col-span-12 pt-4 flex items-center gap-2 text-primary font-bold">
                            <span class="material-symbols-outlined text-[20px]">location_on</span>
                            <span>Alamat Sekolah Lengkap</span>
                        </div>

                        <!-- Row 5: Alamat Sekolah Textarea -->
                        <div class="col-span-12 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Alamat Sekolah</label>
                            <textarea name="alamat_sekolah"
                                class="w-full h-32 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 p-4 text-slate-900 dark:text-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all resize-none"
                                placeholder="Tuliskan alamat lengkap sekolah (Jalan, No, Kelurahan, Kecamatan, Kota, Provinsi)">{{ old('alamat_sekolah', $pendaftar->alamat_sekolah ?? '') }}</textarea>
                        </div>
                    </div>
                    <div
                        class="p-6 border-t border-slate-100 dark:border-slate-800 flex justify-end gap-3 bg-slate-50 dark:bg-black/20 rounded-b-2xl">
                        <label for="modal-3"
                            class="px-6 py-3 rounded-xl border border-slate-200 dark:border-slate-600 font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 cursor-pointer transition-colors">Batal</label>
                        <div @click="validateStep(3)"
                            class="flex items-center gap-2 px-6 py-3 rounded-xl bg-primary text-white font-bold shadow-lg shadow-blue-500/20 hover:bg-primary-dark cursor-pointer transition-colors">
                            <span>Simpan &amp; Lanjutkan</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal 4: Identitas Keluarga -->
            @include('mahasiswa.partials.modal-keluarga')

            <!-- Modal 5: Mahasiswa Transfer (Pindahan) -->
            <div
                class="fixed inset-0 z-[60] hidden peer-checked/modal5:flex items-center justify-center p-4 sm:p-6 opacity-0 peer-checked/modal5:opacity-100 transition-opacity duration-300">
                <label class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"
                    for="modal-5"></label>
                <div
                    class="relative w-full max-w-4xl max-h-[90vh] overflow-y-auto bg-white dark:bg-surface-dark rounded-2xl shadow-2xl flex flex-col modal-animate">
                    <div
                        class="sticky top-0 z-10 flex items-center justify-between p-6 border-b border-slate-100 dark:border-slate-800 bg-white/95 dark:bg-surface-dark/95 backdrop-blur-md">
                        <div class="flex flex-col gap-1">
                            <h3 class="text-xl font-bold font-display text-slate-900 dark:text-white">V. Mahasiswa
                                Transfer (Pindahan)</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Mohon lengkapi data pendidikan asal
                                Anda dengan akurat sesuai dengan ijazah atau transkrip nilai terakhir.</p>
                        </div>
                        <label
                            class="cursor-pointer p-2 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-full transition-colors text-slate-500 dark:text-slate-400"
                            for="modal-5">
                            <span class="material-symbols-outlined">close</span>
                        </label>
                    </div>
                    <div class="p-6 md:p-8 grid grid-cols-12 gap-6">
                        <!-- Asal Perguruan Tinggi -->
                        <div class="col-span-12 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Asal Perguruan
                                Tinggi</label>
                            <input name="asal_pt" value="{{ old('asal_pt', $pendaftar->asal_pt ?? '') }}"
                                class="w-full h-12 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                type="text" placeholder="Contoh: Universitas Indonesia" />
                        </div>

                        <!-- Asal Program Studi -->
                        <div class="col-span-12 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Asal Program Studi</label>
                            <input name="asal_prodi" value="{{ old('asal_prodi', $pendaftar->asal_prodi ?? '') }}"
                                class="w-full h-12 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                type="text" placeholder="Contoh: Teknik Informatika" />
                        </div>

                        <!-- Status Terakreditasi -->
                        <div class="col-span-12 flex flex-col gap-3">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Status Terakreditasi</label>
                            <div class="flex flex-wrap gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="akreditasi_asal" value="A" class="peer sr-only" {{ old('akreditasi_asal', $pendaftar->akreditasi_asal ?? '') == 'A' ? 'checked' : '' }}>
                                    <div
                                        class="px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 peer-checked:border-primary peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 peer-checked:text-primary font-bold text-sm transition-all hover:bg-gray-50 dark:hover:bg-slate-700">
                                        Terakreditasi A
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="akreditasi_asal" value="B" class="peer sr-only" {{ old('akreditasi_asal', $pendaftar->akreditasi_asal ?? '') == 'B' ? 'checked' : '' }}>
                                    <div
                                        class="px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 peer-checked:border-primary peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 peer-checked:text-primary font-bold text-sm transition-all hover:bg-gray-50 dark:hover:bg-slate-700">
                                        Terakreditasi B
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="akreditasi_asal" value="C" class="peer sr-only" {{ old('akreditasi_asal', $pendaftar->akreditasi_asal ?? '') == 'C' ? 'checked' : '' }}>
                                    <div
                                        class="px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 peer-checked:border-primary peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 peer-checked:text-primary font-bold text-sm transition-all hover:bg-gray-50 dark:hover:bg-slate-700">
                                        Terakreditasi C
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="akreditasi_asal" value="Belum" class="peer sr-only" {{ old('akreditasi_asal', $pendaftar->akreditasi_asal ?? '') == 'Belum' ? 'checked' : '' }}>
                                    <div
                                        class="px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 peer-checked:border-primary peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 peer-checked:text-primary font-bold text-sm transition-all hover:bg-gray-50 dark:hover:bg-slate-700 flex flex-col leading-tight items-start">
                                        <span>Belum</span>
                                        <span>Terakreditasi</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div
                        class="p-6 border-t border-slate-100 dark:border-slate-800 flex justify-end gap-3 bg-slate-50 dark:bg-black/20 rounded-b-2xl">
                        <label for="modal-5"
                            class="px-6 py-3 rounded-xl border border-slate-200 dark:border-slate-600 font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 cursor-pointer transition-colors">Batal</label>
                        <div @click="document.getElementById('modal-5').checked = false; checkCompletion();"
                            class="flex items-center gap-2 px-6 py-3 rounded-xl bg-primary text-white font-bold shadow-lg shadow-blue-500/20 hover:bg-primary-dark cursor-pointer transition-colors">
                            <span>Simpan &amp; Lanjutkan</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <!-- Alpine.js Logic -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('registrationForm', () => ({
                step1Complete: false,
                step2Complete: false,
                step3Complete: false,
                step4Complete: false,
                prodiUtama: '{{ str_contains($pendaftar->pilihan_prodi ?? "", ",") ? explode(", ", $pendaftar->pilihan_prodi)[0] : "" }}',
                prodiCadangan: '{{ str_contains($pendaftar->pilihan_prodi ?? "", ",") ? explode(", ", $pendaftar->pilihan_prodi)[1] ?? "" : "" }}',
                toasts: [],

                init() {
                    this.checkCompletion();

                    // Add listeners to all inputs to clear highlights when changed
                    this.$nextTick(() => {
                        const inputs = document.querySelectorAll('#pendaftaran-form input, #pendaftaran-form select, #pendaftaran-form textarea');
                        inputs.forEach(input => {
                            input.addEventListener('change', () => {
                                input.classList.remove('border-red-500', 'ring-red-500/20');
                            });
                            input.addEventListener('input', () => {
                                input.classList.remove('border-red-500', 'ring-red-500/20');
                            });
                        });
                    });
                },

                checkCompletion() {
                    // Step 1: Program Studi
                    const gelombang = document.querySelector('[name="gelombang"]:checked');
                    this.step1Complete = !!(gelombang && this.prodiUtama && this.prodiCadangan && this.prodiUtama !== this.prodiCadangan);

                    // Step 2: Identitas Diri
                    const step2Fields = ['nik', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama', 'alamat_lengkap', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi', 'email', 'no_hp', 'status_pernikahan', 'tinggal_bersama', 'kode_pos'];
                    this.step2Complete = step2Fields.every(name => {
                        const el = document.querySelector(`[name="${name}"]`);
                        return el && el.value.trim() !== '';
                    });

                    // Step 3: Identitas Sekolah
                    const step3Fields = ['nama_sekolah', 'jurusan_sekolah', 'nilai_rata_rata', 'tahun_lulus', 'alamat_sekolah'];
                    this.step3Complete = step3Fields.every(name => {
                        const el = document.querySelector(`[name="${name}"]`);
                        return el && el.value.trim() !== '';
                    });

                    // Step 4: Identitas Keluarga
                    const ayahFields = ['status_ayah', 'nomor_kk', 'nama_ayah', 'nik_ayah', 'hp_ayah', 'alamat_ayah', 'pendidikan_ayah', 'pekerjaan_ayah', 'penghasilan_ayah'];
                    const ibuFields = ['status_ibu', 'nama_ibu', 'nik_ibu', 'hp_ibu', 'alamat_ibu', 'pendidikan_ibu', 'pekerjaan_ibu', 'penghasilan_ibu'];

                    const checkFields = (fields) => {
                        return fields.every(name => {
                            if (name.startsWith('status_')) {
                                return document.querySelector(`[name="${name}"]:checked`);
                            }
                            const el = document.querySelector(`[name="${name}"]`);
                            return el && el.value.trim() !== '';
                        });
                    };

                    this.step4Complete = checkFields(ayahFields) && checkFields(ibuFields);
                },

                updateProdiValue() {
                    let combined = [];
                    if (this.prodiUtama) combined.push(this.prodiUtama);
                    if (this.prodiCadangan) combined.push(this.prodiCadangan);
                    const realInput = document.getElementById('real-pilihan-prodi-new');
                    if (realInput) realInput.value = combined.join(', ');
                    this.checkCompletion();
                },

                validateStep(step) {
                    let fields = [];
                    let stepName = "";
                    let isValid = true;
                    let missing = [];

                    if (step === 1) {
                        const gelombang = document.querySelector('[name="gelombang"]:checked');
                        if (!gelombang) {
                            isValid = false;
                            missing.push("Gelombang");
                        }
                        if (!this.prodiUtama || !this.prodiCadangan) {
                            isValid = false;
                            missing.push("Pilihan Program Studi (Utama & Cadangan)");
                        } else if (this.prodiUtama === this.prodiCadangan) {
                            isValid = false;
                            this.showToast("Pilihan Program Studi Utama dan Cadangan tidak boleh sama.", "warning");
                            return false;
                        }
                        stepName = "Program Studi";
                    } else if (step === 2) {
                        fields = ['nik', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama', 'alamat_lengkap', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi', 'email', 'no_hp', 'status_pernikahan', 'tinggal_bersama', 'kode_pos'];
                        stepName = "Identitas Diri";
                    } else if (step === 3) {
                        fields = ['nama_sekolah', 'jurusan_sekolah', 'nilai_rata_rata', 'tahun_lulus', 'alamat_sekolah'];
                        stepName = "Identitas Sekolah";
                    } else if (step === 4) {
                        fields = ['status_ayah', 'nomor_kk', 'nama_ayah', 'nik_ayah', 'hp_ayah', 'alamat_ayah', 'status_ibu', 'nama_ibu', 'nik_ibu', 'hp_ibu', 'alamat_ibu'];
                        stepName = "Identitas Keluarga";
                    }

                    fields.forEach(name => {
                        // EXPLICIT GUARD: Never validate NISN as required
                        if (name === 'nisn') return;

                        let el = document.querySelector(`[name="${name}"]`);
                        if (!el) return;

                        // Check if it's a radio group (multiple elements with same name)
                        const isRadioGroup = document.querySelectorAll(`[name="${name}"][type="radio"]`).length > 0;

                        if (isRadioGroup) {
                            const checked = document.querySelector(`[name="${name}"]:checked`);
                            if (!checked) {
                                isValid = false;
                                const container = el.closest('div');
                                // Look for label in previous sibling or parent's heading
                                const label = container.previousElementSibling || container.closest('div').querySelector('p') || container.querySelector('p');
                                let labelText = label ? label.textContent.trim().replace('*', '') : name;
                                missing.push(labelText);
                            }
                        } else {
                            let val = el.value.trim();
                            if (!val) {
                                isValid = false;
                                el.classList.add('border-red-500', 'ring-red-500/20');
                                let labelText = name;
                                const labelEl = el.closest('div')?.querySelector('label') || el.closest('label')?.querySelector('p') || el.parentElement?.querySelector('label');
                                if (labelEl) labelText = labelEl.textContent.trim().replace('*', '');
                                missing.push(labelText);
                            }
                        }
                    });

                    // Explicitly handle NISN (Optional but must be 10 digits)
                    if (step === 2) {
                        const nisnEl = document.querySelector('[name="nisn"]');
                        if (nisnEl) {
                            const nisnVal = nisnEl.value.trim();
                            if (nisnVal !== "" && nisnVal.length !== 10) {
                                isValid = false;
                                nisnEl.classList.add('border-red-500', 'ring-red-500/20');
                                missing.push("NISN (harus 10 digit)");
                            }
                        }
                    }

                    if (!isValid) {
                        const uniqueMissing = [...new Set(missing)];
                        this.showToast(`Mohon lengkapi data pada bagian ${stepName}: ${uniqueMissing.join(', ')}`, "error");
                    } else {
                        // Close modal manually
                        const modalSelector = document.getElementById('modal-' + step);
                        if (modalSelector) modalSelector.checked = false;
                        this.checkCompletion();
                        this.showToast(`Bagian ${stepName} berhasil disimpan!`, "success");
                    }

                    return isValid;
                },

                showToast(message, type = 'info') {
                    const id = Date.now();
                    this.toasts.push({ id, message, type });
                    setTimeout(() => {
                        this.toasts = this.toasts.filter(t => t.id !== id);
                    }, 5000);
                },

                showUnsavedModal: false,
                pendingUrl: null,

                checkUnsaved(event, url) {
                    if (!this.step1Complete || !this.step2Complete || !this.step3Complete || !this.step4Complete) {
                        event.preventDefault();
                        this.pendingUrl = url;
                        this.showUnsavedModal = true;
                    } else {
                        window.location.href = url;
                    }
                },

                saveDraft() {
                    const form = document.getElementById('pendaftaran-form');
                    const formData = new FormData(form);
                    formData.append('action', 'draft');

                    fetch(form.getAttribute('action'), {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                        .then(response => {
                            if (response.ok) {
                                if (this.pendingUrl) {
                                    window.location.href = this.pendingUrl;
                                } else {
                                    window.location.reload();
                                }
                            } else {
                                response.json().then(data => {
                                    console.error('Save failed:', data);
                                    this.showToast('Gagal menyimpan data: ' + (data.message || response.statusText), 'error');
                                }).catch(() => {
                                    this.showToast('Gagal menyimpan data (Status: ' + response.status + ')', 'error');
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            this.showToast('Terjadi kesalahan jaringan/sistem: ' + error.message, 'error');
                        });
                }
            }));
        });
    </script>

    </form>
    <!-- Unsaved Changes Warning Modal -->
    <div x-show="showUnsavedModal" style="display: none;"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"
            @click="showUnsavedModal = false"></div>
        <div
            class="relative w-full max-w-md bg-white rounded-[2rem] shadow-2xl overflow-hidden border border-slate-100 modal-animate z-[101]">
            <div class="p-8 flex flex-col items-center text-center">
                <div class="mb-6">
                    <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined text-4xl">pending_actions</span>
                    </div>
                </div>
                <div class="space-y-2 mb-8">
                    <h2 class="text-xl font-bold text-slate-800 tracking-tight">Ups! Data Belum Tersimpan</h2>
                    <p class="text-slate-500 text-sm leading-relaxed max-w-[280px] mx-auto">
                        Pastikan Anda menyimpan progres pengisian formulir agar data tidak hilang.
                    </p>
                </div>
                <div class="flex flex-row items-center justify-center gap-3 w-full">
                    <button @click="saveDraft()"
                        class="flex-1 px-5 py-2.5 bg-primary text-white text-sm font-semibold rounded-full hover:bg-blue-900 hover:shadow-lg transition-all active:scale-95">
                        Simpan Draft
                    </button>
                    <button @click="showUnsavedModal = false"
                        class="flex-1 px-5 py-2.5 bg-transparent text-slate-500 text-sm font-semibold rounded-full hover:bg-slate-50 border border-slate-200 transition-all active:scale-95">
                        Tetap di Halaman
                    </button>
                </div>
            </div>
            <p class="mb-6 text-center text-slate-400 text-xs font-medium flex items-center justify-center gap-1.5">
                <span class="material-symbols-outlined text-sm">support_agent</span>
                Butuh bantuan? Hubungi IT Support kami
            </p>
        </div>
    </div>
    <!-- Toast Notifications Container -->
    <div class="fixed bottom-6 right-6 z-[200] flex flex-col gap-3 pointer-events-none" x-data="{ }">
        <template x-for="toast in toasts" :key="toast.id">
            <div x-show="true" x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="translate-y-4 opacity-0 scale-95"
                x-transition:enter-end="translate-y-0 opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="translate-y-0 opacity-100 scale-100"
                x-transition:leave-end="translate-y-4 opacity-0 scale-95"
                class="pointer-events-auto flex items-center gap-3 px-5 py-4 rounded-2xl shadow-2xl border min-w-[320px] max-w-md"
                :class="{
                    'bg-white dark:bg-slate-800 border-red-100 dark:border-red-900/30 text-red-600': toast.type === 'error',
                    'bg-white dark:bg-slate-800 border-blue-100 dark:border-blue-900/30 text-primary': toast.type === 'success',
                    'bg-white dark:bg-slate-800 border-amber-100 dark:border-amber-900/30 text-amber-600': toast.type === 'warning',
                    'bg-white dark:bg-slate-800 border-slate-100 dark:border-slate-800 text-slate-600': toast.type === 'info'
                }">
                <div class="flex-shrink-0">
                    <span class="material-symbols-outlined text-[24px]"
                        x-text="toast.type === 'error' ? 'error' : (toast.type === 'success' ? 'check_circle' : (toast.type === 'warning' ? 'warning' : 'info'))"></span>
                </div>
                <div class="flex-grow">
                    <p class="text-[14px] font-bold leading-tight" x-text="toast.message"></p>
                </div>
                <button @click="toasts = toasts.filter(t => t.id !== toast.id)"
                    class="flex-shrink-0 text-slate-400 hover:text-slate-600 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        </template>
    </div>
</body>

</html>