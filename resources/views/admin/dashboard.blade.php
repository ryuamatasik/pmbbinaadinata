@extends('layouts.admin')

@section('title', 'Dashboard Admin - Bina Adinata')

@section('content')
    <div class="max-w-7xl mx-auto flex flex-col gap-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-[#111318] dark:text-white">Dashboard Ringkasan</h1>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Pantau perkembangan pendaftaran
                    mahasiswa baru secara real-time.</p>
            </div>
            <div class="flex gap-3">
                <button
                    class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <span class="material-symbols-outlined text-[18px]">download</span>
                    Unduh Laporan
                </button>
                <button
                    class="flex items-center gap-2 px-4 py-2 bg-primary hover:bg-primary-dark text-white rounded-lg text-sm font-medium transition-colors shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Pendaftar Manual
                </button>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 md:gap-6">
            <div
                class="bg-white dark:bg-gray-900 rounded-xl p-6 border border-[#f0f2f4] dark:border-gray-800 shadow-sm flex flex-col">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">
                        <span class="material-symbols-outlined">groups</span>
                    </div>
                    <span
                        class="text-xs font-bold text-green-600 bg-green-50 dark:bg-green-900/30 px-2 py-1 rounded-full">+12%</span>
                </div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Pendaftar</h3>
                <p class="text-2xl font-bold text-[#111318] dark:text-white mt-1">{{ number_format($totalPendaftar) }}</p>
            </div>
            <div
                class="bg-white dark:bg-gray-900 rounded-xl p-6 border border-[#f0f2f4] dark:border-gray-800 shadow-sm flex flex-col">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-10 h-10 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                    <span
                        class="text-xs font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30 px-2 py-1 rounded-full">+24%</span>
                </div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Est. Pendapatan</h3>
                <p class="text-2xl font-bold text-[#111318] dark:text-white mt-1">Rp
                    {{ number_format($pendapatan, 0, ',', '.') }}
                </p>
            </div>
            <div
                class="bg-white dark:bg-gray-900 rounded-xl p-6 border border-[#f0f2f4] dark:border-gray-800 shadow-sm flex flex-col">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-10 h-10 rounded-lg bg-orange-50 dark:bg-orange-900/30 flex items-center justify-center text-orange-600 dark:text-orange-400">
                        <span class="material-symbols-outlined">pending_actions</span>
                    </div>
                    <span
                        class="text-xs font-bold text-orange-600 bg-orange-50 dark:bg-orange-900/30 px-2 py-1 rounded-full">Urgent</span>
                </div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Menunggu Verifikasi</h3>
                <p class="text-2xl font-bold text-[#111318] dark:text-white mt-1">{{ number_format($menungguVerifikasi) }}
                </p>
            </div>
            <div
                class="bg-white dark:bg-gray-900 rounded-xl p-6 border border-[#f0f2f4] dark:border-gray-800 shadow-sm flex flex-col">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-10 h-10 rounded-lg bg-green-50 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400">
                        <span class="material-symbols-outlined">check_circle</span>
                    </div>
                </div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Lolos Seleksi</h3>
                <p class="text-2xl font-bold text-[#111318] dark:text-white mt-1">{{ number_format($lolosSeleksi) }}</p>
            </div>
            <div
                class="bg-white dark:bg-gray-900 rounded-xl p-6 border border-[#f0f2f4] dark:border-gray-800 shadow-sm flex flex-col">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-10 h-10 rounded-lg bg-red-50 dark:bg-red-900/30 flex items-center justify-center text-red-600 dark:text-red-400">
                        <span class="material-symbols-outlined">cancel</span>
                    </div>
                    <span
                        class="text-xs font-bold text-red-600 bg-red-50 dark:bg-red-900/30 px-2 py-1 rounded-full">-2%</span>
                </div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm font-medium">Ditolak / Gagal</h3>
                <p class="text-2xl font-bold text-[#111318] dark:text-white mt-1">{{ number_format($ditolak) }}</p>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div
                class="lg:col-span-2 bg-white dark:bg-gray-900 rounded-xl border border-[#f0f2f4] dark:border-gray-800 shadow-sm overflow-hidden flex flex-col">
                <div class="p-6 border-b border-[#f0f2f4] dark:border-gray-800 flex items-center justify-between">
                    <h3 class="font-bold text-lg text-[#111318] dark:text-white">Pendaftar Terbaru</h3>
                    <a class="text-sm font-medium text-primary hover:text-primary-dark"
                        href="{{ route('admin.data_calon_mahasiswa') }}">Lihat
                        Semua</a>
                </div>
                <!-- Desktop Table View -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 dark:bg-gray-800/50">
                            <tr>
                                <th class="py-3 px-6 text-xs font-bold uppercase text-gray-500 dark:text-gray-400">
                                    No</th>
                                <th class="py-3 px-6 text-xs font-bold uppercase text-gray-500 dark:text-gray-400">
                                    Nama Lengkap</th>
                                <th class="py-3 px-6 text-xs font-bold uppercase text-gray-500 dark:text-gray-400">
                                    Program Studi</th>
                                <th class="py-3 px-6 text-xs font-bold uppercase text-gray-500 dark:text-gray-400">
                                    Status</th>
                                <th class="py-3 px-6 text-xs font-bold uppercase text-gray-500 dark:text-gray-400">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#f0f2f4] dark:divide-gray-800">
                            @forelse($pendaftars as $index => $pendaftar)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300 flex items-center justify-center text-xs font-bold">
                                                {{ substr($pendaftar->nama_lengkap ?? 'Unknown', 0, 2) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $pendaftar->nama_lengkap ?? 'N/A' }}
                                                </p>
                                                <p class="text-xs text-gray-500">{{ $pendaftar->email ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $pendaftar->pilihan_prodi ?? 'N/A' }}
                                    </td>
                                    <td class="py-4 px-6">
                                        @php
                                            $statusClass = match ($pendaftar->status) {
                                                'Diterima' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-500',
                                                'Ditolak' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-500',
                                                'Verifikasi' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-500',
                                                default => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-500'
                                            };
                                            $dotClass = match ($pendaftar->status) {
                                                'Diterima' => 'bg-green-500',
                                                'Ditolak' => 'bg-red-500',
                                                'Verifikasi' => 'bg-yellow-500',
                                                default => 'bg-blue-500'
                                            };
                                        @endphp
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium {{ $statusClass }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $dotClass }}"></span>
                                            {{ $pendaftar->status ?? 'Draft' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.pendaftar.detail', $pendaftar->id) }}"
                                                class="p-1.5 text-gray-500 hover:text-primary transition-colors rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-4 px-6 text-center text-gray-500">Belum ada pendaftar baru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="md:hidden flex flex-col divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($pendaftars as $index => $pendaftar)
                                    <div class="p-4 flex flex-col gap-3">
                                        <div class="flex items-start justify-between">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300 flex items-center justify-center text-xs font-bold shrink-0">
                                                    {{ substr($pendaftar->nama_lengkap ?? 'Unknown', 0, 2) }}
                                                </div>
                                                <div class="overflow-hidden">
                                                    <h4 class="text-sm font-bold text-[#111318] dark:text-white truncate">
                                                        {{ $pendaftar->nama_lengkap ?? 'N/A' }}</h4>
                                                    <p class="text-xs text-gray-500 truncate">{{ $pendaftar->email ?? 'N/A' }}</p>
                                                    <p class="text-[10px] text-gray-400 mt-0.5">Reg: {{ substr($pendaftar->id, 0, 8) }}...
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="shrink-0">
                                                @php
                                                    $statusClass = match ($pendaftar->status) {
                                                        'Diterima' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-500',
                                                        'Ditolak' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-500',
                                                        'Verifikasi' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-500',
                                                        default => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-500'
                                                    };
                                                @endphp
                         <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $statusClass }}">
                                                    {{ $pendaftar->status ?? 'Draft' }}
                                                </span>
                                            </div>
                                        </div>
                                        <div
                                            class="bg-gray-50 dark:bg-gray-800/30 p-3 rounded-lg border border-gray-100 dark:border-gray-700">
                                            <p class="text-xs text-gray-500 uppercase font-bold mb-1">Program Studi</p>
                                            <p class="text-sm text-gray-700 dark:text-gray-300 font-medium">
                                                {{ $pendaftar->pilihan_prodi ?? 'Belum memilih' }}</p>
                                        </div>
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.pendaftar.detail', $pendaftar->id) }}"
                                                class="flex items-center gap-1 text-xs font-bold text-primary hover:text-primary-dark px-3 py-1.5 rounded border border-primary/20 hover:bg-primary/5">
                                                Detail <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                                            </a>
                                        </div>
                                    </div>
                    @empty
                        <div class="p-8 text-center text-gray-500 text-sm">
                            Belum ada pendaftar baru.
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="flex flex-col gap-6">
                <div
                    class="bg-white dark:bg-gray-900 rounded-xl border border-[#f0f2f4] dark:border-gray-800 shadow-sm overflow-hidden flex flex-col">
                    <div class="h-32 bg-cover bg-center relative"
                        style='background-image: url("{{ asset("images/kampus_bg_v3.jpg") }}");'>
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                            <h3 class="text-white font-bold text-lg drop-shadow-md">Pengumuman Kampus</h3>
                        </div>
                    </div>
                    <div class="p-4 flex flex-col gap-3">
                        <div class="flex gap-3 items-start border-b border-gray-100 dark:border-gray-800 pb-3">
                            <div class="bg-primary/10 p-2 rounded text-primary">
                                <span class="material-symbols-outlined text-[20px]">campaign</span>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-[#111318] dark:text-white">Jadwal Ujian
                                    Masuk</h4>
                                <!-- DEBUG: {{ json_encode($jadwalUjian) }} | ALL: {{ \App\Models\JadwalSeleksi::count() }} -->
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $jadwalUjian ? 'Ujian akan dilaksanakan pada ' . \Carbon\Carbon::parse($jadwalUjian->tanggal)->format('d F Y') : 'Belum ada jadwal ujian yang aktif.' }}
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-3 items-start">
                            <div class="bg-orange-50 dark:bg-orange-900/20 p-2 rounded text-orange-600">
                                <span class="material-symbols-outlined text-[20px]">warning</span>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-[#111318] dark:text-white">Maintenance
                                    Server</h4>
                                <p class="text-xs text-gray-500 mt-1">Perbaikan sistem terjadwal pada akhir
                                    pekan ini.</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 bg-gray-50 dark:bg-gray-800 text-center">
                        <a href="{{ route('admin.pengumuman') }}"
                            class="text-xs font-bold text-primary hover:text-primary-dark">Lihat Semua
                            Pengumuman</a>
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-gray-900 rounded-xl border border-[#f0f2f4] dark:border-gray-800 shadow-sm p-6">
                    <h3 class="font-bold text-lg text-[#111318] dark:text-white mb-4">Prosentase Diterima</h3>
                    <div class="flex flex-col gap-4">
                        @foreach($sebaranProdi as $prodi)
                            <div class="space-y-1">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600 dark:text-gray-400">{{ $prodi['nama'] }}</span>
                                    <span class="font-bold text-[#111318] dark:text-white">{{ $prodi['percentage'] }}%</span>
                                </div>
                                <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-2">
                                    <div class="{{ $prodi['color']['bg'] }} h-2 rounded-full"
                                        style="width: {{ $prodi['percentage'] }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection