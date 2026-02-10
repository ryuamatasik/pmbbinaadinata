<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Bina Adinata - Portal Pendaftaran</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&amp;family=Noto+Sans:wght@300..800&amp;display=swap"
        rel="stylesheet" />
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
                        "primary-dark": "#0e45b5",
                        "background-light": "#f6f6f8",
                        "background-dark": "#101622",
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        html {
            scroll-behavior: smooth;
        }
        /* Scroll Reveal Animation */
        .reveal {
            opacity: 0;
            transform: translateY(40px) scale(0.95);
            filter: blur(10px);
            transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0) scale(1);
            filter: blur(0);
        }

        /* Staggered Card Reveal */
        .reveal-card {
            opacity: 0;
            transform: translateY(30px) scale(0.9);
            filter: blur(5px);
            transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .reveal-card.active {
            opacity: 1;
            transform: translateY(0) scale(1);
            filter: blur(0);
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const reveals = document.querySelectorAll('.reveal, .reveal-card');

            function checkScroll() {
                const triggerBottom = window.innerHeight * 0.85;

                reveals.forEach(reveal => {
                    const boxTop = reveal.getBoundingClientRect().top;

                    if (boxTop < triggerBottom) {
                        reveal.classList.add('active');
                    }
                });
            }

            window.addEventListener('scroll', checkScroll);
            // Initial check
            checkScroll();
        });
    </script>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-[#111318] dark:text-white overflow-x-hidden">
    <div class="relative flex min-h-screen flex-col w-full">
        <header
            class="sticky top-0 z-50 bg-white/80 dark:bg-background-dark/80 backdrop-blur-md border-b border-[#f0f2f4] dark:border-gray-800 w-full">
            <div class="px-4 md:px-10 py-3 flex items-center justify-between max-w-[1440px] mx-auto w-full">
                <div class="flex items-center gap-4 text-[#111318] dark:text-white">
                    <div class="size-10 flex items-center justify-center">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo"
                            class="w-full h-full object-contain rounded-full">
                    </div>
                    <h2 class="text-[#111318] dark:text-white text-xl font-bold leading-tight tracking-[-0.015em]">
                        Bina Adinata</h2>
                </div>
                <nav class="hidden lg:flex flex-1 justify-end gap-8 items-center">
                    <div class="flex items-center gap-6">
                        <a class="text-[#111318] dark:text-white hover:text-primary text-sm font-semibold leading-normal transition-colors"
                            href="#beranda">Beranda</a>
                        <a class="text-[#111318] dark:text-white hover:text-primary text-sm font-semibold leading-normal transition-colors"
                            href="#alur-pendaftaran">Alur Pendaftaran</a>
                        <a class="text-[#111318] dark:text-white hover:text-primary text-sm font-semibold leading-normal transition-colors"
                            href="#jurusan-unggulan">Jurusan Unggulan</a>
                        <a class="text-[#111318] dark:text-white hover:text-primary text-sm font-semibold leading-normal transition-colors"
                            href="#biaya-studi">Biaya Studi</a>
                        <a class="text-[#111318] dark:text-white hover:text-primary text-sm font-semibold leading-normal transition-colors"
                            href="#tentang-kami">Tentang Kami</a>
                    </div>
                    <div class="flex gap-2 ml-4">
                        <a href="{{ route('login') }}"
                            class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary hover:bg-primary-dark transition-colors text-white text-sm font-bold leading-normal tracking-[0.015em]">
                            <span class="truncate">Masuk</span>
                        </a>
                        <a href="{{ route('login') }}"
                            class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#f0f2f4] hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 transition-colors text-[#111318] dark:text-white text-sm font-bold leading-normal tracking-[0.015em]">
                            <span class="truncate">Daftar</span>
                        </a>
                    </div>
                </nav>
                <button class="lg:hidden text-[#111318] dark:text-white">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </header>
        <!-- Mobile Menu Container -->
        <div id="mobile-menu"
            class="fixed inset-0 z-40 bg-white/95 dark:bg-[#0f172a]/95 backdrop-blur-xl pt-24 px-6 lg:hidden opacity-0 pointer-events-none transition-all duration-300 ease-out flex flex-col items-center justify-center">
            <!-- Close Button (Inside Menu) -->
            <button onclick="toggleMenu()"
                class="absolute top-6 right-6 p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                <span class="material-symbols-outlined text-3xl text-gray-800 dark:text-gray-200">close</span>
            </button>

            <div class="flex flex-col gap-8 w-full max-w-sm text-center">
                <nav class="flex flex-col gap-6 text-2xl font-bold">
                    <a class="menu-item opacity-0 translate-y-4 transition-all duration-500 ease-out text-[#111318] dark:text-white hover:text-primary"
                        href="#beranda" onclick="toggleMenu()" style="transition-delay: 100ms;">Beranda</a>
                    <a class="menu-item opacity-0 translate-y-4 transition-all duration-500 ease-out text-[#111318] dark:text-white hover:text-primary"
                        href="#alur-pendaftaran" onclick="toggleMenu()" style="transition-delay: 200ms;">Alur
                        Pendaftaran</a>
                    <a class="menu-item opacity-0 translate-y-4 transition-all duration-500 ease-out text-[#111318] dark:text-white hover:text-primary"
                        href="#jurusan-unggulan" onclick="toggleMenu()" style="transition-delay: 300ms;">Jurusan
                        Unggulan</a>
                    <a class="menu-item opacity-0 translate-y-4 transition-all duration-500 ease-out text-[#111318] dark:text-white hover:text-primary"
                        href="#biaya-studi" onclick="toggleMenu()" style="transition-delay: 400ms;">Biaya Studi</a>
                    <a class="menu-item opacity-0 translate-y-4 transition-all duration-500 ease-out text-[#111318] dark:text-white hover:text-primary"
                        href="#tentang-kami" onclick="toggleMenu()" style="transition-delay: 500ms;">Tentang Kami</a>
                </nav>

                <div class="flex flex-col gap-4 mt-8 menu-item opacity-0 translate-y-4 transition-all duration-500 ease-out"
                    style="transition-delay: 600ms;">
                    <a href="{{ route('login') }}"
                        class="flex w-full items-center justify-center rounded-xl h-14 bg-primary text-white font-bold text-lg shadow-lg hover:bg-primary-dark hover:scale-[1.02] active:scale-[0.98] transition-all">
                        Masuk Akun
                    </a>
                    <a href="{{ route('login') }}"
                        class="flex w-full items-center justify-center rounded-xl h-14 bg-gray-100 dark:bg-gray-800 text-[#111318] dark:text-white font-bold text-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                        Daftar Baru
                    </a>
                </div>
            </div>
        </div>
        <script>
            const menuBtn = document.querySelector('button.lg\\:hidden');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuItems = document.querySelectorAll('.menu-item');
            let isMenuOpen = false;

            function toggleMenu() {
                isMenuOpen = !isMenuOpen;
                // Only toggle icon on the navbar button if it exists
                const icon = menuBtn ? menuBtn.querySelector('span') : null;

                if (isMenuOpen) {
                    // Open Menu
                    mobileMenu.classList.remove('pointer-events-none', 'opacity-0');
                    if (icon) icon.textContent = 'close';
                    document.body.style.overflow = 'hidden';

                    // Stagger Animation In
                    setTimeout(() => {
                        menuItems.forEach(item => {
                            item.classList.remove('opacity-0', 'translate-y-4');
                        });
                    }, 50);

                } else {
                    // Close Menu
                    mobileMenu.classList.add('opacity-0', 'pointer-events-none');
                    if (icon) icon.textContent = 'menu';
                    document.body.style.overflow = '';

                    // Reset Animation Out
                    menuItems.forEach(item => {
                        item.classList.add('opacity-0', 'translate-y-4');
                    });
                }
            }

            if (menuBtn) {
                menuBtn.addEventListener('click', toggleMenu);
            }
        </script>
        <main class="flex flex-col flex-grow items-center w-full">
            <section class="w-full max-w-[1280px] px-4 md:px-10 py-5" id="beranda">
                <div class="@container">
                    <div class="@[480px]:p-4">
                        <div class="flex min-h-[560px] flex-col gap-6 bg-cover bg-bottom bg-no-repeat @[480px]:gap-8 rounded-xl items-center justify-center p-8 relative overflow-hidden shadow-lg"
                            style='background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.7)), url("{{ asset("images/kampus_bg_v3.jpg") }}");'>
                            <div class="flex flex-col gap-4 text-center z-10 max-w-[800px] reveal">
                                <h1
                                    class="text-white text-4xl md:text-6xl font-black leading-tight tracking-[-0.033em]">
                                    Masa Depanmu Dimulai Di Sini
                                </h1>
                                <h2 class="text-gray-200 text-lg md:text-xl font-normal leading-relaxed">
                                    Selamat datang di Portal Penerimaan Mahasiswa Baru. Bergabunglah dengan komunitas
                                    akademik kami yang inovatif untuk meraih cita-citamu.
                                </h2>
                            </div>
                            <div class="flex flex-wrap gap-4 justify-center z-10 mt-4 reveal">
                                <a href="{{ route('login') }}"
                                    class="flex min-w-[160px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary hover:bg-primary-dark transition-all text-white text-base font-bold leading-normal tracking-[0.015em] shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <span class="truncate">Daftar Sekarang</span>
                                </a>
                                <a href="{{ route('login') }}"
                                    class="flex min-w-[160px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/30 transition-all text-white text-base font-bold leading-normal tracking-[0.015em]">
                                    <span class="truncate">Masuk Akun</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="w-full max-w-[1280px] px-4 md:px-10 py-24 flex flex-col items-center" id="alur-pendaftaran">
                <div class="w-full text-center mb-16 reveal">
                    <span class="text-primary font-bold tracking-wider uppercase text-sm mb-2 block">Proses
                        Pendaftaran</span>
                    <h2
                        class="text-[#111318] dark:text-white text-3xl md:text-4xl font-bold leading-tight tracking-[-0.015em]">
                        Langkah Bergabung Dengan Kami</h2>
                    <p class="text-gray-500 dark:text-gray-400 mt-2">Sistem pendaftaran terintegrasi yang memudahkan
                        calon mahasiswa</p>
                </div>
                <div class="w-full relative py-8 reveal">
                    <div
                        class="hidden lg:block absolute top-[4.5rem] left-[10%] right-[10%] h-1 bg-gray-200 dark:bg-gray-800 z-0">
                        <div class="h-full bg-primary w-1/3 rounded-full"></div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 relative z-10">
                        <div class="flex flex-col items-center text-center group reveal-card"
                            style="transition-delay: 100ms;">
                            <div class="relative mb-8">
                                <div
                                    class="w-20 h-20 rounded-2xl bg-primary text-white flex items-center justify-center shadow-[0_10px_30px_rgba(19,91,236,0.3)] transition-transform duration-300 group-hover:scale-110">
                                    <span class="material-symbols-outlined text-[36px]">person_add</span>
                                </div>
                                <div
                                    class="absolute -bottom-2 -right-2 w-8 h-8 rounded-full bg-white dark:bg-gray-800 border-4 border-background-light dark:border-background-dark flex items-center justify-center text-primary font-black text-xs">
                                    1</div>
                            </div>
                            <div class="flex flex-col gap-3">
                                <h3 class="text-[#111318] dark:text-white text-xl font-bold">Buat Akun</h3>
                                <p class="text-[#616f89] dark:text-gray-400 text-sm font-normal leading-relaxed">
                                    Daftarkan email dan nomor telepon aktif Anda untuk mendapatkan akses ke dashboard
                                    pendaftaran.</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-center text-center group reveal-card"
                            style="transition-delay: 300ms;">
                            <div class="relative mb-8">
                                <div
                                    class="w-20 h-20 rounded-2xl bg-white dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-700 text-primary flex items-center justify-center shadow-sm transition-all duration-300 group-hover:border-primary group-hover:bg-primary/5 group-hover:scale-110">
                                    <span class="material-symbols-outlined text-[36px]">edit_document</span>
                                </div>
                                <div
                                    class="absolute -bottom-2 -right-2 w-8 h-8 rounded-full bg-white dark:bg-gray-800 border-4 border-background-light dark:border-background-dark flex items-center justify-center text-gray-400 font-black text-xs group-hover:text-primary transition-colors">
                                    2</div>
                            </div>
                            <div class="flex flex-col gap-3">
                                <h3 class="text-[#111318] dark:text-white text-xl font-bold">Lengkapi Biodata</h3>
                                <p class="text-[#616f89] dark:text-gray-400 text-sm font-normal leading-relaxed">Isi
                                    formulir data diri, unggah rapor/ijazah, dan pilih program studi yang sesuai dengan
                                    minat Anda.</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-center text-center group reveal-card"
                            style="transition-delay: 500ms;">
                            <div class="relative mb-8">
                                <div
                                    class="w-20 h-20 rounded-2xl bg-white dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-700 text-primary flex items-center justify-center shadow-sm transition-all duration-300 group-hover:border-primary group-hover:bg-primary/5 group-hover:scale-110">
                                    <span class="material-symbols-outlined text-[36px]">quiz</span>
                                </div>
                                <div
                                    class="absolute -bottom-2 -right-2 w-8 h-8 rounded-full bg-white dark:bg-gray-800 border-4 border-background-light dark:border-background-dark flex items-center justify-center text-gray-400 font-black text-xs group-hover:text-primary transition-colors">
                                    3</div>
                            </div>
                            <div class="flex flex-col gap-3">
                                <h3 class="text-[#111318] dark:text-white text-xl font-bold">Ujian &amp; Seleksi</h3>
                                <p class="text-[#616f89] dark:text-gray-400 text-sm font-normal leading-relaxed">Ikuti
                                    Computer Based Test (CBT) atau wawancara secara daring sesuai jadwal yang
                                    ditentukan.</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-center text-center group reveal-card"
                            style="transition-delay: 700ms;">
                            <div class="relative mb-8">
                                <div
                                    class="w-20 h-20 rounded-2xl bg-white dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-700 text-primary flex items-center justify-center shadow-sm transition-all duration-300 group-hover:border-primary group-hover:bg-primary/5 group-hover:scale-110">
                                    <span class="material-symbols-outlined text-[36px]">verified_user</span>
                                </div>
                                <div
                                    class="absolute -bottom-2 -right-2 w-8 h-8 rounded-full bg-white dark:bg-gray-800 border-4 border-background-light dark:border-background-dark flex items-center justify-center text-gray-400 font-black text-xs group-hover:text-primary transition-colors">
                                    4</div>
                            </div>
                            <div class="flex flex-col gap-3">
                                <h3 class="text-[#111318] dark:text-white text-xl font-bold">Pengumuman</h3>
                                <p class="text-[#616f89] dark:text-gray-400 text-sm font-normal leading-relaxed">Hasil
                                    seleksi dapat dilihat langsung melalui portal. Lakukan daftar ulang untuk
                                    mengamankan kursi Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="w-full bg-white dark:bg-gray-900 border-t border-b border-gray-100 dark:border-gray-800"
                id="jurusan-unggulan">
                <div class="max-w-[1280px] mx-auto px-4 md:px-10 py-24 flex flex-col items-center">
                    <div class="w-full text-center mb-10">
                        <span class="text-primary font-bold tracking-wider uppercase text-sm mb-2 block">Pilihan
                            Favorit</span>
                        <h2
                            class="text-[#111318] dark:text-white text-3xl md:text-4xl font-bold leading-tight tracking-[-0.015em]">
                            Jurusan Unggulan</h2>
                        <p class="text-gray-500 dark:text-gray-400 mt-2">Temukan program studi terbaik yang paling
                            diminati</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full">
                        <div class="flex flex-col bg-background-light dark:bg-gray-800 rounded-xl overflow-hidden group hover:shadow-lg transition-all duration-300 reveal-card"
                            style="transition-delay: 100ms;">
                            <div class="h-48 bg-gray-200 dark:bg-gray-700 relative overflow-hidden">
                                <div class="absolute inset-0 flex items-center justify-center bg-primary/5">
                                    <span
                                        class="material-symbols-outlined text-primary text-6xl opacity-50 group-hover:scale-110 transition-transform duration-300">dns</span>
                                </div>
                            </div>
                            <div class="p-6 flex flex-col gap-3">
                                <h3 class="text-xl font-bold text-[#111318] dark:text-white">Sistem Informasi</h3>
                                <p class="text-[#616f89] dark:text-gray-400 text-sm leading-relaxed">
                                    Mengintegrasikan teknologi informasi dengan proses bisnis untuk meningkatkan
                                    efisiensi dan inovasi organisasi.
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col bg-background-light dark:bg-gray-800 rounded-xl overflow-hidden group hover:shadow-lg transition-all duration-300 reveal-card"
                            style="transition-delay: 300ms;">
                            <div class="h-48 bg-gray-200 dark:bg-gray-700 relative overflow-hidden">
                                <div class="absolute inset-0 flex items-center justify-center bg-primary/5">
                                    <span
                                        class="material-symbols-outlined text-primary text-6xl opacity-50 group-hover:scale-110 transition-transform duration-300">memory</span>
                                </div>
                            </div>
                            <div class="p-6 flex flex-col gap-3">
                                <h3 class="text-xl font-bold text-[#111318] dark:text-white">Sistem Komputer</h3>
                                <p class="text-[#616f89] dark:text-gray-400 text-sm leading-relaxed">
                                    Fokus pada rekayasa perangkat keras (hardware), jaringan komputer, dan sistem
                                    tertanam (embedded systems).
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col bg-background-light dark:bg-gray-800 rounded-xl overflow-hidden group hover:shadow-lg transition-all duration-300 reveal-card"
                            style="transition-delay: 500ms;">
                            <div class="h-48 bg-gray-200 dark:bg-gray-700 relative overflow-hidden">
                                <div class="absolute inset-0 flex items-center justify-center bg-primary/5">
                                    <span
                                        class="material-symbols-outlined text-primary text-6xl opacity-50 group-hover:scale-110 transition-transform duration-300">store</span>
                                </div>
                            </div>
                            <div class="p-6 flex flex-col gap-3">
                                <h3 class="text-xl font-bold text-[#111318] dark:text-white">Bisnis Digital</h3>
                                <p class="text-[#616f89] dark:text-gray-400 text-sm leading-relaxed">
                                    Menggabungkan ilmu manajemen bisnis dengan teknologi digital, e-commerce, dan
                                    strategi pemasaran modern.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section
                class="w-full bg-background-light dark:bg-background-dark py-24 px-4 md:px-10 border-b border-[#f0f2f4] dark:border-gray-800"
                id="biaya-studi">
                <div class="max-w-[1280px] mx-auto w-full">
                    <div class="w-full text-center mb-12">
                        <span class="text-primary font-bold tracking-wider uppercase text-sm mb-2 block">Informasi &amp;
                            Biaya</span>
                        <h2
                            class="text-[#111318] dark:text-white text-3xl md:text-4xl font-bold leading-tight tracking-[-0.015em]">
                            Detail Pendaftaran &amp; Biaya Studi</h2>
                        <p class="text-gray-500 dark:text-gray-400 mt-2 text-lg">Transparansi biaya pendidikan dan
                            prosedur pendaftaran yang jelas</p>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start reveal">
                        <div
                            class="lg:col-span-3 bg-white dark:bg-gray-800 rounded-xl border border-[#dbdfe6] dark:border-gray-700 shadow-sm overflow-hidden">
                            <div
                                class="p-6 border-b border-[#dbdfe6] dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-800/50">
                                <h3 class="text-lg font-bold text-[#111318] dark:text-white flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">payments</span>
                                    Estimasi Biaya Pendidikan
                                </h3>
                                <span
                                    class="text-xs font-medium px-2 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 rounded">TA
                                    2024/2025</span>
                            </div>
                            <!-- Desktop Table View -->
                            <div class="hidden md:block overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr
                                            class="text-xs font-bold text-gray-500 uppercase border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">
                                            <th class="p-5 min-w-[150px]">Program Studi</th>
                                            <th class="p-5 min-w-[140px]">Biaya Pendidikan (Est)</th>
                                            <th class="p-5 min-w-[140px]">SPP / Semester</th>
                                            <th class="p-5 text-right">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100 dark:divide-gray-700">
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                            <td class="p-5 font-bold text-[#111318] dark:text-white">Sistem Informasi
                                            </td>
                                            <td class="p-5 text-gray-600 dark:text-gray-400">Rp 5.550.000</td>
                                            <td class="p-5 text-primary font-bold text-base">Rp 3.000.000</td>
                                            <td class="p-5 text-right"><span
                                                    class="text-green-600 dark:text-green-400 font-medium text-xs bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded-full">Dibuka</span>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                            <td class="p-5 font-bold text-[#111318] dark:text-white">Sistem Komputer
                                            </td>
                                            <td class="p-5 text-gray-600 dark:text-gray-400">Rp 5.600.000</td>
                                            <td class="p-5 text-primary font-bold text-base">Rp 3.050.000</td>
                                            <td class="p-5 text-right"><span
                                                    class="text-green-600 dark:text-green-400 font-medium text-xs bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded-full">Dibuka</span>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                            <td class="p-5 font-bold text-[#111318] dark:text-white">Bisnis Digital</td>
                                            <td class="p-5 text-gray-600 dark:text-gray-400">Rp 5.150.000</td>
                                            <td class="p-5 text-primary font-bold text-base">Rp 2.600.000</td>
                                            <td class="p-5 text-right"><span
                                                    class="text-green-600 dark:text-green-400 font-medium text-xs bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded-full">Terbuka</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Mobile Card View -->
                            <div class="md:hidden flex flex-col divide-y divide-gray-100 dark:divide-gray-700">
                                <!-- Card 1 -->
                                <div class="p-5 flex flex-col gap-3">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-primary shrink-0">
                                                <span class="material-symbols-outlined">dns</span>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-[#111318] dark:text-white">Sistem Informasi
                                                </h4>
                                                <span
                                                    class="text-xs font-medium px-2 py-0.5 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 rounded-full mt-1 inline-block">Dibuka</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="grid grid-cols-2 gap-4 mt-2 bg-gray-50 dark:bg-gray-800/50 p-3 rounded-lg">
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase font-bold">Biaya Awal</p>
                                            <p class="text-xs text-gray-700 dark:text-gray-300 font-medium">Rp 5.550.000
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase font-bold">SPP / Semester</p>
                                            <p class="text-sm text-primary font-bold">Rp 3.000.000</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 2 -->
                                <div class="p-5 flex flex-col gap-3">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-primary shrink-0">
                                                <span class="material-symbols-outlined">memory</span>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-[#111318] dark:text-white">Sistem Komputer
                                                </h4>
                                                <span
                                                    class="text-xs font-medium px-2 py-0.5 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 rounded-full mt-1 inline-block">Dibuka</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="grid grid-cols-2 gap-4 mt-2 bg-gray-50 dark:bg-gray-800/50 p-3 rounded-lg">
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase font-bold">Biaya Awal</p>
                                            <p class="text-xs text-gray-700 dark:text-gray-300 font-medium">Rp 5.600.000
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase font-bold">SPP / Semester</p>
                                            <p class="text-sm text-primary font-bold">Rp 3.050.000</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 3 -->
                                <div class="p-5 flex flex-col gap-3">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-primary shrink-0">
                                                <span class="material-symbols-outlined">store</span>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-[#111318] dark:text-white">Bisnis Digital</h4>
                                                <span
                                                    class="text-xs font-medium px-2 py-0.5 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 rounded-full mt-1 inline-block">Terbuka</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="grid grid-cols-2 gap-4 mt-2 bg-gray-50 dark:bg-gray-800/50 p-3 rounded-lg">
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase font-bold">Biaya Awal</p>
                                            <p class="text-xs text-gray-700 dark:text-gray-300 font-medium">Rp 5.150.000
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase font-bold">SPP / Semester</p>
                                            <p class="text-sm text-primary font-bold">Rp 2.600.000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="p-4 bg-yellow-50 dark:bg-yellow-900/10 border-t border-yellow-100 dark:border-yellow-900/20 text-xs text-yellow-800 dark:text-yellow-200 flex gap-2 items-start">
                                <span class="material-symbols-outlined text-sm mt-0.5">info</span>
                                <p>Biaya Uang Pangkal hanya dibayarkan satu kali di awal perkuliahan. UKT (Uang Kuliah
                                    Tunggal) dibayarkan setiap semester dan sudah termasuk biaya praktikum. <br>
                                    <strong>Promo: </strong> Potongan (cashback) SPP sebesar Rp 1.000.000 bagi yang
                                    langsung (1 kali bayar) pembayaran pertama.
                                </p>
                            </div>
                        </div>
                        <div class="lg:col-span-2 flex flex-col gap-6">
                            <div
                                class="bg-white dark:bg-gray-800 rounded-xl border border-[#dbdfe6] dark:border-gray-700 shadow-sm p-6 relative overflow-hidden">
                                <div class="absolute top-0 right-0 w-24 h-24 bg-primary/5 rounded-bl-full -mr-4 -mt-4">
                                </div>
                                <h3
                                    class="text-lg font-bold text-[#111318] dark:text-white mb-6 flex items-center gap-2 relative z-10">
                                    <span class="material-symbols-outlined text-primary">assignment_turned_in</span>
                                    Prosedur Formulir &amp; Daftar
                                </h3>
                                <div class="space-y-6 relative z-10">
                                    <div class="flex gap-4">
                                        <div class="flex-none flex flex-col items-center gap-1">
                                            <div
                                                class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold text-sm shadow-sm">
                                                1</div>
                                            <div class="w-0.5 h-full bg-gray-100 dark:bg-gray-700 rounded-full"></div>
                                        </div>
                                        <div class="pb-2">
                                            <h4 class="font-bold text-[#111318] dark:text-white text-sm">Pembelian
                                                Formulir</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 leading-relaxed">
                                                Calon mahasiswa membayar biaya formulir pendaftaran seharga <span
                                                    class="text-[#111318] dark:text-white font-medium">Rp
                                                    150.000</span>.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex gap-4">
                                        <div class="flex-none flex flex-col items-center gap-1">
                                            <div
                                                class="w-8 h-8 rounded-full bg-white border-2 border-primary text-primary flex items-center justify-center font-bold text-sm">
                                                2</div>
                                            <div class="w-0.5 h-full bg-gray-100 dark:bg-gray-700 rounded-full"></div>
                                        </div>
                                        <div class="pb-2">
                                            <h4 class="font-bold text-[#111318] dark:text-white text-sm">Login &amp; Isi
                                                Data</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 leading-relaxed">
                                                Buat akun baru di portal ini. Lengkapi biodata diri dan pilih
                                                Program Studi yang diminati.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex gap-4">
                                        <div class="flex-none flex flex-col items-center gap-1">
                                            <div
                                                class="w-8 h-8 rounded-full bg-white border-2 border-gray-300 text-gray-400 flex items-center justify-center font-bold text-sm">
                                                3</div>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-[#111318] dark:text-white text-sm">Cetak Kartu
                                                Ujian</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 leading-relaxed">
                                                Setelah data terverifikasi, cetak kartu peserta ujian sebagai bukti
                                                pendaftaran yang sah.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <section class="w-full max-w-[1280px] px-4 md:px-10 py-24" id="tentang-kami">
                <div class="flex flex-col lg:flex-row gap-12 items-start reveal">
                    <div class="lg:w-1/2 flex flex-col gap-6">
                        <span class="text-primary font-bold tracking-wider uppercase text-sm">Tentang Kami</span>
                        <h2 class="text-[#111318] dark:text-white text-3xl md:text-4xl font-bold leading-tight">
                            Membangun Generasi Emas Melalui Pendidikan Berkualitas</h2>
                        <p class="text-[#616f89] dark:text-gray-400 text-lg leading-relaxed">
                            Bina Adinata telah berdiri sejak tahun 2022 dan berkomitmen untuk menjadi pusat
                            keunggulan akademik yang menginspirasi inovasi dan kreativitas. Kami percaya bahwa
                            pendidikan adalah kunci untuk membuka potensi tak terbatas setiap individu.
                        </p>
                        <div class="grid grid-cols-2 gap-6 mt-4">
                            <div class="flex flex-col gap-2">
                                <h4 class="text-3xl font-bold text-primary">10+</h4>
                                <span class="text-sm text-gray-500 font-medium">Tahun Pengalaman</span>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h4 class="text-3xl font-bold text-primary">1k+</h4>
                                <span class="text-sm text-gray-500 font-medium">Alumni Sukses</span>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-1/2 grid gap-6">
                        <div
                            class="bg-white dark:bg-gray-800 p-8 rounded-xl border border-[#dbdfe6] dark:border-gray-700 shadow-sm">
                            <div class="flex items-center gap-4 mb-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined">visibility</span>
                                </div>
                                <h3 class="text-xl font-bold text-[#111318] dark:text-white">Visi</h3>
                            </div>
                            <p class="text-[#616f89] dark:text-gray-400 text-sm leading-relaxed">
                                Perguruan tinggi unggulan dalam bidang teknologi dan bisnis dengan mengembangkan
                                technopreneurship berbasis potensi lokal di tingkat Nasional pada tahun 2026.
                            </p>
                        </div>
                        <div
                            class="bg-white dark:bg-gray-800 p-8 rounded-xl border border-[#dbdfe6] dark:border-gray-700 shadow-sm">
                            <div class="flex items-center gap-4 mb-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400">
                                    <span class="material-symbols-outlined">rocket_launch</span>
                                </div>
                                <h3 class="text-xl font-bold text-[#111318] dark:text-white">Misi</h3>
                            </div>
                            <ul
                                class="text-[#616f89] dark:text-gray-400 text-sm leading-relaxed list-disc list-inside space-y-2">
                                <li>Menyelenggarakan pendidikan dan pembelajaran yang bermoral, unggul dan kompetitif
                                    dengan mengembangkan technopreneurship berbasis potensi lokal Bulukumba.</li>
                                <li>Melaksanakan penelitian dan meningkatkan publikasi bereputasi nasional dan
                                    internasional dalam bidang teknologi dan bisnis yang bermanfaat baik bagi masyarakat
                                    akademis maupun masyarakat secara luas.</li>
                                <li>Melaksanakan pengabdian kepada masyarakat dengan memberdayakan potensi lokal dalam
                                    rangka meningkatkan kesejahteraan masyarakat.</li>
                                <li>Menjalin kerjasama dengan lembaga-lembaga lokal di tingkat Nasional pada tahun 2026
                                    yang berorientasi pada pengembangan bidang teknologi dan bisnis di tingkat lokal,
                                    regional, dan nasional.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer
            class="bg-background-light dark:bg-background-dark border-t border-[#f0f2f4] dark:border-gray-800 pt-16 pb-8">
            <div class="max-w-[1280px] mx-auto px-4 md:px-10 flex flex-col gap-10">
                <div class="flex flex-col md:flex-row justify-between gap-10">
                    <div class="flex flex-col gap-4 max-w-[300px]">
                        <div class="flex items-center gap-2 text-[#111318] dark:text-white">
                            <div class="size-6 flex items-center justify-center overflow-hidden rounded-full">
                                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-full h-full object-cover">
                            </div>
                            <h3 class="text-lg font-bold">Bina Adinata</h3>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                            Mewujudkan pendidikan berkualitas untuk generasi masa depan yang cerdas dan berkarakter.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-10 md:gap-20">
                        <div class="flex flex-col gap-4">
                            <h4 class="font-bold text-[#111318] dark:text-white">Navigasi</h4>
                            <div class="flex flex-col gap-2">
                                <a class="text-sm text-gray-500 hover:text-primary transition-colors"
                                    href="#beranda">Beranda</a>
                                <a class="text-sm text-gray-500 hover:text-primary transition-colors"
                                    href="#alur-pendaftaran">Alur Pendaftaran</a>
                                <a class="text-sm text-gray-500 hover:text-primary transition-colors"
                                    href="#jurusan-unggulan">Jurusan Unggulan</a>
                                <a class="text-sm text-gray-500 hover:text-primary transition-colors"
                                    href="#biaya-studi">Biaya Studi</a>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4">
                            <h4 class="font-bold text-[#111318] dark:text-white">Bantuan</h4>
                            <div class="flex flex-col gap-2">
                                <a class="text-sm text-gray-500 hover:text-primary transition-colors"
                                    href="#">Panduan</a>
                                <a class="text-sm text-gray-500 hover:text-primary transition-colors" href="#">FAQ</a>
                                <a class="text-sm text-gray-500 hover:text-primary transition-colors" href="#">Hubungi
                                    Kami</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="border-t border-gray-200 dark:border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-400">&copy; 2026 Bina Adinata. All rights reserved.</p>
                    <div class="flex gap-4">
                        <a class="text-gray-400 hover:text-primary transition-colors" href="#">
                            <span class="text-sm font-medium">Privacy Policy</span>
                        </a>
                        <a class="text-gray-400 hover:text-primary transition-colors" href="#">
                            <span class="text-sm font-medium">Terms of Service</span>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</body>

</html>