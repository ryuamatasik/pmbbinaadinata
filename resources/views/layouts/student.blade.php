<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard Calon Mahasiswa' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;900&family=Noto+Sans:wght@400;500;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <!-- Scripts & Styles -->
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
                        "surface-light": "#ffffff",
                        "surface-dark": "#1a2332",
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"],
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "2xl": "1rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        .delay-400 {
            animation-delay: 0.4s;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    @stack('styles')
</head>

<body
    class="bg-background-light dark:bg-background-dark text-[#111318] dark:text-white font-display transition-colors duration-200"
    x-data="{ isLoading: false }">

    <!-- Navbar -->
    <nav
        class="sticky top-0 z-50 bg-surface-light dark:bg-surface-dark border-b border-[#f0f2f4] dark:border-gray-800 animate-fade-in-up">
        <div class="px-6 lg:px-12 py-3 flex items-center justify-between max-w-[1440px] mx-auto w-full">
            <div class="flex items-center gap-4 text-[#111318] dark:text-white">
                <div class="size-10 flex items-center justify-center">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo"
                        class="w-full h-full object-contain rounded-full">
                </div>
                <h2
                    class="text-[#111318] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] hidden sm:block">
                    Bina Adinata
                </h2>
            </div>
            <div class="flex items-center gap-2 ml-auto">
                {{-- Helper for checking active route --}}
                @php
                    $isDashboard = request()->routeIs('mahasiswa.dashboard');
                    $isHome = request()->is('/');
                @endphp

                <a class="px-4 py-2 rounded-lg {{ $isHome ? 'bg-primary/10 text-primary' : 'text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-white' }} font-bold text-sm transition-colors"
                    href="{{ url('/') }}">Beranda</a>

                <a class="px-4 py-2 rounded-lg {{ $isDashboard ? 'bg-primary/10 text-primary' : 'text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-white' }} font-bold text-sm transition-colors"
                    href="{{ route('mahasiswa.dashboard') }}">Dashboard</a>

                <div class="flex items-center gap-4 ml-2">


                    @auth
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 group">
                            <div class="hidden sm:flex flex-col items-end">
                                <span
                                    class="text-xs font-bold text-[#111318] dark:text-white group-hover:text-primary transition-colors">{{ Auth::user()->name }}</span>
                                <span class="text-xs text-gray-500">Calon Mahasiswa</span>
                            </div>
                            <div class="relative shrink-0">
                                @if(Auth::user()->profile_photo_path)
                                    <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="Profile"
                                        class="rounded-full size-10 border-2 border-white dark:border-gray-700 shadow-sm object-cover aspect-square group-hover:border-primary transition-colors">
                                @else
                                    <div
                                        class="rounded-full size-10 border-2 border-white dark:border-gray-700 shadow-sm bg-slate-200 flex items-center justify-center text-slate-500 group-hover:border-primary transition-colors">
                                        <span class="material-symbols-outlined text-xl">person</span>
                                    </div>
                                @endif
                            </div>
                        </a>
                    @endauth
                </div>
            </div>
            <!-- Mobile Menu Removed -->
        </div>

        <!-- Mobile Menu Removed -->

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        @stack('scripts')

        <!-- Script Removed -->
</body>

</html>