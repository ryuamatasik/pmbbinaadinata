@extends('layouts.pimpinan')

@section('title', 'Pengaturan Sistem')

@section('content')
    <div class="animate-fade-in-up delay-200">
        <h2 class="text-lg font-bold text-[#111318] dark:text-white font-display">Kebijakan Strategis</h2>
        <p class="text-sm text-gray-500">Konfigurasi parameter utama sistem pendaftaran mahasiswa baru.</p>
    </div>
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-800 rounded-lg animate-fade-in-up delay-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-fade-in-up delay-300">
        <!-- Form Periode -->
        <form action="{{ route('pimpinan.pengaturan.update') }}" method="POST"
            class="bg-white dark:bg-[#151b2b] p-6 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm">
            @csrf
            <div class="flex items-center gap-3 mb-4">
                <div
                    class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined">calendar_today</span>
                </div>
                <h3 class="font-bold text-[#111318] dark:text-white">Periode Pendaftaran</h3>
            </div>
            <div class="space-y-4">
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-bold text-gray-400 uppercase">Gelombang Aktif</label>
                    <div class="p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg border border-gray-100 dark:border-gray-700">
                        <span class="text-sm font-semibold text-[#111318] dark:text-white">
                            {{ $gelombangAktif ? $gelombangAktif->nama : 'Tidak ada gelombang aktif' }}
                        </span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-bold text-gray-400 uppercase">Mulai</label>
                        <input type="date" name="periode_start" value="{{ $periodeStart }}"
                            class="text-sm border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-bold text-gray-400 uppercase">Selesai</label>
                        <input type="date" name="periode_end" value="{{ $periodeEnd }}"
                            class="text-sm border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                    </div>
                </div>
            </div>
            <button type="submit"
                class="w-full mt-6 py-2 bg-primary hover:bg-primary-dark text-white rounded-lg text-sm font-bold transition-colors">
                Simpan Tanggal
            </button>
        </form>

        <!-- Form Kuota -->
        <form action="{{ route('pimpinan.pengaturan.update') }}" method="POST"
            class="bg-white dark:bg-[#151b2b] p-6 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm">
            @csrf
            <div class="flex items-center gap-3 mb-4">
                <div
                    class="w-10 h-10 rounded-lg bg-orange-50 dark:bg-orange-900/20 flex items-center justify-center text-orange-600">
                    <span class="material-symbols-outlined">group</span>
                </div>
                <h3 class="font-bold text-[#111318] dark:text-white">Kuota Mahasiswa</h3>
            </div>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Total Kuota Target</span>
                    <input type="number" name="target_kuota" value="{{ $kuota }}"
                        class="w-24 text-right text-sm font-bold border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                </div>
                <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2">
                    @php $percent = $kuota > 0 ? ($totalPendaftar / $kuota) * 100 : 0; @endphp
                    <div class="bg-orange-500 h-2 rounded-full" style="width: {{ $percent > 100 ? 100 : $percent }}%"></div>
                </div>
                <div class="flex justify-between text-xs text-gray-500">
                    <span>Terisi: {{ number_format($totalPendaftar) }}</span>
                    <span>Sisa: {{ number_format($kuota - $totalPendaftar) }}</span>
                </div>
                <div class="pt-2">
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-bold text-gray-400 uppercase">Status Peringatan</label>
                        <div class="flex items-center gap-2">
                            <span
                                class="text-sm font-medium text-[#111318] dark:text-white">{{ $percent >= 85 ? 'Hampir Penuh' : 'Aman' }}</span>
                            <span
                                class="px-2 py-0.5 {{ $percent >= 85 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }} text-[10px] font-bold rounded uppercase">
                                {{ $percent >= 85 ? 'Warning' : 'OK' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit"
                class="w-full mt-6 py-2 border border-primary text-primary hover:bg-primary/5 rounded-lg text-sm font-bold transition-colors">
                Update Kuota
            </button>
        </form>

        <div
            class="bg-white dark:bg-[#151b2b] p-6 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm opacity-75">
            <div class="flex items-center gap-3 mb-4">
                <div
                    class="w-10 h-10 rounded-lg bg-purple-50 dark:bg-purple-900/20 flex items-center justify-center text-purple-600">
                    <span class="material-symbols-outlined">admin_panel_settings</span>
                </div>
                <h3 class="font-bold text-[#111318] dark:text-white">Akses Admin</h3>
            </div>
            <div class="space-y-4">
                <p class="text-sm text-gray-500">Pengelolaan akses dilakukan melalui panel Admin IT.</p>
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg">
                    <span class="text-sm font-semibold text-[#111318] dark:text-white">Total Admin</span>
                    <span class="text-xs text-gray-500">{{ \App\Models\User::where('role', 'admin')->count() }}
                        Personel</span>
                </div>
            </div>
            <button disabled
                class="w-full mt-6 py-2 border border-gray-200 text-gray-400 rounded-lg text-sm font-bold cursor-not-allowed">
                Kelola di Dashboard Admin
            </button>
        </div>
    </div>
    <div
        class="bg-white dark:bg-[#151b2b] rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden animate-fade-in-up delay-700">
        <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
            <h3 class="font-bold text-[#111318] dark:text-white">Riwayat Perubahan Konfigurasi</h3>
            <button class="text-primary text-sm font-medium hover:underline">Lihat Log Audit</button>
        </div>
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead
                    class="text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                    <tr>
                        <th class="px-6 py-3 font-medium">Tanggal &amp; Waktu</th>
                        <th class="px-6 py-3 font-medium">Pengguna</th>
                        <th class="px-6 py-3 font-medium">Kategori</th>
                        <th class="px-6 py-3 font-medium">Perubahan</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="px-6 py-4 text-gray-500 whitespace-nowrap">{{ date('d M Y, H:i') }}</td>
                        <td class="px-6 py-4 font-medium text-[#111318] dark:text-white">Admin Sistem (IT)
                        </td>
                        <td class="px-6 py-4">Periode</td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">Penyesuaian batas akhir
                            pembayaran Gel. I</td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-gray-400 hover:text-primary">
                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="px-6 py-4 text-gray-500 whitespace-nowrap">
                            {{ date('d M Y, H:i', strtotime('-1 day')) }}
                        </td>
                        <td class="px-6 py-4 font-medium text-[#111318] dark:text-white">Prof. Dr. Budi S.
                        </td>
                        <td class="px-6 py-4">Kuota</td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">Penambahan kuota Prodi Teknik
                            Informatika</td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-gray-400 hover:text-primary">
                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden flex flex-col divide-y divide-gray-100 dark:divide-gray-800">
            <!-- Card 1 -->
            <div class="p-4 flex flex-col gap-3">
                <div class="flex items-start justify-between">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-500 font-bold text-xs uppercase">
                            AS
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-[#111318] dark:text-white">Admin Sistem (IT)</h4>
                            <p class="text-xs text-gray-500">{{ date('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800/30 p-3 rounded-lg border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-2 mb-1">
                        <span
                            class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 uppercase">Periode</span>
                    </div>
                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-snug">Penyesuaian batas akhir pembayaran Gel.
                        I</p>
                </div>
                <div class="flex justify-end">
                    <button class="flex items-center gap-1 text-xs font-medium text-primary hover:text-primary-dark">
                        Detail <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </button>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="p-4 flex flex-col gap-3">
                <div class="flex items-start justify-between">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-600 flex items-center justify-center font-bold text-xs uppercase">
                            BS
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-[#111318] dark:text-white">Prof. Dr. Budi S.</h4>
                            <p class="text-xs text-gray-500">{{ date('d M Y, H:i', strtotime('-1 day')) }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800/30 p-3 rounded-lg border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-2 mb-1">
                        <span
                            class="px-2 py-0.5 rounded text-[10px] font-bold bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400 uppercase">Kuota</span>
                    </div>
                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-snug">Penambahan kuota Prodi Teknik
                        Informatika</p>
                </div>
                <div class="flex justify-end">
                    <button class="flex items-center gap-1 text-xs font-medium text-primary hover:text-primary-dark">
                        Detail <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div
        class="mt-10 pt-6 border-t border-gray-200 dark:border-gray-800 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500 gap-4">
        <p>&copy; 2026 Bina Adinata. Dashboard Sistem Pendaftaran.</p>
        <div class="flex gap-4">
            <a class="hover:text-primary" href="#">Bantuan</a>
            <a class="hover:text-primary" href="#">Kebijakan Privasi</a>
        </div>
    </div>
@endsection