@extends('layouts.admin')

@section('title', 'Pengaturan - Dashboard Admin')

@section('content')
    <div class="p-4 md:p-8" x-data="{ activeTab: 'profil' }">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-[#111318] dark:text-white">Pengaturan Sistem</h1>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Konfigurasi profil kampus, periode
                akademik, dan keamanan akun.</p>
        </div>

        <!-- Tabs -->
        <div class="flex border-b border-gray-200 dark:border-gray-800 overflow-x-auto scrollbar-hide mb-8">
            <button @click="activeTab = 'profil'"
                :class="activeTab === 'profil' ? 'border-primary text-primary' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-primary'"
                class="px-6 py-3 text-sm font-bold border-b-2 whitespace-nowrap transition-colors">
                Profil Kampus
            </button>
            <button @click="activeTab = 'akademik'"
                :class="activeTab === 'akademik' ? 'border-primary text-primary' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-primary'"
                class="px-6 py-3 text-sm font-medium border-b-2 whitespace-nowrap transition-colors">
                Tahun Akademik
            </button>
            <button @click="activeTab = 'akun'"
                :class="activeTab === 'akun' ? 'border-primary text-primary' : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-primary'"
                class="px-6 py-3 text-sm font-medium border-b-2 whitespace-nowrap transition-colors">
                Manajemen Akun
            </button>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-lg text-sm font-bold">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-lg text-sm font-bold">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 gap-8">
            <!-- Profil Kampus -->
            <div x-show="activeTab === 'profil'" class="bg-white dark:bg-gray-900 rounded-xl border border-[#f0f2f4] dark:border-gray-800 shadow-sm">
                <div class="p-6 border-b border-[#f0f2f4] dark:border-gray-800">
                    <h3 class="font-bold text-lg text-[#111318] dark:text-white">Informasi Umum Kampus</h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.pengaturan.save_profil') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-1">
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Foto Profil
                                    Admin</label>
                                <div
                                    class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-800/50">
                                    @if(auth()->user()->profile_photo_path)
                                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" class="w-20 h-20 rounded-full object-cover mb-3" alt="Profile">
                                    @else
                                        <div
                                            class="w-20 h-20 rounded-full bg-primary/10 flex items-center justify-center text-primary mb-3">
                                            <span class="material-symbols-outlined !text-4xl">person</span>
                                        </div>
                                    @endif
                                    <input type="file" name="profile_photo" id="profile_photo" class="hidden" onchange="document.getElementById('upload-label').innerText = this.files[0].name">
                                    <label for="profile_photo" id="upload-label" class="text-xs font-bold text-primary hover:underline cursor-pointer">Ganti Foto</label>
                                </div>
                            </div>
                            <div class="md:col-span-2 space-y-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama
                                        Universitas</label>
                                    <input
                                        class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                                        type="text" name="nama_universitas" value="{{ $settings['nama_universitas'] ?? 'Bina Adinata' }}" />
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Tagline
                                        / Slogan</label>
                                    <input
                                        class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                                        type="text" name="tagline" value="{{ $settings['tagline'] ?? 'Cerdas, Berintegritas, dan Unggul' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Visi</label>
                                <textarea
                                    class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                                    rows="3" name="visi">{{ $settings['visi'] ?? 'Menjadi pusat pendidikan unggulan...' }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Misi</label>
                                <textarea
                                    class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                                    rows="4" name="misi">{{ $settings['misi'] ?? "- Pendidikan berkualitas\n- Pengembangan inovasi" }}</textarea>
                            </div>
                        </div>
                        <div class="flex justify-end pt-4 border-t border-gray-100 dark:border-gray-800">
                            <button
                                class="px-6 py-2.5 bg-primary hover:bg-primary-dark text-white rounded-lg text-sm font-bold transition-colors shadow-sm"
                                type="submit">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tahun Akademik -->
            <div x-show="activeTab === 'akademik'" class="bg-white dark:bg-gray-900 rounded-xl border border-[#f0f2f4] dark:border-gray-800 shadow-sm" style="display: none;">
                <div class="p-6 border-b border-[#f0f2f4] dark:border-gray-800 flex items-center justify-between">
                    <h3 class="font-bold text-lg text-[#111318] dark:text-white">Gelombang Pendaftaran</h3>
                    <button onclick="document.getElementById('modalGelombang').showModal()"
                        class="flex items-center gap-2 px-3 py-1.5 bg-primary/10 text-primary rounded-lg text-xs font-bold hover:bg-primary hover:text-white transition-all">
                        <span class="material-symbols-outlined text-[16px]">add</span>
                        Gelombang Baru
                    </button>
                </div>
                <div class="p-4 md:p-0"> <!-- Added Padding for Mobile -->
                    <div class="overflow-visible md:overflow-x-auto">
                        <table class="w-full text-left md:border-collapse block md:table">
                            <thead class="bg-gray-50 dark:bg-gray-800/50 hidden md:table-header-group">
                                <tr>
                                    <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500">Tahun
                                        Akademik</th>
                                    <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500">Nama
                                        Gelombang</th>
                                    <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500">Status
                                    </th>
                                    <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="block md:table-row-group space-y-4 md:space-y-0 divide-y-0 md:divide-y divide-gray-100 dark:divide-gray-800">
                                @forelse($gelombangs as $gelombang)
                                    <!-- Mobile Compact Card -->
                                    <tr class="md:hidden block bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-4 relative">
                                        <td class="block p-0 border-none">
                                            <div class="flex justify-between items-start mb-2">
                                                <div>
                                                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Tahun Akademik</p>
                                                    <p class="font-bold text-lg text-[#111318] dark:text-white">{{ $gelombang['tahun'] }}</p>
                                                </div>
                                                @if($gelombang['status'] == 'Aktif')
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-500">Aktif</span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">{{ $gelombang['status'] }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Gelombang</p>
                                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $gelombang['nama'] }}</p>
                                            </div>
                                            <div class="pt-3 border-t border-gray-100 dark:border-gray-800">
                                                <form action="{{ route('admin.pengaturan.update_gelombang_status', $gelombang['id']) }}" method="POST" class="w-full">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if($gelombang['status'] == 'Aktif')
                                                        <input type="hidden" name="status" value="Nonaktif">
                                                        <button class="w-full flex items-center justify-center gap-2 px-3 py-2 bg-red-50 text-red-600 dark:bg-red-900/20 rounded-lg text-xs font-bold transition-all">
                                                            <span class="material-symbols-outlined text-[16px]">lock</span> Tutup Pendaftaran
                                                        </button>
                                                    @else
                                                        <input type="hidden" name="status" value="Aktif">
                                                        <button class="w-full flex items-center justify-center gap-2 px-3 py-2 bg-primary/10 text-primary dark:bg-primary/20 rounded-lg text-xs font-bold transition-all">
                                                            <span class="material-symbols-outlined text-[16px]">lock_open</span> Buka Sekarang
                                                        </button>
                                                    @endif
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Desktop Table Row -->
                                    <tr class="hidden md:table-row hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                        <td class="py-4 px-6 text-sm font-medium">{{ $gelombang['tahun'] }}</td>
                                        <td class="py-4 px-6 text-sm">{{ $gelombang['nama'] }}</td>
                                        <td class="py-4 px-6">
                                            @if($gelombang['status'] == 'Aktif')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-500">Aktif</span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">{{ $gelombang['status'] }}</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            <form action="{{ route('admin.pengaturan.update_gelombang_status', $gelombang['id']) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                @if($gelombang['status'] == 'Aktif')
                                                    <input type="hidden" name="status" value="Nonaktif">
                                                    <button class="text-red-600 text-xs font-bold hover:underline">Tutup</button>
                                                @else
                                                    <input type="hidden" name="status" value="Aktif">
                                                    <button class="text-primary text-xs font-bold hover:underline">Buka Sekarang</button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada gelombang
                                            pendaftaran.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Manajemen Akun -->
            <div x-show="activeTab === 'akun'" class="bg-white dark:bg-gray-900 rounded-xl border border-[#f0f2f4] dark:border-gray-800 shadow-sm" style="display: none;">
                <div class="p-6 border-b border-[#f0f2f4] dark:border-gray-800">
                    <h3 class="font-bold text-lg text-[#111318] dark:text-white">Keamanan &amp; Akun Admin
                    </h3>
                </div>
                <div class="p-6 space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h4 class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-4">Email
                                Administrator</h4>
                            <div class="flex gap-3">
                                <div class="flex-1">
                                    <input
                                        class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                                        type="email" value="{{ auth()->user()->email }}" disabled />
                                </div>
                                <button
                                    class="px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-bold">Verifikasi</button>
                            </div>
                        </div>
                        <div>
                            <form action="{{ route('admin.pengaturan.update_akun') }}" method="POST">
                                @csrf
                                <h4 class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-4">Ubah Kata
                                    Sandi</h4>
                                <div class="space-y-3">
                                    <input
                                        class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                                        placeholder="Kata Sandi Lama" name="old_password" type="password" required />
                                    <input
                                        class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                                        placeholder="Kata Sandi Baru" name="new_password" type="password" required />
                                    <input
                                        class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                                        placeholder="Konfirmasi Kata Sandi Baru" name="new_password_confirmation" type="password" required />
                                    <button
                                        class="w-full py-2 bg-primary/10 text-primary hover:bg-primary hover:text-white rounded-lg text-sm font-bold transition-all">Ganti
                                        Kata Sandi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Gelombang Baru -->
    <dialog id="modalGelombang" class="modal rounded-xl p-0 backdrop:bg-black/50 w-full max-w-md">
        <div class="bg-white dark:bg-gray-900">
            <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
                <h3 class="font-bold text-lg dark:text-white">Tambah Gelombang</h3>
                <button onclick="document.getElementById('modalGelombang').close()" class="text-gray-400 hover:text-gray-600">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form action="{{ route('admin.pengaturan.store_gelombang') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Tahun Akademik</label>
                    <input type="text" name="tahun" placeholder="Contoh: 2024/2025" class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama Gelombang</label>
                    <input type="text" name="nama" placeholder="Contoh: Gelombang 1" class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary" required>
                </div>
                <div class="pt-4">
                    <button class="w-full py-2.5 bg-primary hover:bg-primary-dark text-white rounded-lg text-sm font-bold transition-colors">Simpan Gelombang</button>
                </div>
            </form>
        </div>
    </dialog>
@endsection