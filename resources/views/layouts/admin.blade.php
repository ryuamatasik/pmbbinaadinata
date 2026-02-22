<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Portal - Bina Adinata')</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&amp;family=Noto+Sans:wght@300..800&amp;display=swap"
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
                        "primary": "#135bec",
                        "primary-dark": "#0e45b5",
                        "background-light": "#f6f6f8",
                        "background-dark": "#101622",
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"]
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

        .sidebar-item {
            /* Animation defined inline or via class if active */
        }

        .animate-sidebar-enter {
            opacity: 0;
            animation: sidebarReveal 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .animate-content {
            animation: contentShow 1.0s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-[#111318] dark:text-white overflow-hidden">
    @php
        // Determine if we should animate the sidebar
        // Animate ONLY if the previous URL did NOT start with the admin base URL
        // This means we are entering from outside (login, home, etc.) or refreshing with no referrer
        $previousUrl = url()->previous();
        $currentHost = url('/');
        $adminPrefix = url('/admin');

        // If previous URL is from same host AND starts with /admin, we assume internal navigation -> NO Animation
        // Unless it's the exact same page (refresh), but usually referer is set.
        // We act conservatively: Only animate if NOT internal admin nav.
        $shouldAnimateSidebar = !Str::startsWith($previousUrl, $adminPrefix);
        // $shouldAnimateSidebar = true; // Force animation for visual confirmation
    @endphp

    <div class="flex h-screen w-full flex-col">
        <header
            class="sticky top-0 z-50 bg-white dark:bg-gray-900 border-b border-[#f0f2f4] dark:border-gray-800 w-full h-16 flex-none">
            <div class="px-4 md:px-6 h-full flex items-center justify-between w-full">
                <div class="flex items-center gap-4 text-[#111318] dark:text-white">
                    <button class="md:hidden text-gray-500 hover:text-primary">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <!-- Updated Branding -->
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
                <div class="flex items-center gap-4">
                    <div class="h-8 w-[1px] bg-gray-200 dark:bg-gray-700 mx-1"></div>
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 cursor-pointer p-1 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                        <div
                            class="size-8 rounded-full overflow-hidden border border-gray-200 dark:border-gray-700 shrink-0">
                            @if(Auth::user()->profile_photo_path)
                                <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="Profile"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full bg-primary/10 flex items-center justify-center text-primary font-bold text-sm">
                                    AD
                                </div>
                            @endif
                        </div>
                        <div class="hidden md:block text-left">
                            <p class="text-sm font-bold text-[#111318] dark:text-white leading-none">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Administrator</p>
                        </div>
                        <span class="material-symbols-outlined text-gray-400 text-sm hidden md:block">expand_more</span>
                    </a>
                </div>
            </div>
        </header>
        <div class="flex flex-1 overflow-hidden">
            <aside
                class="w-64 bg-white dark:bg-gray-900 border-r border-[#f0f2f4] dark:border-gray-800 hidden md:flex flex-col flex-none">
                <div class="flex flex-col gap-1 p-4 flex-1 overflow-y-auto">
                    <div class="pb-2 mb-2 border-b border-gray-100 dark:border-gray-800">
                        <p class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Utama</p>
                        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-primary transition-colors' }} {{ $shouldAnimateSidebar ? 'animate-sidebar-enter' : '' }}"
                            href="{{ route('admin.dashboard') }}"
                            style="{{ $shouldAnimateSidebar ? 'animation-delay: 100ms;' : '' }}">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span>Dashboard</span>
                        </a>
                    </div>
                    <div class="pb-2 mb-2 border-b border-gray-100 dark:border-gray-800">
                        <p class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Pendaftaran</p>
                        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.data_calon_mahasiswa') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-primary transition-colors' }} {{ $shouldAnimateSidebar ? 'animate-sidebar-enter' : '' }}"
                            href="{{ route('admin.data_calon_mahasiswa') }}"
                            style="{{ $shouldAnimateSidebar ? 'animation-delay: 200ms;' : '' }}">
                            <span class="material-symbols-outlined">group_add</span>
                            <span>Data Calon Mhs</span>
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.verifikasi_berkas') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-primary transition-colors' }} {{ $shouldAnimateSidebar ? 'animate-sidebar-enter' : '' }}"
                            href="{{ route('admin.verifikasi_berkas') }}"
                            style="{{ $shouldAnimateSidebar ? 'animation-delay: 300ms;' : '' }}">
                            <span class="material-symbols-outlined">fact_check</span>
                            <span>Verifikasi Berkas</span>
                            @if(isset($verifikasiAttemptsCount) && $verifikasiAttemptsCount > 0)
                                <span
                                    class="ml-auto bg-red-100 text-red-600 text-xs font-bold px-2 py-0.5 rounded-full">{{ $verifikasiAttemptsCount }}</span>
                            @endif
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.jadwal_seleksi') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-primary transition-colors' }} {{ $shouldAnimateSidebar ? 'animate-sidebar-enter' : '' }}"
                            href="{{ route('admin.jadwal_seleksi') }}"
                            style="{{ $shouldAnimateSidebar ? 'animation-delay: 400ms;' : '' }}">
                            <span class="material-symbols-outlined">calendar_month</span>
                            <span>Jadwal Seleksi</span>
                        </a>
                    </div>
                    <div class="pb-2 mb-2">
                        <p class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Sistem</p>
                        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.kelola_dokumen') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-primary transition-colors' }} {{ $shouldAnimateSidebar ? 'animate-sidebar-enter' : '' }}"
                            href="{{ route('admin.kelola_dokumen') }}"
                            style="{{ $shouldAnimateSidebar ? 'animation-delay: 500ms;' : '' }}">
                            <span class="material-symbols-outlined">folder_shared</span>
                            <span>Kelola Dokumen</span>
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.pengumuman') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-primary transition-colors' }} {{ $shouldAnimateSidebar ? 'animate-sidebar-enter' : '' }}"
                            href="{{ route('admin.pengumuman') }}"
                            style="{{ $shouldAnimateSidebar ? 'animation-delay: 600ms;' : '' }}">
                            <span class="material-symbols-outlined">campaign</span>
                            <span>Pengumuman</span>
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.pengaturan') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-primary transition-colors' }} {{ $shouldAnimateSidebar ? 'animate-sidebar-enter' : '' }}"
                            href="{{ route('admin.pengaturan') }}"
                            style="{{ $shouldAnimateSidebar ? 'animation-delay: 700ms;' : '' }}">
                            <span class="material-symbols-outlined">settings</span>
                            <span>Pengaturan</span>
                        </a>
                    </div>
                </div>
                <div class="p-4 border-t border-[#f0f2f4] dark:border-gray-800">
                    <a href="{{ route('profile.edit') }}"
                        class="flex w-full items-center gap-3 px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800 transition-colors font-medium mb-1 {{ $shouldAnimateSidebar ? 'animate-sidebar-enter' : '' }}"
                        style="{{ $shouldAnimateSidebar ? 'animation-delay: 750ms;' : '' }}">
                        <span class="material-symbols-outlined">person</span>
                        <span>Profil Saya</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex w-full items-center gap-3 px-3 py-2.5 rounded-lg text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors font-medium {{ $shouldAnimateSidebar ? 'animate-sidebar-enter' : '' }}"
                            style="{{ $shouldAnimateSidebar ? 'animation-delay: 800ms;' : '' }}">
                            <span class="material-symbols-outlined">logout</span>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </aside>
            <main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark p-4 md:p-8">
                <div class="animate-content">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    @stack('scripts')

    <!-- Global Confirmation Modal -->
    <dialog id="globalConfirmModal" class="modal rounded-xl p-0 backdrop:bg-black/50 w-full max-w-sm">
        <div class="bg-white dark:bg-gray-900 p-6 text-center">
            <div id="modalIconContainer"
                class="w-16 h-16 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4 transition-colors">
                <span id="modalIcon" class="material-symbols-outlined text-3xl">warning</span>
            </div>
            <h3 id="modalTitle" class="text-lg font-bold text-gray-900 dark:text-white mb-2">Konfirmasi Tindakan</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm mb-6">
                <span id="modalMessage">Apakah Anda yakin ingin melanjutkan tindakan ini?</span>
            </p>
            <div class="flex gap-3 justify-center">
                <button onclick="document.getElementById('globalConfirmModal').close()"
                    class="px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-bold text-sm hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    Batal
                </button>
                <form id="globalConfirmForm" method="POST" class="inline-block">
                    @csrf
                    <div id="methodField"></div>
                    <button type="submit" id="confirmBtn"
                        class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-bold text-sm transition-colors shadow-lg shadow-red-600/20">
                        Ya, Lanjutkan
                    </button>
                </form>
            </div>
        </div>
    </dialog>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // === Sidebar Toggle Logic ===
            const menuBtn = document.querySelector('button.md\\:hidden');
            // Create backdrop if it doesn't exist (Admin layout might not have it in HTML, so we create dynamically or check if exists)
            let backdrop = document.getElementById('mobile-sidebar-backdrop');

            // If backdrop is missing in HTML, let's assume we need to target the aside toggle generally
            // But let's check aside
            const aside = document.querySelector('aside');

            if (menuBtn && aside) {
                menuBtn.addEventListener('click', () => {
                    aside.classList.toggle('hidden');
                    aside.classList.toggle('fixed');
                    aside.classList.toggle('inset-y-0');
                    aside.classList.toggle('left-0');
                    aside.classList.toggle('shadow-2xl');
                    aside.classList.toggle('z-50'); // Ensure it's on top

                    // Backdrop logic
                    if (backdrop) {
                        backdrop.classList.toggle('hidden');
                    } else {
                        // Create backdrop if missing
                        const newBackdrop = document.createElement('div');
                        newBackdrop.id = 'mobile-sidebar-backdrop';
                        newBackdrop.className = 'fixed inset-0 bg-black/50 z-40'; // z-40 to be below sidebar (z-50)
                        document.body.appendChild(newBackdrop);

                        newBackdrop.addEventListener('click', () => {
                            aside.classList.add('hidden');
                            aside.classList.remove('fixed', 'inset-y-0', 'left-0', 'shadow-2xl', 'z-50');
                            newBackdrop.remove();
                            backdrop = null; // Clear reference
                        });
                        backdrop = newBackdrop;
                    }
                });
            }
        });

        function openConfirmModal(url, title, message, method = 'DELETE', color = 'red') {
            const modal = document.getElementById('globalConfirmModal');
            const form = document.getElementById('globalConfirmForm');
            const titleEl = document.getElementById('modalTitle');
            const messageEl = document.getElementById('modalMessage');
            const confirmBtn = document.getElementById('confirmBtn');
            const iconContainer = document.getElementById('modalIconContainer');
            const methodField = document.getElementById('methodField');

            // Set content
            form.action = url;
            titleEl.textContent = title;
            messageEl.textContent = message;

            // Set method
            if (method !== 'POST' && method !== 'GET') {
                methodField.innerHTML = `<input type="hidden" name="_method" value="${method}">`;
            } else {
                methodField.innerHTML = '';
            }

            // Style based on color/type
            if (color === 'red') {
                iconContainer.className = "w-16 h-16 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4 transition-colors";
                confirmBtn.className = "px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-bold text-sm transition-colors shadow-lg shadow-red-600/20";
            } else if (color === 'green') {
                iconContainer.className = "w-16 h-16 bg-green-100 dark:bg-green-900/30 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 transition-colors";
                confirmBtn.className = "px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white font-bold text-sm transition-colors shadow-lg shadow-green-600/20";
            } else if (color === 'blue') {
                iconContainer.className = "w-16 h-16 bg-blue-100 dark:bg-blue-900/30 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 transition-colors";
                confirmBtn.className = "px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm transition-colors shadow-lg shadow-blue-600/20";
            } else if (color === 'amber') { // For Revision
                iconContainer.className = "w-16 h-16 bg-amber-100 dark:bg-amber-900/30 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-4 transition-colors";
                confirmBtn.className = "px-4 py-2 rounded-lg bg-amber-600 hover:bg-amber-700 text-white font-bold text-sm transition-colors shadow-lg shadow-amber-600/20";
            }

            modal.showModal();
        }
    </script>
</body>

</html>