<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Bina Adinata</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;900&family=Noto+Sans:wght@400;500;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
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
                },
            },
        }
    </script>
    <style>
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-[#111318] dark:text-white font-display min-h-screen flex items-center justify-center p-4">

    <div class="max-w-2xl w-full text-center flex flex-col items-center gap-6">
        <!-- Error Illustration/Icon -->
        <div class="relative mb-4">
            <div class="absolute inset-0 bg-primary/20 blur-3xl rounded-full animate-pulse"></div>
            @yield('image')
        </div>

        <!-- Error Code -->
        <h1
            class="text-6xl md:text-8xl font-black text-transparent bg-clip-text bg-gradient-to-tr from-primary to-blue-400 leading-tight">
            @yield('code')
        </h1>

        <!-- Message -->
        <div class="flex flex-col gap-2 max-w-md mx-auto">
            <h2 class="text-2xl md:text-3xl font-bold text-[#111318] dark:text-white">
                @yield('message')
            </h2>
            <p class="text-gray-500 dark:text-gray-400 font-body text-sm md:text-base">
                @yield('description')
            </p>
        </div>

        <!-- Action -->
        <div class="mt-4 flex flex-col sm:flex-row gap-4 justify-center w-full">
            <a href="{{ url('/') }}"
                class="px-8 py-3 rounded-xl bg-primary text-white font-bold hover:bg-blue-700 hover:shadow-lg hover:shadow-primary/30 transition-all flex items-center justify-center gap-2 group">
                <span
                    class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
                Kembali ke Beranda
            </a>
            @if(auth()->check())
                <a href="{{ url()->previous() }}"
                    class="px-8 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-surface-dark text-gray-700 dark:text-white font-bold hover:bg-gray-50 dark:hover:bg-gray-800 transition-all flex items-center justify-center gap-2">
                    Reload Halaman
                    <span class="material-symbols-outlined text-sm">refresh</span>
                </a>
            @endif
        </div>

        <!-- Footer -->
        <div class="mt-12 text-sm text-gray-400 font-body">
            &copy; {{ date('Y') }} PMB Bina Adinata. All rights reserved.
        </div>
    </div>

</body>

</html>