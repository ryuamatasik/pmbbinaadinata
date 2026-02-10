@extends('layouts.admin')

@section('title', 'Data Calon Mahasiswa - Admin Portal')

@section('content')
    <div class="p-4 md:p-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div class="flex flex-col gap-1">
                <h2 class="text-[#111318] dark:text-white text-2xl md:text-3xl font-black tracking-tight">Data Calon
                    Mahasiswa</h2>
                <p class="text-[#616f89] text-sm md:text-base">Kelola seluruh data pendaftaran calon mahasiswa baru
                    angkatan 2024/2025.</p>
            </div>
            <div class="flex gap-3 self-start md:self-auto">
                <a href="{{ route('admin.data_calon_mahasiswa.export') }}" target="_blank"
                    class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-[#1a212e] border border-gray-200 dark:border-gray-700 text-[#111318] dark:text-white rounded-lg font-bold text-xs md:text-sm hover:bg-gray-50 dark:hover:bg-gray-800 transition-all">
                    <span class="material-symbols-outlined text-[18px] md:text-[20px]">download</span>
                    <span>Export</span>
                </a>
                <button
                    class="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg font-bold text-xs md:text-sm shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all">
                    <span class="material-symbols-outlined text-[18px] md:text-[20px]">add</span>
                    <span>Tambah</span>
                </button>
            </div>
        </div>
        <div
            class="bg-transparent md:bg-white md:dark:bg-[#1a212e] rounded-xl border-none md:border md:border-[#e5e7eb] md:dark:border-gray-800 md:p-6 mb-6">
            <form method="GET" action="{{ route('admin.data_calon_mahasiswa') }}"
                class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6 md:mb-0">
                <div class="md:col-span-1">
                    <label class="block text-xs font-semibold text-[#616f89] uppercase mb-2">Pencarian</label>
                    <div class="relative group">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#616f89] text-[20px] group-focus-within:text-primary transition-colors">search</span>
                        <input name="search" value="{{ request('search') }}"
                            class="w-full pl-10 pr-4 py-2 bg-white md:bg-background-light dark:bg-gray-800 border md:border-none border-gray-200 dark:border-gray-700 rounded-lg text-sm focus:ring-2 focus:ring-primary transition-all"
                            placeholder="Cari Nama atau No. Daftar..." type="text" />
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#616f89] uppercase mb-2">Tahun
                        Akademik</label>
                    <select name="tahun"
                        class="w-full flex items-center justify-between px-4 py-2 bg-white md:bg-background-light dark:bg-gray-800 border md:border-none border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium focus:ring-primary">
                        <option value="2024/2025">2024/2025</option>
                        <option value="2023/2024">2023/2024</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#616f89] uppercase mb-2">Program
                        Studi</label>
                    <select name="prodi" onchange="this.form.submit()"
                        class="w-full flex items-center justify-between px-4 py-2 bg-white md:bg-background-light dark:bg-gray-800 border md:border-none border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium focus:ring-primary">
                        <option value="">Semua Program Studi</option>
                        <option value="Sistem Informasi S1" {{ request('prodi') == 'Sistem Informasi S1' ? 'selected' : '' }}>
                            Sistem Informasi S1</option>
                        <option value="Sistem Komputer S1" {{ request('prodi') == 'Sistem Komputer S1' ? 'selected' : '' }}>
                            Sistem Komputer S1</option>
                        <option value="Bisnis Digital S1" {{ request('prodi') == 'Bisnis Digital S1' ? 'selected' : '' }}>
                            Bisnis Digital S1</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#616f89] uppercase mb-2">Status
                        Verifikasi</label>
                    <select name="status" onchange="this.form.submit()"
                        class="w-full flex items-center justify-between px-4 py-2 bg-white md:bg-background-light dark:bg-gray-800 border md:border-none border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium focus:ring-primary">
                        <option value="">Semua Status</option>
                        <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                        <option value="Verifikasi" {{ request('status') == 'Verifikasi' ? 'selected' : '' }}>Verifikasi
                        </option>
                        <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <button type="submit" class="hidden">Filter</button>
            </form>

            <div class="overflow-visible md:overflow-x-auto">
                <table class="w-full text-left md:border-collapse block md:table">
                    <thead class="hidden md:table-header-group">
                        <tr class="border-b border-[#e5e7eb] dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/30">
                            <th class="px-6 py-4 text-xs font-bold text-[#616f89] uppercase tracking-wider">No
                            </th>
                            <th class="px-6 py-4 text-xs font-bold text-[#616f89] uppercase tracking-wider">Nama
                                Lengkap</th>
                            <th class="px-6 py-4 text-xs font-bold text-[#616f89] uppercase tracking-wider">
                                Jalur Masuk</th>
                            <th class="px-6 py-4 text-xs font-bold text-[#616f89] uppercase tracking-wider">
                                Program Studi</th>
                            <th class="px-6 py-4 text-xs font-bold text-[#616f89] uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-4 text-xs font-bold text-[#616f89] uppercase tracking-wider text-center">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody
                        class="block md:table-row-group space-y-4 md:space-y-0 divide-y-0 md:divide-y divide-[#e5e7eb] dark:divide-gray-800">
                        @forelse($pendaftars as $index => $pendaftar)
                                            <!-- Mobile Compact Card View -->
                                            <tr
                                                class="md:hidden block bg-white dark:bg-[#1a212e] rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-4 relative">
                                                <td class="block p-0 border-none">
                                                    <!-- Card Header: Profile & Status -->
                                                    <div class="flex justify-between items-start mb-3">
                                                        <div class="flex items-center gap-3">
                                                            <div
                                                                class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-sm uppercase shrink-0">
                                                                {{ substr($pendaftar->nama_lengkap ?? 'Unknown', 0, 2) }}
                                                            </div>
                                                            <div>
                                                                <h4
                                                                    class="text-sm font-bold text-[#111318] dark:text-white line-clamp-1 break-all">
                                                                    {{ $pendaftar->nama_lengkap }}</h4>
                                                                <p class="text-[11px] text-[#616f89]">
                                                                    {{ $pendaftar->nomor_pendaftaran ?? 'N/A' }}</p>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $statusClass = match ($pendaftar->status) {
                                                                'Diterima' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                                                                'Ditolak' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                                                                'Verifikasi' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                                                                default => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400'
                                                            };
                                                        @endphp
                             <span
                                                            class="px-2 py-1 rounded-md {{ $statusClass }} text-[10px] font-bold uppercase tracking-wide shrink-0">
                                                            {{ $pendaftar->status }}
                                                        </span>
                                                    </div>

                                                    <!-- Card Body: Details -->
                                                    <div class="space-y-2 mb-4">
                                                        <div class="flex items-start gap-2 text-xs text-slate-600 dark:text-slate-400">
                                                            <span
                                                                class="material-symbols-outlined text-[16px] text-slate-400 shrink-0">school</span>
                                                            <span class="line-clamp-2">{{ $pendaftar->pilihan_prodi }}</span>
                                                        </div>
                                                        <div class="flex items-center gap-2 text-xs text-slate-600 dark:text-slate-400">
                                                            <span
                                                                class="material-symbols-outlined text-[16px] text-slate-400 shrink-0">payments</span>
                                                            <span
                                                                class="{{ $pendaftar->status_pembayaran == 'lunas' ? 'text-green-600 font-bold' : 'text-slate-500' }}">
                                                                {{ $pendaftar->status_pembayaran == 'lunas' ? 'Lunas' : 'Belum Bayar' }}
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <!-- Card Footer: Actions -->
                                                    <div
                                                        class="flex items-center justify-between pt-3 border-t border-gray-100 dark:border-gray-700/50">
                                                        <div class="text-[10px] uppercase font-bold text-slate-400">
                                                            {{ $pendaftar->updated_at->diffForHumans() }}
                                                        </div>
                                                        <div class="flex gap-1">
                                                            <form action="{{ route('admin.pendaftar.toggle_bayar', $pendaftar->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit"
                                                                    class="p-2 {{ $pendaftar->status_pembayaran == 'lunas' ? 'bg-green-50 text-green-600 dark:bg-green-900/20' : 'bg-gray-50 text-gray-400 dark:bg-gray-800' }} rounded-lg"
                                                                    title="Pembayaran">
                                                                    <span
                                                                        class="material-symbols-outlined text-[18px]">{{ $pendaftar->status_pembayaran == 'lunas' ? 'paid' : 'money_off' }}</span>
                                                                </button>
                                                            </form>
                                                            <a href="{{ route('admin.pendaftar.detail', $pendaftar->id) }}"
                                                                class="p-2 bg-blue-50 text-blue-600 dark:bg-blue-900/20 rounded-lg"
                                                                title="Detail">
                                                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                                                            </a>
                                                            <a href="{{ route('admin.pendaftar.edit', $pendaftar->id) }}"
                                                                class="p-2 bg-amber-50 text-amber-600 dark:bg-amber-900/20 rounded-lg"
                                                                title="Edit">
                                                                <span class="material-symbols-outlined text-[18px]">edit</span>
                                                            </a>
                                                            <button type="button"
                                                                onclick="openConfirmModal('{{ route('admin.pendaftar.destroy', $pendaftar->id) }}', 'Hapus Data?', 'Hapus data {{ $pendaftar->nama_lengkap }}?', 'DELETE', 'red')"
                                                                class="p-2 bg-red-50 text-red-600 dark:bg-red-900/20 rounded-lg">
                                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Desktop Table Row View -->
                                            <tr class="hidden md:table-row hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                                <td class="px-6 py-4 text-sm font-medium border-b border-[#e5e7eb] dark:border-gray-800">
                                                    {{ $pendaftars->firstItem() + $index }}</td>
                                                <td class="px-6 py-4 border-b border-[#e5e7eb] dark:border-gray-800">
                                                    <div class="flex items-center gap-3">
                                                        <div
                                                            class="w-8 h-8 rounded-full bg-primary/20 text-primary flex items-center justify-center font-bold text-xs uppercase">
                                                            {{ substr($pendaftar->nama_lengkap ?? 'Unknown', 0, 2) }}
                                                        </div>
                                                        <div>
                                                            <p class="text-sm font-bold text-[#111318] dark:text-white">
                                                                {{ $pendaftar->nama_lengkap }}
                                                            </p>
                                                            <p class="text-[11px] text-[#616f89]">{{ $pendaftar->nomor_pendaftaran ?? 'N/A' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-sm border-b border-[#e5e7eb] dark:border-gray-800">Mandiri</td>
                                                <td class="px-6 py-4 text-sm font-medium border-b border-[#e5e7eb] dark:border-gray-800 max-w-[200px] truncate"
                                                    title="{{ $pendaftar->pilihan_prodi }}">
                                                    {{ $pendaftar->pilihan_prodi }}
                                                </td>
                                                <td class="px-6 py-4 border-b border-[#e5e7eb] dark:border-gray-800">
                                                    @php
                                                        $statusClass = match ($pendaftar->status) {
                                                            'Diterima' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                                                            'Ditolak' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                                                            'Verifikasi' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                                                            default => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400'
                                                        };
                                                    @endphp
                             <span
                                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full {{ $statusClass }} text-xs font-bold">
                                                        <span class="w-1 h-1 rounded-full bg-current"></span>
                                                        {{ $pendaftar->status }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 border-b border-[#e5e7eb] dark:border-gray-800">
                                                    <div class="flex justify-center gap-2">
                                                        <form action="{{ route('admin.pendaftar.toggle_bayar', $pendaftar->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="p-1.5 {{ $pendaftar->status_pembayaran == 'lunas' ? 'text-green-600 hover:bg-green-50 dark:hover:bg-green-900/20' : 'text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800' }} rounded-md transition-all"
                                                                title="{{ $pendaftar->status_pembayaran == 'lunas' ? 'Sudah Lunas (Klik untuk batalkan)' : 'Belum Bayar (Klik untuk lunas)' }}">
                                                                <span
                                                                    class="material-symbols-outlined text-[20px]">{{ $pendaftar->status_pembayaran == 'lunas' ? 'paid' : 'money_off' }}</span>
                                                            </button>
                                                        </form>
                                                        <a href="{{ route('admin.pendaftar.detail', $pendaftar->id) }}"
                                                            class="p-1.5 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-md transition-all"
                                                            title="Lihat Detail">
                                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                                        </a>
                                                        <a href="{{ route('admin.pendaftar.edit', $pendaftar->id) }}"
                                                            class="p-1.5 text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-900/20 rounded-md transition-all"
                                                            title="Edit">
                                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                                        </a>
                                                        <button type="button"
                                                            onclick="openConfirmModal('{{ route('admin.pendaftar.destroy', $pendaftar->id) }}', 'Hapus Data?', 'Apakah Anda yakin ingin menghapus data calon mahasiswa {{ $pendaftar->nama_lengkap }}? Tindakan ini tidak dapat dibatalkan.', 'DELETE', 'red')"
                                                            class="p-1.5 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-md transition-all inline-block"
                                                            title="Hapus">
                                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data pendaftar ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-0 md:px-6 py-4 md:border-t border-[#e5e7eb] dark:border-gray-800">
                {{ $pendaftars->links() }}
            </div>
        </div>
        <footer class="mt-auto px-8 py-6 text-center text-[#616f89] text-xs">
            <p class="text-sm text-slate-500 dark:text-slate-400">© 2026 Bina Adinata. All rights reserved.</p>
        </footer>
    </div>
@endsection