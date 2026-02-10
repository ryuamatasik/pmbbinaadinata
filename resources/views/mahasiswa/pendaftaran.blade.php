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

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('registrationForm', () => ({
            step1Complete: false,
            step2Complete: false,
            step3Complete: false,
            step2Complete: false,
            step3Complete: false,
            step4Complete: false,
            isLoading: false,

            init() {
                this.checkCompletion();
            },

            checkCompletion() {
                // Simple logic to check if inputs are filled
                // In a real app, you might want more robust validation or bind to specific fields
                // This is a placeholder to prevent errors and provide basic visual feedback
                this.step1Complete = (document.querySelector('input[name="gelombang"]:checked') && document.querySelectorAll('input[type="checkbox"]:checked').length >= 2);
                // Add more checks as needed or leave as manual/server-side validation reliance for now
            },

            checkUnsaved(e, url) {
                // Optional: Confirm navigation if form is dirty
            }
        }));
    });
</script>
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
                    <div class="flex items-center gap-6">
                        <nav class="flex items-center">
                            <a class="text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors"
                                href="{{ url('/') }}" @click="checkUnsaved($event, '{{ url('/') }}')">Beranda</a>
                        </nav>
                        <div class="flex">
                            <a href="{{ route('login') }}" @click="checkUnsaved($event, '{{ route('login') }}')"
                                class="flex items-center justify-center rounded-xl h-10 px-5 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 text-slate-700 dark:text-white text-sm font-bold hover:bg-slate-50 dark:hover:bg-slate-600 transition-all">
                                Masuk
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form id="pendaftaran-form" action="{{ route('mahasiswa.store') }}" method="POST" class="flex flex-col grow"
            enctype="multipart/form-data" @submit="isLoading = true">
            @csrf
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
                            type="submit" name="action" value="draft">
                            <span class="material-symbols-outlined text-[20px]">save</span>
                            <span>Simpan Draf</span>
                        </button>
                        <button
                            class="flex items-center justify-center gap-2 h-14 px-10 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:scale-[1.02] hover:-translate-y-0.5 active:scale-[0.98] transition-all transform w-full md:w-auto disabled:opacity-70 disabled:cursor-not-allowed disabled:transform-none"
                            type="submit" name="action" value="submit" :disabled="isLoading">
                            <span x-show="!isLoading" class="flex items-center gap-2">
                                <span>Lanjut</span>
                                <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                            </span>
                            <span x-show="isLoading" class="flex items-center gap-2" style="display: none;">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memproses...
                            </span>
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
                    <div class="flex items-center justify-between px-6 py-5 border-b border-[#dbdfe6] dark:border-gray-700">
                        <div class="flex flex-col">
                            <h2 class="text-[#111318] dark:text-white text-[20px] font-bold leading-tight tracking-[-0.015em]">
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
                            <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Silakan pilih program studi utama
                                dan cadangan Anda</p>
                        </div>
                        <div class="flex flex-col w-full">
                            <p class="text-[#111318] dark:text-gray-200 text-base font-semibold leading-normal pb-3">
                                Gelombang</p>
                            <div class="flex flex-wrap gap-6">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input class="custom-radio" name="gelombang" type="radio" value="1"
                                        {{ old('gelombang') == '1' ? 'checked' : '' }} />
                                    <span
                                        class="text-base text-[#111318] dark:text-gray-300 group-hover:text-primary transition-colors">Gelombang
                                        I</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input class="custom-radio" name="gelombang" type="radio" value="2"
                                        {{ old('gelombang') == '2' ? 'checked' : '' }} />
                                    <span
                                        class="text-base text-[#111318] dark:text-gray-300 group-hover:text-primary transition-colors">Gelombang
                                        II</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input class="custom-radio" name="gelombang" type="radio" value="3"
                                        {{ old('gelombang') == '3' ? 'checked' : '' }} />
                                    <span
                                        class="text-base text-[#111318] dark:text-gray-300 group-hover:text-primary transition-colors">Gelombang
                                        III</span>
                                </label>
                            </div>
                        </div>
                        <div class="flex flex-col w-full gap-5">
                            <div class="flex items-center justify-between">
                                <p class="text-[#111318] dark:text-gray-200 text-base font-semibold leading-normal">Pilihan
                                    Program Studi</p>
                                <div class="flex flex-col items-end">
                                    <span id="prodi-counter-new"
                                        class="text-xs font-medium px-2 py-1 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 rounded-md">0/2
                                        terpilih</span>
                                </div>
                            </div>
                            <p id="prodi-error-new" class="text-xs text-red-500 dark:text-red-400 -mt-4 font-medium">*Wajib
                                memilih minimal 2 program studi</p>

                            <!-- Hidden input for backend compatibility -->
                            <input type="hidden" name="pilihan_prodi" id="real-pilihan-prodi-new">

                            <div class="grid grid-cols-1 gap-4">
                                <div class="flex flex-col gap-2">
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Pilihan
                                        Utama</label>
                                    <select class="form-select w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-[#1a202c] focus:border-primary focus:ring-primary text-sm h-11 transition-all" id="select-utama">
                                        <option disabled="" selected="" value="">Pilih Program Studi Utama</option>
                                        <option value="Sistem Informasi S1">Sistem Informasi S1</option>
                                        <option value="Sistem Komputer S1">Sistem Komputer S1</option>
                                        <option value="Bisnis Digital S1">Bisnis Digital S1</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Pilihan
                                        Cadangan</label>
                                    <select class="form-select w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-[#1a202c] focus:border-primary focus:ring-primary text-sm h-11 transition-all" id="select-cadangan">
                                        <option disabled="" selected="" value="">Pilih Program Studi Cadangan</option>
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
                                Pastikan pilihan program studi sudah sesuai dengan minat Anda. Pilihan tidak dapat diubah
                                setelah pembayaran formulir dikonfirmasi.
                            </p>
                        </div>
                    </div>
                    <div
                        class="px-8 py-5 bg-[#fcfcfd] dark:bg-[#1e2532] border-t border-[#dbdfe6] dark:border-gray-700 flex flex-col-reverse sm:flex-row gap-3 justify-end items-center">
                        <label for="modal-1"
                            class="flex w-full sm:w-auto min-w-[100px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-6 bg-transparent hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-600 dark:text-gray-300 text-sm font-bold leading-normal tracking-[0.015em] transition-colors">
                            <span class="truncate">Batal</span>
                        </label>
                        <label for="modal-1" id="btn-save-prodi-new"
                            class="bg-gray-200 dark:bg-gray-700 text-gray-400 dark:text-gray-500 cursor-not-allowed pointer-events-none flex w-full sm:w-auto min-w-[180px] items-center justify-center overflow-hidden rounded-lg h-10 px-8 text-sm font-bold leading-normal tracking-[0.015em] transition-all">
                            <span class="truncate">Simpan &amp; Lanjutkan</span>
                        </label>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const selectUtama = document.getElementById('select-utama');
                    const selectCadangan = document.getElementById('select-cadangan');
                    const realInputNew = document.getElementById('real-pilihan-prodi-new');
                    const counterNew = document.getElementById('prodi-counter-new');
                    const errorMsgNew = document.getElementById('prodi-error-new');
                    const saveBtnNew = document.getElementById('btn-save-prodi-new');

                    function updateStateNew() {
                        const val1 = selectUtama.value;
                        const val2 = selectCadangan.value;
                        let count = 0;
                        if (val1) count++;
                        if (val2) count++;

                        counterNew.textContent = `${count}/2 terpilih`;

                        // Combine values for backend
                        // Format: "Utama: [Val], Cadangan: [Val]" or simple comma separated
                        let combined = [];
                        if (val1) combined.push(val1);
                        if (val2) combined.push(val2);
                        realInputNew.value = combined.join(', ');

                        // Validation: Both must be selected and different (optional logic, but basic is just count)
                        const isValid = count === 2 && (val1 !== val2);

                        if (isValid) {
                            errorMsgNew.style.display = 'none';
                            counterNew.classList.remove('text-red-500'); // Remove error color if applied

                            // Enable Button
                            saveBtnNew.classList.remove('bg-gray-200', 'dark:bg-gray-700', 'text-gray-400', 'dark:text-gray-500', 'cursor-not-allowed', 'pointer-events-none');
                            saveBtnNew.classList.add('bg-primary', 'hover:bg-blue-700', 'text-white', 'shadow-md', 'cursor-pointer');
                        } else {
                            errorMsgNew.style.display = 'block';
                            if (val1 && val2 && val1 === val2) {
                                errorMsgNew.textContent = '*Pilihan Utama dan Cadangan tidak boleh sama';
                            } else {
                                errorMsgNew.textContent = '*Wajib memilih minimal 2 program studi';
                            }
                            
                            // Disable Button
                            saveBtnNew.classList.add('bg-gray-200', 'dark:bg-gray-700', 'text-gray-400', 'dark:text-gray-500', 'cursor-not-allowed', 'pointer-events-none');
                            saveBtnNew.classList.remove('bg-primary', 'hover:bg-blue-700', 'text-white', 'shadow-md', 'cursor-pointer');
                        }
                    }

                    if(selectUtama && selectCadangan) {
                        selectUtama.addEventListener('change', updateStateNew);
                        selectCadangan.addEventListener('change', updateStateNew);
                    }
                });
            </script>

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
                            <input name="nik" value="{{ old('nik') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                type="text" placeholder="16 digit NIK" required />
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">NISN</label>
                            <input name="nisn" value="{{ old('nisn') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                type="text" placeholder="Optional" />
                        </div>

                        <!-- Row 2: Nama & Jenis Kelamin -->
                        <div class="col-span-12 md:col-span-8 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <input name="nama_lengkap" value="{{ old('nama_lengkap', Auth::user()->name ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                type="text" placeholder="Sesuai ijazah" required />
                        </div>
                        <div class="col-span-12 md:col-span-4 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Jenis Kelamin <span
                                    class="text-red-500">*</span></label>
                            <select name="jenis_kelamin"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                                <option value="" disabled>Pilih</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- Row 3: Tempat & Tanggal Lahir -->
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Tempat Lahir <span
                                    class="text-red-500">*</span></label>
                            <input name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                type="text" />
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Tanggal Lahir <span
                                    class="text-red-500">*</span></label>
                            <input name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                type="date" />
                        </div>

                        <!-- Row 4: Agama & Physical -->
                        <div class="col-span-12 md:col-span-4 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Agama <span
                                    class="text-red-500">*</span></label>
                            <select name="agama"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu
                                </option>
                            </select>
                        </div>
                        <div class="col-span-6 md:col-span-4 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Tinggi (cm)</label>
                            <input name="tinggi_badan" value="{{ old('tinggi_badan') }}" type="number"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm" />
                        </div>
                        <div class="col-span-6 md:col-span-4 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Berat (kg)</label>
                            <input name="berat_badan" value="{{ old('berat_badan') }}" type="number"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm" />
                        </div>

                        <!-- Row 5: Alamat -->
                        <div class="col-span-12 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <h4 class="font-bold text-primary text-sm uppercase tracking-wide">Alamat Lengkap</h4>
                        </div>
                        <div class="col-span-12 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Jalan / Dusun / Lingkungan
                                <span class="text-red-500">*</span></label>
                            <input name="alamat_lengkap" value="{{ old('alamat_lengkap') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm text-slate-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                type="text" />
                        </div>
                        <div class="col-span-6 md:col-span-3 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">RT</label>
                            <input name="rt" value="{{ old('rt') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                type="number" />
                        </div>
                        <div class="col-span-6 md:col-span-3 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">RW</label>
                            <input name="rw" value="{{ old('rw') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                type="number" />
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Kelurahan/Desa <span
                                    class="text-red-500">*</span></label>
                            <input name="kelurahan" value="{{ old('kelurahan') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                type="text" />
                        </div>
                        <div class="col-span-12 md:col-span-4 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Kecamatan <span
                                    class="text-red-500">*</span></label>
                            <input name="kecamatan" value="{{ old('kecamatan') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                type="text" />
                        </div>
                        <div class="col-span-12 md:col-span-4 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Kabupaten/Kota <span
                                    class="text-red-500">*</span></label>
                            <input name="kabupaten" value="{{ old('kabupaten') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                type="text" />
                        </div>
                        <div class="col-span-12 md:col-span-4 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Provinsi <span
                                    class="text-red-500">*</span></label>
                            <input name="provinsi" value="{{ old('provinsi') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                type="text" />
                        </div>

                        <!-- Row 6: Kontak -->
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Email <span
                                    class="text-red-500">*</span></label>
                            <input name="email" value="{{ old('email', Auth::user()->email ?? '') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                type="email" />
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">No HP / WA <span
                                    class="text-red-500">*</span></label>
                            <input name="no_hp" value="{{ old('no_hp') }}"
                                class="w-full h-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-3 text-sm"
                                type="tel" />
                        </div>
                    </div>
                    <div
                        class="p-6 border-t border-slate-100 dark:border-slate-800 flex justify-end gap-3 bg-slate-50 dark:bg-black/20 rounded-b-2xl">
                        <label for="modal-2"
                            class="px-6 py-3 rounded-xl border border-slate-200 dark:border-slate-600 font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 cursor-pointer transition-colors">Batal</label>
                        <label for="modal-2"
                            class="flex items-center gap-2 px-6 py-3 rounded-xl bg-primary text-white font-bold shadow-lg shadow-blue-500/20 hover:bg-primary-dark cursor-pointer transition-colors">
                            <span>Simpan &amp; Lanjutkan</span>
                            <span class="material-symbols-outlined text-sm">check</span>
                        </label>
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
                            <input name="nama_sekolah" value="{{ old('nama_sekolah') }}"
                                class="w-full h-12 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                type="text" placeholder="Contoh: SMA Negeri 1 Jakarta" />
                        </div>

                        <!-- Row 2: Jurusan & Nilai -->
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Jurusan / Program</label>
                            <select name="jurusan_sekolah"
                                class="w-full h-12 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">
                                <option value="" disabled selected>Pilih Jurusan</option>
                                <option value="IPA" {{ old('jurusan_sekolah') == 'IPA' ? 'selected' : '' }}>IPA</option>
                                <option value="IPS" {{ old('jurusan_sekolah') == 'IPS' ? 'selected' : '' }}>IPS</option>
                                <option value="Bahasa" {{ old('jurusan_sekolah') == 'Bahasa' ? 'selected' : '' }}>Bahasa
                                </option>
                                <option value="Kejuruan" {{ old('jurusan_sekolah') == 'Kejuruan' ? 'selected' : '' }}>
                                    SMK/Kejuruan</option>
                                <option value="Lainnya" {{ old('jurusan_sekolah') == 'Lainnya' ? 'selected' : '' }}>
                                    Lainnya</option>
                            </select>
                        </div>
                        <div class="col-span-12 md:col-span-6 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Nilai UN / Rata-rata
                                Ijazah</label>
                            <input name="nilai_rata_rata" value="{{ old('nilai_rata_rata') }}"
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
                                    <option value="{{ $i }}" {{ old('tahun_lulus') == $i ? 'selected' : '' }}>{{ $i }}
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
                                placeholder="Tuliskan alamat lengkap sekolah (Jalan, No, Kelurahan, Kecamatan, Kota, Provinsi)">{{ old('alamat_sekolah') }}</textarea>
                        </div>
                    </div>
                    <div
                        class="p-6 border-t border-slate-100 dark:border-slate-800 flex justify-end gap-3 bg-slate-50 dark:bg-black/20 rounded-b-2xl">
                        <label for="modal-3"
                            class="px-6 py-3 rounded-xl border border-slate-200 dark:border-slate-600 font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 cursor-pointer transition-colors">Batal</label>
                        <label for="modal-3"
                            class="flex items-center gap-2 px-6 py-3 rounded-xl bg-primary text-white font-bold shadow-lg shadow-blue-500/20 hover:bg-primary-dark cursor-pointer transition-colors">
                            <span>Simpan &amp; Lanjutkan</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </label>
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
                            <input name="asal_pt" value="{{ old('asal_pt') }}"
                                class="w-full h-12 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                type="text" placeholder="Contoh: Universitas Indonesia" />
                        </div>

                        <!-- Asal Program Studi -->
                        <div class="col-span-12 flex flex-col gap-2">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Asal Program Studi</label>
                            <input name="asal_prodi" value="{{ old('asal_prodi') }}"
                                class="w-full h-12 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 px-4 text-slate-900 dark:text-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                type="text" placeholder="Contoh: Teknik Informatika" />
                        </div>

                        <!-- Status Terakreditasi -->
                        <div class="col-span-12 flex flex-col gap-3">
                            <label class="text-sm font-bold text-slate-900 dark:text-white">Status Terakreditasi</label>
                            <div class="flex flex-wrap gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="akreditasi_asal" value="A" class="peer sr-only" {{ old('akreditasi_asal') == 'A' ? 'checked' : '' }}>
                                    <div
                                        class="px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 peer-checked:border-primary peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 peer-checked:text-primary font-bold text-sm transition-all hover:bg-gray-50 dark:hover:bg-slate-700">
                                        Terakreditasi A
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="akreditasi_asal" value="B" class="peer sr-only" {{ old('akreditasi_asal') == 'B' ? 'checked' : '' }}>
                                    <div
                                        class="px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 peer-checked:border-primary peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 peer-checked:text-primary font-bold text-sm transition-all hover:bg-gray-50 dark:hover:bg-slate-700">
                                        Terakreditasi B
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="akreditasi_asal" value="C" class="peer sr-only" {{ old('akreditasi_asal') == 'C' ? 'checked' : '' }}>
                                    <div
                                        class="px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-slate-800 peer-checked:border-primary peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 peer-checked:text-primary font-bold text-sm transition-all hover:bg-gray-50 dark:hover:bg-slate-700">
                                        Terakreditasi C
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="akreditasi_asal" value="Belum" class="peer sr-only" {{ old('akreditasi_asal') == 'Belum' ? 'checked' : '' }}>
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
                        <label for="modal-5"
                            class="flex items-center gap-2 px-6 py-3 rounded-xl bg-primary text-white font-bold shadow-lg shadow-blue-500/20 hover:bg-primary-dark cursor-pointer transition-colors">
                            <span>Simpan &amp; Lanjutkan</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </label>
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

                init() {
                    this.checkCompletion();
                },

                checkCompletion() {
                    // Step 1: Program Studi
                    const gelombang = document.querySelector('[name="gelombang"]:checked');
                    const prodi = document.querySelector('[name="pilihan_prodi"]:checked');
                    this.step1Complete = !!(gelombang && prodi);

                    // Step 2: Identitas Diri
                    const step2Fields = ['nik', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama', 'alamat_lengkap', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi', 'email', 'no_hp'];
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
                                    alert('Gagal menyimpan data: ' + (data.message || response.statusText));
                                }).catch(() => {
                                    alert('Gagal menyimpan data (Status: ' + response.status + ')');
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan jaringan/sistem: ' + error.message);
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
</body>

</html>