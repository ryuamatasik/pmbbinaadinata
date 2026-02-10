<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Pimpinan - Bina Adinata</title>
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
                        "primary-light": "#eef4ff",
                        "background-light": "#f6f6f8",
                        "background-dark": "#101622",
                        "success": "#16a34a",
                        "warning": "#d97706",
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
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        /* Entry Animations */
        /* Admin-Style Animations */
        @keyframes sidebarReveal {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes contentShow {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-sidebar-enter {
            opacity: 0;
            animation: sidebarReveal 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .animate-content {
            animation: contentShow 1.0s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark font-body text-[#111318] dark:text-white overflow-hidden h-screen flex">
    @php
        $previousUrl = url()->previous();
        $pimpinanPrefix = url('/pimpinan');
        $shouldAnimateSidebar = !Str::startsWith($previousUrl, $pimpinanPrefix);
    @endphp

    <!-- Sidebar -->
    <aside id="main-sidebar"
        class="w-64 bg-white dark:bg-[#151b2b] border-r border-[#f0f2f4] dark:border-gray-800 hidden md:flex flex-col z-20">
        <div class="h-16 flex items-center px-6 border-b border-[#f0f2f4] dark:border-gray-800">
            <!-- Branding matched with Landing Page -->
            <div class="flex items-center gap-4 text-[#111318] dark:text-white">
                <div class="size-10 flex items-center justify-center">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo"
                        class="w-full h-full object-contain rounded-full">
                </div>
                <h2
                    class="text-[#111318] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] hidden sm:block">
                    Bina Adinata</h2>
            </div>
        </div>
        <nav class="flex-1 overflow-y-auto py-6 px-4 flex flex-col gap-1">
            <div class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 px-2">Menu Utama</div>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('dashboard.pimpinan') ? 'bg-primary/10 text-primary' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-primary dark:hover:text-white' }} {{ $shouldAnimateSidebar ? 'animate-sidebar-enter' : '' }}"
                href="{{ route('dashboard.pimpinan') }}"
                style="{{ $shouldAnimateSidebar ? 'animation-delay: 100ms;' : '' }}">
                <span
                    class="material-symbols-outlined text-[20px] {{ request()->routeIs('dashboard.pimpinan') ? '' : 'group-hover:text-primary transition-colors' }}">grid_view</span>
                <span class="text-sm font-bold">Ringkasan</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('pimpinan.analitik') ? 'bg-primary/10 text-primary' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-primary dark:hover:text-white' }} {{ $shouldAnimateSidebar ? 'animate-sidebar-enter' : '' }}"
                href="{{ route('pimpinan.analitik') }}"
                style="{{ $shouldAnimateSidebar ? 'animation-delay: 200ms;' : '' }}">
                <span
                    class="material-symbols-outlined text-[20px] {{ request()->routeIs('pimpinan.analitik') ? '' : 'group-hover:text-primary transition-colors' }}">bar_chart</span>
                <span class="text-sm font-medium">Analitik Pendaftaran</span>
            </a>
            <div class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 mt-6 px-2">Laporan &amp; Sistem
            </div>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('pimpinan.laporan') ? 'bg-primary/10 text-primary' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-primary dark:hover:text-white' }} {{ $shouldAnimateSidebar ? 'animate-sidebar-enter' : '' }}"
                href="{{ route('pimpinan.laporan') }}"
                style="{{ $shouldAnimateSidebar ? 'animation-delay: 300ms;' : '' }}">
                <span
                    class="material-symbols-outlined text-[20px] {{ request()->routeIs('pimpinan.laporan') ? '' : 'group-hover:text-primary transition-colors' }}">description</span>
                <span class="text-sm font-medium">Unduh Laporan</span>
            </a>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors group {{ request()->routeIs('pimpinan.pengaturan') ? 'bg-primary/10 text-primary' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-primary dark:hover:text-white' }} {{ $shouldAnimateSidebar ? 'animate-sidebar-enter' : '' }}"
                href="{{ route('pimpinan.pengaturan') }}"
                style="{{ $shouldAnimateSidebar ? 'animation-delay: 400ms;' : '' }}">
                <span
                    class="material-symbols-outlined text-[20px] {{ request()->routeIs('pimpinan.pengaturan') ? '' : 'group-hover:text-primary transition-colors' }}">settings</span>
                <span class="text-sm font-medium">Pengaturan Sistem</span>
            </a>
        </nav>
        <div class="p-4 border-t border-[#f0f2f4] dark:border-gray-800">
            <a href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 w-full p-2 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors text-left group">
                <div class="size-8 rounded-full overflow-hidden border border-gray-200 dark:border-gray-700">
                    @if(Auth::user()->profile_photo_path)
                        <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="Profile"
                            class="w-full h-full object-cover">
                    @else
                        <div
                            class="w-full h-full bg-primary/20 flex items-center justify-center text-primary font-bold text-xs">
                            PK
                        </div>
                    @endif
                </div>
                <div class="flex flex-col overflow-hidden">
                    <span
                        class="text-sm font-bold text-[#111318] dark:text-white truncate group-hover:text-primary transition-colors">{{ Auth::user()->name }}</span>
                    <span class="text-xs text-gray-500 truncate">Pimpinan</span>
                </div>
            </a>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
        <!-- Header -->
        <header id="main-header"
            class="h-16 bg-white dark:bg-[#151b2b] border-b border-[#f0f2f4] dark:border-gray-800 flex items-center justify-between px-4 md:px-8 z-10">
            <div class="flex items-center gap-4">
                <button class="md:hidden text-gray-600 dark:text-gray-400">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <h1 class="text-xl font-bold font-display text-[#111318] dark:text-white">
                    @yield('title', 'Dashboard Eksekutif')</h1>
            </div>
            <div class="flex items-center gap-4">
                <div class="hidden md:flex items-center bg-gray-100 dark:bg-gray-800 rounded-lg px-3 py-2 w-64">
                    <span class="material-symbols-outlined text-gray-400 text-[20px]">search</span>
                    <input
                        class="bg-transparent border-none focus:ring-0 text-sm w-full text-[#111318] dark:text-white placeholder-gray-400"
                        placeholder="Cari data..." type="text" />
                </div>
                <!-- Logout/Profile -->
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 group">
                    <div
                        class="size-8 rounded-full overflow-hidden border border-gray-200 dark:border-gray-700 shrink-0">
                        @if(Auth::user()->profile_photo_path)
                            <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="Profile"
                                class="w-full h-full object-cover">
                        @else
                            <div
                                class="w-full h-full bg-primary/20 flex items-center justify-center text-primary font-bold text-xs">
                                PK
                            </div>
                        @endif
                    </div>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="relative p-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-full transition-colors"
                        title="Logout">
                        <span class="material-symbols-outlined">logout</span>
                    </button>
                </form>
            </div>
        </header>

        <!-- Main Content (Always Animates) -->
        <main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark p-4 md:p-8">
            <div class="max-w-7xl mx-auto flex flex-col gap-6 animate-content" id="main-content">
                @yield('content')
            </div>
        </main>
    </div>

    <div id="mobile-sidebar-backdrop" class="fixed inset-0 bg-black/50 z-10 hidden md:hidden"></div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // === Sidebar Toggle Logic ===
            const menuBtn = document.querySelector('button.md\\:hidden');
            const backdrop = document.getElementById('mobile-sidebar-backdrop');
            const aside = document.querySelector('aside');

            if (menuBtn && aside) {
                menuBtn.addEventListener('click', () => {
                    aside.classList.toggle('hidden');
                    aside.classList.toggle('fixed');
                    aside.classList.toggle('inset-y-0');
                    aside.classList.toggle('left-0');
                    aside.classList.toggle('shadow-2xl');

                    if (backdrop) backdrop.classList.toggle('hidden');
                });

                if (backdrop) {
                    backdrop.addEventListener('click', () => {
                        aside.classList.add('hidden');
                        aside.classList.remove('fixed', 'inset-y-0', 'left-0', 'shadow-2xl');
                        backdrop.classList.add('hidden');
                    });
                }
            }

            // === Logout Reset ===
            const logoutForm = document.getElementById('logout-form');
            if (logoutForm) {
                logoutForm.addEventListener('submit', () => {
                    sessionStorage.removeItem('pimpinan_visited');
                });
            }

            // Also handle the header logout button if it exists
            const headerLogoutBtn = document.querySelector('header form[action*="logout"]');
            if (headerLogoutBtn) {
                headerLogoutBtn.addEventListener('submit', () => {
                    sessionStorage.removeItem('pimpinan_visited');
                });
            }
        });

        // Global Confirmation Modal Logic
        function openConfirmModal(actionUrl, title, message, method = 'DELETE', color = 'red') {
            const modal = document.getElementById('globalConfirmModal');
            const form = document.getElementById('globalConfirmForm');
            const modalTitle = document.getElementById('globalConfirmTitle');
            const modalMessage = document.getElementById('globalConfirmMessage');
            const modalMethod = document.getElementById('globalConfirmMethod');
            const submitBtn = document.getElementById('globalConfirmSubmitBtn');
            const iconContainer = document.getElementById('globalConfirmIcon');

            // Set Form Action
            form.action = actionUrl;

            // Set Content
            modalTitle.textContent = title;
            modalMessage.textContent = message;
            modalMethod.value = method;

            // Define UI based on Color Intent
            const styles = {
                red: {
                    icon: 'warning',
                    iconClass: 'text-red-600 bg-red-100 dark:bg-red-900/30 dark:text-red-500',
                    btnClass: 'bg-red-600 hover:bg-red-700 text-white'
                },
                green: {
                    icon: 'check_circle',
                    iconClass: 'text-green-600 bg-green-100 dark:bg-green-900/30 dark:text-green-500',
                    btnClass: 'bg-green-600 hover:bg-green-700 text-white'
                },
                blue: {
                    icon: 'info',
                    iconClass: 'text-blue-600 bg-blue-100 dark:bg-blue-900/30 dark:text-blue-500',
                    btnClass: 'bg-blue-600 hover:bg-blue-700 text-white'
                },
                amber: {
                    icon: 'priority_high',
                    iconClass: 'text-amber-600 bg-amber-100 dark:bg-amber-900/30 dark:text-amber-500',
                    btnClass: 'bg-amber-600 hover:bg-amber-700 text-white'
                }
            };

            const style = styles[color] || styles.red;

            // Update Icon
            iconContainer.className = `mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full sm:mx-0 sm:h-10 sm:w-10 ${style.iconClass}`;
            iconContainer.innerHTML = `<span class="material-symbols-outlined text-2xl">${style.icon}</span>`;

            // Update Button
            submitBtn.className = `inline-flex w-full justify-center rounded-md px-3 py-2 text-sm font-semibold shadow-sm sm:ml-3 sm:w-auto transition-colors ${style.btnClass}`;
            submitBtn.textContent = (method === 'DELETE') ? 'Ya, Hapus' : 'Ya, Lanjutkan';

            // Show Modal
            modal.showModal();
        }

        function closeConfirmModal() {
            const modal = document.getElementById('globalConfirmModal');
            modal.close();
        }
    </script>

    <!-- Global Confirmation Modal -->
    <dialog id="globalConfirmModal"
        class="relative z-50 backdrop:bg-gray-500/75 dark:backdrop:bg-gray-900/80 p-0 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg bg-white dark:bg-[#1a2130]">
        <div class="px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div id="globalConfirmIcon">
                    <!-- Icon inserted via JS -->
                </div>
                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                    <h3 class="text-base font-semibold leading-6 text-gray-900 dark:text-white" id="globalConfirmTitle">
                        Konfirmasi
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500 dark:text-gray-400" id="globalConfirmMessage">
                            Apakah Anda yakin ingin melanjutkan tindakan ini?
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 dark:bg-gray-800/50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
            <form id="globalConfirmForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="globalConfirmMethod" value="DELETE">
                <button type="submit" id="globalConfirmSubmitBtn">
                    Ya, Lanjutkan
                </button>
            </form>
            <button type="button" onclick="closeConfirmModal()"
                class="mt-3 inline-flex w-full justify-center rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 sm:mt-0 sm:w-auto transition-colors">
                Batal
            </button>
        </div>
    </dialog>
</body>

</html>