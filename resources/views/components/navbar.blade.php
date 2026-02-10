<header
    class="sticky top-0 z-50 bg-white dark:bg-background-dark border-b border-[#f0f2f4] dark:border-gray-800 w-full">
    <div class="px-4 md:px-10 py-3 flex items-center justify-between max-w-[1440px] mx-auto w-full">
        <div class="flex items-center gap-4 text-[#111318] dark:text-white">
            <div class="size-8 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined !text-[32px]">school</span>
            </div>
            <h2 class="text-[#111318] dark:text-white text-xl font-bold leading-tight tracking-[-0.015em]">Universitas
                Kita</h2>
        </div>
        <nav class="hidden md:flex flex-1 justify-end gap-8 items-center">
            <div class="flex items-center gap-9">
                <a class="text-[#111318] dark:text-white hover:text-primary text-sm font-medium leading-normal transition-colors"
                    href="#">Tentang Kampus</a>
                <a class="text-[#111318] dark:text-white hover:text-primary text-sm font-medium leading-normal transition-colors"
                    href="#">Kontak</a>
                <a class="text-[#111318] dark:text-white hover:text-primary text-sm font-medium leading-normal transition-colors"
                    href="#">Panduan</a>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('login') }}"
                    class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary hover:bg-primary-dark transition-colors text-white text-sm font-bold leading-normal tracking-[0.015em]">
                    <span class="truncate">Masuk</span>
                </a>
                <button
                    class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#f0f2f4] hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 transition-colors text-[#111318] dark:text-white text-sm font-bold leading-normal tracking-[0.015em]">
                    <span class="truncate">Daftar</span>
                </button>
            </div>
        </nav>
        <button class="md:hidden text-[#111318] dark:text-white">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
</header>