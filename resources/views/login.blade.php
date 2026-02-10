<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Masuk & Daftar - Universitas Kita</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&amp;display=swap" rel="stylesheet" />
    <!-- Material Symbols -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <!-- Tailwind CSS -->
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
                        "display": ["Lexend", "sans-serif"]
                    },
                },
            },
        }
    </script>
    <style>
        body {
            overflow: hidden;
            /* Prevent scrollbars completely */
            width: 100vw;
            height: 100vh;
            margin: 0;
        }

        .container-switch {
            position: relative;
            overflow: hidden;
            width: 100%;
            min-height: 100vh;
        }

        /* Forms Container */
        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        /* Overlay Container */
        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .overlay {
            background-image: linear-gradient(rgba(19, 91, 236, 0.85), rgba(19, 91, 236, 0.85)), url('{{ asset('images/kampus_bg_v3.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        /* Animation States */
        .container-switch.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        .container-switch.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        .container-switch.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .container-switch.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .container-switch.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .container-switch.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        @keyframes show {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        /* Super Zoom Landing Animation (Refined) */
        @keyframes superZoomLanding {
            0% {
                opacity: 0;
                transform: scale(1.5);
                filter: blur(10px);
            }

            100% {
                opacity: 1;
                transform: scale(1) translateZ(0);
                filter: blur(0);
            }
        }

        .container-switch {
            animation: superZoomLanding 0.8s cubic-bezier(0.25, 1, 0.5, 1) forwards;
            will-change: transform, opacity, filter;
            backface-visibility: hidden;
            transform: translateZ(0);
            /* Force GPU */
        }

        /* Mobile Responsive */
        @media (max-width: 1023px) {

            html,
            body {
                overflow-x: hidden !important;
                overflow-y: auto !important;
                height: 100% !important;
                width: 100% !important;
                position: relative;
            }

            .container-switch {
                display: block !important;
                position: relative !important;
                width: 100% !important;
                min-height: 100vh !important;
                height: auto !important;
                overflow-x: hidden !important;
                overflow-y: auto !important;
            }

            .form-container {
                position: relative !important;
                width: 100% !important;
                height: auto !important;
                min-height: 100vh;
                top: auto !important;
                left: auto !important;
                transform: none !important;
                opacity: 1 !important;
                z-index: 10;
                padding: 0;
            }

            .sign-in-container,
            .sign-up-container {
                position: absolute !important;
                top: 0;
                left: 0;
                width: 100% !important;
                display: flex !important;
                /* Align top on mobile to avoid centering causing keyboard issues, or keep center? */
                /* Let's keep center but ensure min-h-screen handles it */
                align-items: center;
                justify-content: center;
                min-height: 100vh;
            }

            .sign-up-container {
                visibility: hidden;
                opacity: 0;
                pointer-events: none;
                z-index: 1;
                transition: opacity 0.3s ease;
            }

            .sign-in-container {
                visibility: visible;
                opacity: 1;
                pointer-events: auto;
                z-index: 2;
                transition: opacity 0.3s ease;
            }

            /* Active State Logic for Mobile */
            .container-switch.right-panel-active .sign-in-container {
                visibility: hidden;
                opacity: 0;
                pointer-events: none;
            }

            .container-switch.right-panel-active .sign-up-container {
                visibility: visible;
                opacity: 1;
                pointer-events: auto;
                z-index: 20;
            }

            .overlay-container {
                display: none !important;
            }

            /* Ensure inner content is full width */
            .w-full.max-w-md {
                max-width: 100% !important;
                padding-left: 1.5rem !important;
                padding-right: 1.5rem !important;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-white antialiased"
    x-data="{ isLoading: false }">

    <div class="container-switch bg-white dark:bg-background-dark" id="mainContainer">

        <!-- Sign Up Form (Daftar / Buat Akun) -->
        <div class="form-container sign-up-container flex items-center justify-center bg-white dark:bg-background-dark">
            <div class="w-full max-w-md px-4 md:px-8 py-12">
                <div class="flex items-center gap-2 mb-6 text-primary lg:hidden">
                    <span class="material-symbols-outlined text-3xl">school</span>
                    <span class="text-xl font-bold text-slate-900 dark:text-white">Bina Adinata</span>
                </div>

                <h1 class="text-3xl font-black mb-2 text-slate-900 dark:text-white">Buat Akun Baru</h1>
                <p class="text-slate-500 mb-8">Mulai perjalanan akademik Anda bersama kami.</p>

                <form action="{{ route('register.submit') }}" method="POST" class="space-y-4"
                    @submit="isLoading = true">
                    @csrf
                    <!-- Direct to form for now as requested -->
                    <div class="relative">
                        <span
                            class="absolute left-3 top-3 text-slate-400 material-symbols-outlined text-[20px]">person</span>
                        <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}"
                            class="w-full pl-10 pr-4 py-3 rounded-lg border-gray-200 focus:border-primary focus:ring-primary dark:bg-slate-800 dark:border-gray-700 @error('name') border-red-500 @enderror"
                            required />
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative">
                        <span
                            class="absolute left-3 top-3 text-slate-400 material-symbols-outlined text-[20px]">mail</span>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                            class="w-full pl-10 pr-4 py-3 rounded-lg border-gray-200 focus:border-primary focus:ring-primary dark:bg-slate-800 dark:border-gray-700 @error('email') border-red-500 @enderror"
                            required />
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative">
                        <span
                            class="absolute left-3 top-3 text-slate-400 material-symbols-outlined text-[20px]">lock</span>
                        <input type="password" name="password" placeholder="Password"
                            class="w-full pl-10 pr-4 py-3 rounded-lg border-gray-200 focus:border-primary focus:ring-primary dark:bg-slate-800 dark:border-gray-700 @error('password') border-red-500 @enderror"
                            required />
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" :disabled="isLoading"
                        class="w-full bg-primary text-white font-bold py-3 rounded-lg shadow-lg hover:bg-primary-dark transition-all transform hover:-translate-y-0.5 mt-4 flex items-center justify-center disabled:opacity-70 disabled:cursor-not-allowed disabled:transform-none">
                        <span x-show="!isLoading">Buat Akun</span>
                        <span x-show="isLoading" class="flex items-center gap-2" style="display: none;">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Memproses...
                        </span>
                    </button>
                </form>

                <div class="mt-8 text-center lg:hidden">
                    <p class="text-slate-500 text-sm">Sudah punya akun? <button id="signInMobile" type="button"
                            class="text-primary font-bold">Masuk disini</button></p>
                </div>
            </div>
        </div>

        <!-- Sign In Form (Masuk) -->
        <div class="form-container sign-in-container flex items-center justify-center bg-white dark:bg-background-dark">
            <div class="w-full max-w-md px-4 md:px-8 py-12">

                <!-- Mobile Navigation -->
                <div class="lg:hidden absolute top-6 right-6">
                    <a class="flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-primary transition-colors"
                        href="{{ url('/') }}">
                        <span class="material-symbols-outlined text-[20px]">arrow_back</span> Kembali
                    </a>
                </div>

                <div class="flex items-center gap-2 mb-6 text-primary lg:hidden">
                    <span class="material-symbols-outlined text-3xl">school</span>
                    <span class="text-xl font-bold text-slate-900 dark:text-white">Bina Adinata</span>
                </div>

                <h1 class="text-3xl font-black mb-2 text-slate-900 dark:text-white">Selamat Datang Kembali</h1>
                <p class="text-slate-500 mb-8">Masuk untuk mengakses dashboard Anda.</p>

                <form action="{{ route('login.submit') }}" method="POST" class="space-y-4" @submit="isLoading = true">
                    @csrf
                    <div class="relative">
                        <span
                            class="absolute left-3 top-3 text-slate-400 material-symbols-outlined text-[20px]">person</span>
                        <input type="text" name="email" placeholder="Username / Email" value="{{ old('email') }}"
                            class="w-full pl-10 pr-4 py-3 rounded-lg border-gray-200 focus:border-primary focus:ring-primary dark:bg-slate-800 dark:border-gray-700 @error('email') border-red-500 @enderror"
                            required />
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative">
                        <span
                            class="absolute left-3 top-3 text-slate-400 material-symbols-outlined text-[20px]">lock</span>
                        <input type="password" name="password" placeholder="Password"
                            class="w-full pl-10 pr-4 py-3 rounded-lg border-gray-200 focus:border-primary focus:ring-primary dark:bg-slate-800 dark:border-gray-700 @error('password') border-red-500 @enderror"
                            required />
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">Lupa
                            Password?</a>
                    </div>

                    <button type="submit" :disabled="isLoading"
                        class="w-full bg-primary text-white font-bold py-3 rounded-lg shadow-lg hover:bg-primary-dark transition-all transform hover:-translate-y-0.5 mt-4 flex items-center justify-center disabled:opacity-70 disabled:cursor-not-allowed disabled:transform-none">
                        <span x-show="!isLoading">Masuk</span>
                        <span x-show="isLoading" class="flex items-center gap-2" style="display: none;">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Memproses...
                        </span>
                    </button>
                </form>

                <div class="mt-8 text-center lg:hidden">
                    <p class="text-slate-500 text-sm">Belum punya akun? <button id="signUpMobile"
                            class="text-primary font-bold">Daftar Sekarang</button></p>
                </div>
            </div>
        </div>

        <!-- Overlay Container (Animation Magic) -->
        <div class="overlay-container hidden lg:block">
            <div class="overlay">
                <!-- Left Overlay (Visible when Registering) -->
                <div class="overlay-panel overlay-left">
                    <div
                        class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white/20 backdrop-blur-md mb-6 shadow-xl">
                        <span class="material-symbols-outlined text-white text-4xl">school</span>
                    </div>
                    <h1 class="text-4xl font-black mb-4">Sudah Terdaftar?</h1>
                    <p class="text-lg text-white/90 mb-8 max-w-xs">
                        Silakan masuk untuk melanjutkan proses pendaftaran atau memantau status seleksi Anda.
                    </p>
                    <button
                        class="bg-transparent border-2 border-white text-white font-bold py-3 px-12 rounded-lg hover:bg-white hover:text-primary transition-all transform hover:scale-105"
                        id="signIn">
                        Masuk
                    </button>
                </div>

                <!-- Right Overlay (Visible when Logging In) -->
                <div class="overlay-panel overlay-right">
                    <div class="absolute top-8 right-10">
                        <a class="flex items-center gap-2 text-sm font-medium text-white/80 hover:text-white transition-colors"
                            href="{{ url('/') }}">
                            <span class="material-symbols-outlined text-[20px]">arrow_back</span> Kembali ke Beranda
                        </a>
                    </div>

                    <div
                        class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white/20 backdrop-blur-md mb-6 shadow-xl">
                        <span class="material-symbols-outlined text-white text-4xl">person_add</span>
                    </div>
                    <h1 class="text-4xl font-black mb-4">Mahasiswa Baru?</h1>
                    <p class="text-lg text-white/90 mb-8 max-w-xs">
                        Bergabunglah dengan Bina Adinata! Daftarkan diri Anda dan raih masa depan gemilang.
                    </p>
                    <button
                        class="bg-white text-primary font-bold py-3 px-12 rounded-lg hover:bg-gray-100 transition-all transform hover:scale-105 shadow-xl"
                        id="signUp">
                        Daftar Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const mainContainer = document.getElementById('mainContainer');

        // Mobile buttons
        const signUpMobile = document.getElementById('signUpMobile');
        const signInMobile = document.getElementById('signInMobile');

        // Check for specific registration errors to keep panel open
        // Logic: Login form doesn't have 'name'. If 'name' is in old input OR has error, it's a register attempt.
        @if ($errors->has('name') || old('name'))
            mainContainer.classList.add("right-panel-active");
        @endif

        // Desktop Animation Events
        signUpButton.addEventListener('click', () => {
            mainContainer.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            mainContainer.classList.remove("right-panel-active");
        });

        // Mobile Switch Events
        if (signUpMobile) {
            signUpMobile.addEventListener('click', () => {
                mainContainer.classList.add("right-panel-active");
            });
        }

        if (signInMobile) {
            signInMobile.addEventListener('click', () => {
                mainContainer.classList.remove("right-panel-active");
            });
        }
    </script>

</body>

</html>