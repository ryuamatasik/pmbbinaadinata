@extends('layouts.pimpinan')

@section('title', 'Dashboard Pimpinan')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 animate-fade-in-up delay-200">
        <div>
            <h2 class="text-lg font-bold text-[#111318] dark:text-white">Statistik Penerimaan Mahasiswa Baru</h2>
            <p class="text-sm text-gray-500">Update data terakhir: {{ now()->format('d M Y, H:i') }} WIB</p>
        </div>
        <div
            class="hidden md:flex items-center bg-white dark:bg-[#151b2b] rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-1">
            <button
                class="px-3 py-1.5 text-xs font-medium rounded bg-gray-100 dark:bg-gray-800 text-[#111318] dark:text-white">Hari
                Ini</button>
            <button
                class="px-3 py-1.5 text-xs font-medium rounded text-gray-500 hover:text-primary transition-colors">Minggu
                Ini</button>
            <button class="px-3 py-1.5 text-xs font-medium rounded text-gray-500 hover:text-primary transition-colors">Bulan
                Ini</button>
            <button class="px-3 py-1.5 text-xs font-medium rounded text-gray-500 hover:text-primary transition-colors">Tahun
                Ini</button>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 animate-fade-in-up delay-300">
        <div
            class="bg-white dark:bg-[#151b2b] p-5 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col gap-2">
            <div class="flex justify-between items-start">
                <div
                    class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined">group_add</span>
                </div>
                <span
                    class="flex items-center text-xs font-bold text-success bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded-full">
                    <span class="material-symbols-outlined text-[14px] mr-1">trending_up</span>
                    +12.5%
                </span>
            </div>
            <div>
                <h3 class="text-3xl font-bold text-[#111318] dark:text-white font-display">
                    {{ number_format($totalPendaftar) }}
                </h3>
                <p class="text-sm text-gray-500 font-medium">Total Pendaftar</p>
            </div>
        </div>
        <div
            class="bg-white dark:bg-[#151b2b] p-5 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col gap-2">
            <div class="flex justify-between items-start">
                <div
                    class="w-10 h-10 rounded-lg bg-indigo-50 dark:bg-indigo-900/20 flex items-center justify-center text-indigo-600">
                    <span class="material-symbols-outlined">assignment_turned_in</span>
                </div>
                <span
                    class="flex items-center text-xs font-bold text-success bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded-full">
                    <span class="material-symbols-outlined text-[14px] mr-1">trending_up</span>
                    +8.2%
                </span>
            </div>
            <div>
                <h3 class="text-3xl font-bold text-[#111318] dark:text-white font-display">
                    {{ number_format($totalLolos) }}
                </h3>
                <p class="text-sm text-gray-500 font-medium">Lolos Seleksi</p>
            </div>
        </div>
        <div
            class="bg-white dark:bg-[#151b2b] p-5 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col gap-2">
            <div class="flex justify-between items-start">
                <div
                    class="w-10 h-10 rounded-lg bg-orange-50 dark:bg-orange-900/20 flex items-center justify-center text-orange-600">
                    <span class="material-symbols-outlined">pie_chart</span>
                </div>
                <span class="text-xs text-gray-400 font-medium pt-1">Target: 3,500</span>
            </div>
            <div>
                <h3 class="text-3xl font-bold text-[#111318] dark:text-white font-display">
                    {{ number_format($persentaseKuota, 1) }}%
                </h3>
                <p class="text-sm text-gray-500 font-medium">Kuota Terisi</p>
            </div>
            <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-1.5 mt-1">
                <div class="bg-orange-500 h-1.5 rounded-full" style="width: {{ $persentaseKuota }}%"></div>
            </div>
        </div>
        <div
            class="bg-white dark:bg-[#151b2b] p-5 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col gap-2">
            <div class="flex justify-between items-start">
                <div
                    class="w-10 h-10 rounded-lg bg-green-50 dark:bg-green-900/20 flex items-center justify-center text-green-600">
                    <span class="material-symbols-outlined">payments</span>
                </div>
                <span
                    class="flex items-center text-xs font-bold text-success bg-green-50 dark:bg-green-900/20 px-2 py-1 rounded-full">
                    <span class="material-symbols-outlined text-[14px] mr-1">trending_up</span>
                    +24%
                </span>
            </div>
            <div>
                <h3 class="text-3xl font-bold text-[#111318] dark:text-white font-display">Rp
                    {{ number_format($pendapatan, 0, ',', '.') }}
                </h3>
                <p class="text-sm text-gray-500 font-medium">Pendapatan Pendaftaran</p>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-fade-in-up delay-500">
        <div
            class="lg:col-span-2 bg-white dark:bg-[#151b2b] p-6 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-[#111318] dark:text-white">Tren Pendaftaran Harian</h3>
                <button class="text-primary text-sm font-medium hover:underline">Lihat Detail</button>
            </div>
            <!-- Dynamic Chart -->
            <div class="flex items-end justify-between h-64 gap-2 sm:gap-4 mt-4">
                @php $maxDaily = collect($dailyStats)->max('count');
                    if ($maxDaily == 0)
                $maxDaily = 1; @endphp
                @foreach($dailyStats as $stat)
                    @php $height = ($stat['count'] / $maxDaily) * 100; @endphp
                    <div class="flex flex-col items-center gap-2 flex-1 group cursor-pointer"
                        title="{{ $stat['count'] }} Pendaftar">
                        <div class="w-full bg-primary/20 dark:bg-primary/20 rounded-t-sm relative h-{{ $loop->index % 2 == 0 ? '32' : '40' }} group-hover:bg-primary/40 transition-colors"
                            style="height: 180px">
                            <!-- Helper container height fixed, inner bar dynamic -->
                            <div class="absolute bottom-0 w-full bg-primary rounded-t-sm transition-all duration-500"
                                style="height: {{ $height < 5 ? 5 : $height }}%"></div>
                        </div>
                        <span
                            class="text-xs text-gray-400 {{ $loop->last ? 'font-bold text-primary' : '' }}">{{ $stat['day'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
        <div
            class="bg-white dark:bg-[#151b2b] p-6 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col">
            <h3 class="font-bold text-[#111318] dark:text-white mb-6">Program Studi Terfavorit</h3>
            <div class="flex flex-col gap-6">
                <!-- Dynamic Prodi Stats -->
                @forelse($prodiStats as $stat)
                    <div class="flex flex-col gap-1">
                        <div class="flex justify-between text-sm mb-1">
                            <span
                                class="font-medium text-[#111318] dark:text-white">{{ $stat->pilihan_prodi ?? 'Tidak Ada Data' }}</span>
                            <span class="text-gray-500">{{ $stat->count }} pendaftar</span>
                        </div>
                        <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2">
                            @php $percent = ($totalPendaftar > 0) ? ($stat->count / $totalPendaftar) * 100 : 0; @endphp
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Belum ada data program studi.</p>
                @endforelse
            </div>
            <button class="mt-auto pt-6 text-primary text-sm font-medium hover:underline text-center w-full">Lihat
                Semua Prodi</button>
        </div>
    </div>
    <div
        class="bg-white dark:bg-[#151b2b] rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden animate-fade-in-up delay-700">
        <div class="p-6 border-b border-gray-100 dark:border-gray-800">
            <h3 class="font-bold text-[#111318] dark:text-white">Ringkasan Statistik per Gelombang</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead
                    class="text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                    <tr>
                        <th class="px-6 py-3 font-medium">Gelombang Pendaftaran</th>
                        <th class="px-6 py-3 font-medium text-center">Tahun</th>
                        <th class="px-6 py-3 font-medium text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($gelombangs as $gelombang)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-[#111318] dark:text-white">{{ $gelombang->nama }}</td>
                            <td class="px-6 py-4 text-center text-gray-500">{{ $gelombang->tahun }}</td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="px-2.5 py-1 rounded-full text-xs font-medium {{ $gelombang->status == 'Aktif' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $gelombang->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">Belum ada data gelombang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pendaftar Realtime Table (Responsive & Fixes) -->
    <div
        class="bg-white dark:bg-[#151b2b] rounded-xl border border-gray-100 dark:border-gray-100 shadow-sm overflow-hidden animate-fade-in-up delay-700 mt-6">
        <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h3 class="font-bold text-[#111318] dark:text-white">Pendaftar Terbaru</h3>
        </div>

        <!-- Desktop View (Table) -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead
                    class="text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                    <tr>
                        <th class="px-6 py-3 font-medium">No</th>
                        <th class="px-6 py-3 font-medium">Nama Calon Mahasiswa</th>
                        <th class="px-6 py-3 font-medium">Program Studi</th>
                        <th class="px-6 py-3 font-medium">Asal Sekolah</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium">Tanggal</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($recentPendaftar as $pendaftar)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-[#111318] dark:text-white">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-600 flex items-center justify-center font-bold text-xs uppercase">
                                        {{ substr($pendaftar->nama_lengkap ?? 'X', 0, 2) }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[#111318] dark:text-white font-medium">{{ $pendaftar->nama_lengkap }}</span>
                                        <span class="text-xs text-gray-400">#REG-{{ $pendaftar->created_at->year }}-{{ $pendaftar->id }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                {{ $pendaftar->pilihan_prodi }}
                            </td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                {{ $pendaftar->nama_sekolah }}
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-900">
                                    {{ ucfirst($pendaftar->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $pendaftar->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('pimpinan.pendaftar.detail', $pendaftar->id) }}"
                                    class="text-gray-400 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-400">Belum ada data pendaftar
                                terbaru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile View (Cards) -->
        <div class="md:hidden flex flex-col divide-y divide-gray-100 dark:divide-gray-800">
            @forelse($recentPendaftar as $pendaftar)
                <div class="p-4 flex flex-col gap-3">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold text-gray-400">#{{ $loop->iteration }}</span>
                            <div
                                class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-600 flex items-center justify-center font-bold text-sm uppercase">
                                {{ substr($pendaftar->nama_lengkap ?? 'X', 0, 2) }}
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-[#111318] dark:text-white">{{ $pendaftar->nama_lengkap }}</h4>
                                <p class="text-xs text-gray-500">ID: #REG-{{ $pendaftar->created_at->year }}-{{ $pendaftar->id }}</p>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-900">
                            {{ ucfirst($pendaftar->status) }}
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 text-xs text-gray-600 dark:text-gray-400 mt-1">
                        <div>
                            <span class="block text-gray-400 text-[10px] uppercase">Program Studi</span>
                            {{ $pendaftar->pilihan_prodi }}
                        </div>
                        <div>
                            <span class="block text-gray-400 text-[10px] uppercase">Sekolah</span>
                            {{ $pendaftar->nama_sekolah }}
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-1">
                        <span class="text-xs text-gray-400">{{ $pendaftar->created_at->format('d M Y') }}</span>
                        <a href="{{ route('pimpinan.pendaftar.detail', $pendaftar->id) }}"
                           class="flex items-center gap-1 text-xs font-medium text-primary hover:text-primary-dark">
                            Detail <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-gray-400 text-sm">
                    Belum ada data pendaftar terbaru.
                </div>
            @endforelse
        </div>

        <div class="p-4 border-t border-gray-100 dark:border-gray-800 flex justify-center">
            <a href="{{ route('pimpinan.laporan') }}"
                class="text-sm font-medium text-primary hover:text-primary-dark transition-colors flex items-center gap-1">
                Lihat Semua Pendaftar <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="mt-8 pt-6 pb-6 border-t border-gray-200 dark:border-gray-800 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500 gap-4">
        <p>&copy; 2026 Bina Adinata. Dashboard Sistem Pendaftaran.</p>
        <div class="flex gap-4">
            <a class="hover:text-primary transition-colors" href="#">Bantuan</a>
            <a class="hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
        </div>
    </div>
@endsection