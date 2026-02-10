@extends('layouts.pimpinan')

@section('title', 'Unduh Laporan')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 animate-fade-in-up delay-200">
        <div>
            <h2 class="text-lg font-bold text-[#111318] dark:text-white">Daftar Laporan Akademik</h2>
            <p class="text-sm text-gray-500">Kelola dan unduh semua laporan statistik universitas</p>
        </div>
    </div>
    <div
        class="bg-white dark:bg-[#151b2b] rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden animate-fade-in-up delay-300">
        <div
            class="p-6 border-b border-gray-100 dark:border-gray-800 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h3 class="font-bold text-[#111318] dark:text-white">Daftar Laporan</h3>
            <div class="flex gap-2">
                <button
                    class="px-3 py-2 text-sm border border-gray-200 dark:border-gray-700 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">filter_list</span> Filter
                </button>
            </div>
        </div>
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead
                    class="text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                    <tr>
                        <th class="px-6 py-3 font-medium">Nama Laporan</th>
                        <th class="px-6 py-3 font-medium">Tanggal Dibuat</th>
                        <th class="px-6 py-3 font-medium">Format</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary">description</span>
                                <span class="text-[#111318] dark:text-white font-medium">Laporan Pendaftaran
                                    Semester Ganjil {{ date('Y') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ date('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-900">PDF</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('pimpinan.laporan.export', ['type' => 'pendaftar']) }}"
                                    class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-success bg-green-50 dark:bg-green-900/20 hover:bg-green-100 rounded transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">download</span>
                                    Excel
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary">description</span>
                                <span class="text-[#111318] dark:text-white font-medium">Statistik Mahasiswa
                                    Per Jurusan</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ date('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 border border-blue-200 dark:border-blue-900">XLSX</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('pimpinan.laporan.export', ['type' => 'statistik']) }}"
                                    class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-success bg-green-50 dark:bg-green-900/20 hover:bg-green-100 rounded transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">download</span>
                                    Excel
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary">description</span>
                                <span class="text-[#111318] dark:text-white font-medium">Realisasi Anggaran
                                    Penerimaan {{ date('Y') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500">{{ date('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-900">XLSX</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('pimpinan.laporan.export', ['type' => 'keuangan']) }}"
                                    class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-success bg-green-50 dark:bg-green-900/20 hover:bg-green-100 rounded transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">download</span>
                                    Excel
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden flex flex-col divide-y divide-gray-100 dark:divide-gray-800">
            <!-- Card 1 -->
            <div class="p-4 flex flex-col gap-3">
                <div class="flex items-start gap-3">
                    <div
                        class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-primary shrink-0">
                        <span class="material-symbols-outlined">description</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-[#111318] dark:text-white leading-tight">Laporan Pendaftaran
                            Semester Ganjil {{ date('Y') }}</h4>
                        <p class="text-xs text-gray-500 mt-1">{{ date('d M Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-1">
                    <span
                        class="px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 border border-red-200 dark:border-red-900">PDF</span>
                    <a href="{{ route('pimpinan.laporan.export', ['type' => 'pendaftar']) }}"
                        class="flex items-center gap-2 px-4 py-2 text-xs font-bold text-white bg-success hover:bg-green-700 rounded-lg transition-colors shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">download</span>
                        Unduh Excel
                    </a>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="p-4 flex flex-col gap-3">
                <div class="flex items-start gap-3">
                    <div
                        class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-primary shrink-0">
                        <span class="material-symbols-outlined">description</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-[#111318] dark:text-white leading-tight">Statistik Mahasiswa Per
                            Jurusan</h4>
                        <p class="text-xs text-gray-500 mt-1">{{ date('d M Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-1">
                    <span
                        class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 border border-blue-200 dark:border-blue-900">XLSX</span>
                    <a href="{{ route('pimpinan.laporan.export', ['type' => 'statistik']) }}"
                        class="flex items-center gap-2 px-4 py-2 text-xs font-bold text-white bg-success hover:bg-green-700 rounded-lg transition-colors shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">download</span>
                        Unduh Excel
                    </a>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="p-4 flex flex-col gap-3">
                <div class="flex items-start gap-3">
                    <div
                        class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-primary shrink-0">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-[#111318] dark:text-white leading-tight">Realisasi Anggaran
                            Penerimaan {{ date('Y') }}</h4>
                        <p class="text-xs text-gray-500 mt-1">{{ date('d M Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-1">
                    <span
                        class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-900">XLSX</span>
                    <a href="{{ route('pimpinan.laporan.export', ['type' => 'keuangan']) }}"
                        class="flex items-center gap-2 px-4 py-2 text-xs font-bold text-white bg-success hover:bg-green-700 rounded-lg transition-colors shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">download</span>
                        Unduh Excel
                    </a>
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