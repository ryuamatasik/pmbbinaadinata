@extends('layouts.admin')

@section('title', 'Jadwal Seleksi - Dashboard Admin')

@section('content')
    <div class="p-4 md:p-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div class="flex flex-col gap-1">
                <h1 class="text-2xl font-bold text-[#111318] dark:text-white">Jadwal Seleksi</h1>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Kelola dan atur jadwal ujian
                    seleksi mahasiswa baru.</p>
            </div>
            <button onclick="document.getElementById('modalTambah').showModal()"
                class="flex items-center justify-center gap-2 px-4 py-2 bg-primary hover:bg-primary-dark text-white rounded-lg text-sm font-medium transition-colors shadow-sm w-full md:w-auto">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Tambah Jadwal
            </button>
        </div>

        @if(session('success'))
            <div
                class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-lg text-sm font-bold">
                {{ session('success') }}
            </div>
        @endif

        <div
            class="bg-transparent md:bg-white md:dark:bg-gray-900 rounded-xl border-none md:border md:border-[#f0f2f4] md:dark:border-gray-800 shadow-sm overflow-hidden mb-6">
            <div
                class="p-0 md:p-6 md:border-b border-[#f0f2f4] dark:border-gray-800 flex flex-col md:flex-row items-start md:items-center justify-between bg-transparent md:bg-white md:dark:bg-gray-900 gap-4 mb-4 md:mb-0">
                <h3 class="font-bold text-lg text-[#111318] dark:text-white hidden md:block">Daftar Jadwal Seleksi</h3>
                <div class="flex items-center gap-2 w-full md:w-auto">
                    <div class="relative w-full md:w-auto">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">search</span>
                        <input
                            class="pl-10 pr-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary bg-white dark:bg-gray-800 dark:text-white w-full md:w-64"
                            placeholder="Cari seleksi..." type="text" />
                    </div>
                </div>
            </div>
            <div class="overflow-visible md:overflow-x-auto">
                <table class="w-full text-left md:border-collapse block md:table">
                    <thead class="bg-gray-50 dark:bg-gray-800/50 hidden md:table-header-group">
                        <tr>
                            <th class="py-3 px-6 text-xs font-bold uppercase text-gray-500 dark:text-gray-400">
                                #</th>
                            <th class="py-3 px-6 text-xs font-bold uppercase text-gray-500 dark:text-gray-400">
                                Nama Seleksi</th>
                            <th class="py-3 px-6 text-xs font-bold uppercase text-gray-500 dark:text-gray-400">
                                Tanggal</th>
                            <th class="py-3 px-6 text-xs font-bold uppercase text-gray-500 dark:text-gray-400">
                                Waktu</th>
                            <th class="py-3 px-6 text-xs font-bold uppercase text-gray-500 dark:text-gray-400">
                                Lokasi</th>
                            <th class="py-3 px-6 text-xs font-bold uppercase text-gray-500 dark:text-gray-400 text-center">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody
                        class="block md:table-row-group space-y-4 md:space-y-0 divide-y-0 md:divide-y divide-[#f0f2f4] dark:divide-gray-800">
                        @forelse($jadwals as $index => $jadwal)
                            <!-- Mobile Compact Card -->
                            <tr
                                class="md:hidden block bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-4">
                                <td class="block p-0 border-none">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h4 class="text-sm font-bold text-[#111318] dark:text-white line-clamp-1">
                                                {{ $jadwal->nama }}</h4>
                                            <div class="flex items-center gap-1.5 mt-1">
                                                <span class="material-symbols-outlined text-[14px] text-primary">event</span>
                                                <span
                                                    class="text-xs text-gray-600 dark:text-gray-400 font-medium">{{ $jadwal->tanggal }}</span>
                                            </div>
                                        </div>
                                        <div class="flex gap-1 shrink-0">
                                            <button onclick="editJadwal({{ $jadwal }})"
                                                class="p-1.5 bg-amber-50 text-amber-600 dark:bg-amber-900/20 rounded-md"
                                                title="Edit">
                                                <span class="material-symbols-outlined text-[18px]">edit</span>
                                            </button>
                                            <button
                                                onclick="openConfirmModal('{{ route('admin.jadwal_seleksi.destroy', $jadwal->id) }}', 'Hapus Jadwal?', 'Hapus {{ $jadwal->nama }}?', 'DELETE', 'red')"
                                                class="p-1.5 bg-red-50 text-red-600 dark:bg-red-900/20 rounded-md"
                                                title="Hapus">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div
                                        class="grid grid-cols-2 gap-3 text-xs border-t border-gray-100 dark:border-gray-800 pt-3">
                                        <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                                            <span class="material-symbols-outlined text-[16px] text-gray-400">schedule</span>
                                            <span>{{ $jadwal->waktu }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                                            <span class="material-symbols-outlined text-[16px] text-gray-400">location_on</span>
                                            <span class="truncate">{{ $jadwal->lokasi }}</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Desktop Table Row -->
                            <tr class="hidden md:table-row hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-700 dark:text-gray-300 font-medium">{{ $jadwal->nama }}
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-600 dark:text-gray-400">{{ $jadwal->tanggal }}
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-600 dark:text-gray-400">{{ $jadwal->waktu }}
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-600 dark:text-gray-400">{{ $jadwal->lokasi }}</td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="editJadwal({{ $jadwal }})"
                                            class="p-2 text-gray-500 hover:text-amber-600 transition-colors rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800"
                                            title="Edit">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </button>
                                        <button type="button"
                                            onclick="openConfirmModal('{{ route('admin.jadwal_seleksi.destroy', $jadwal->id) }}', 'Hapus Jadwal?', 'Apakah Anda yakin ingin menghapus jadwal {{ $jadwal->nama }}? Tindakan ini tidak dapat dibatalkan.', 'DELETE', 'red')"
                                            class="p-2 text-gray-500 hover:text-red-600 transition-colors rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800"
                                            title="Hapus">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada jadwal seleksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div
                class="p-4 border-t border-[#f0f2f4] dark:border-gray-800 bg-gray-50 dark:bg-gray-800/50 flex items-center justify-between">
                <p class="text-sm text-gray-500 dark:text-gray-400">Menampilkan {{ count($jadwals) }} jadwal</p>
            </div>
        </div>

        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div
                class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-xl border border-blue-100 dark:border-blue-800/50 flex items-start gap-4">
                <div
                    class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-800 flex items-center justify-center text-blue-600 dark:text-blue-400 flex-none">
                    <span class="material-symbols-outlined">info</span>
                </div>
                <div>
                    <h4 class="font-bold text-blue-900 dark:text-blue-100 text-sm">Informasi Penting</h4>
                    <p class="text-blue-700 dark:text-blue-300 text-xs mt-1 leading-relaxed">Pastikan lokasi
                        ujian telah diverifikasi oleh bagian sarana prasarana sebelum jadwal diumumkan
                        kepada
                        calon mahasiswa.</p>
                </div>
            </div>
            <div
                class="bg-amber-50 dark:bg-amber-900/20 p-6 rounded-xl border border-amber-100 dark:border-amber-800/50 flex items-start gap-4">
                <div
                    class="w-10 h-10 rounded-lg bg-amber-100 dark:bg-amber-800 flex items-center justify-center text-amber-600 dark:text-amber-400 flex-none">
                    <span class="material-symbols-outlined">notification_important</span>
                </div>
                <div>
                    <h4 class="font-bold text-amber-900 dark:text-amber-100 text-sm">Pemberitahuan Otomatis
                    </h4>
                    <p class="text-amber-700 dark:text-amber-300 text-xs mt-1 leading-relaxed">Email
                        notifikasi jadwal akan dikirimkan H-3 sebelum tanggal seleksi kepada pendaftar yang
                        telah terverifikasi.</p>
                </div>
            </div>
            <div
                class="bg-green-50 dark:bg-green-900/20 p-6 rounded-xl border border-green-100 dark:border-green-800/50 flex items-start gap-4">
                <div
                    class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-800 flex items-center justify-center text-green-600 dark:text-green-400 flex-none">
                    <span class="material-symbols-outlined">how_to_reg</span>
                </div>
                <div>
                    <h4 class="font-bold text-green-900 dark:text-green-100 text-sm">Monitoring Peserta</h4>
                    <p class="text-green-700 dark:text-green-300 text-xs mt-1 leading-relaxed">Admin dapat
                        memantau kehadiran peserta secara real-time melalui menu detail di setiap jadwal
                        seleksi.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Jadwal -->
    <dialog id="modalTambah" class="modal rounded-xl p-0 backdrop:bg-black/50 w-full max-w-lg">
        <div class="bg-white dark:bg-gray-900">
            <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
                <h3 class="font-bold text-lg dark:text-white">Tambah Jadwal Seleksi</h3>
                <button onclick="document.getElementById('modalTambah').close()" class="text-gray-400 hover:text-gray-600">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form action="{{ route('admin.jadwal_seleksi.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama Seleksi</label>
                    <input type="text" name="nama" placeholder="Contoh: Ujian TPA Gelombang 1"
                        class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                        required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Tanggal</label>
                        <input type="date" name="tanggal"
                            class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Waktu w/ Zona</label>
                        <input type="text" name="waktu" placeholder="08:00 - 10:00 WIB"
                            class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                            required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Lokasi</label>
                    <input type="text" name="lokasi" placeholder="Contoh: Gedung A, Ruang 101"
                        class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                        required>
                </div>
                <div class="pt-4">
                    <button
                        class="w-full py-2.5 bg-primary hover:bg-primary-dark text-white rounded-lg text-sm font-bold transition-colors">Simpan
                        Jadwal</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Modal Edit Jadwal -->
    <dialog id="modalEdit" class="modal rounded-xl p-0 backdrop:bg-black/50 w-full max-w-lg">
        <div class="bg-white dark:bg-gray-900">
            <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
                <h3 class="font-bold text-lg dark:text-white">Edit Jadwal Seleksi</h3>
                <button onclick="document.getElementById('modalEdit').close()" class="text-gray-400 hover:text-gray-600">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form id="formEdit" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama Seleksi</label>
                    <input type="text" id="editNama" name="nama"
                        class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                        required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Tanggal</label>
                        <input type="date" id="editTanggal" name="tanggal"
                            class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Waktu w/ Zona</label>
                        <input type="text" id="editWaktu" name="waktu"
                            class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                            required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Lokasi</label>
                    <input type="text" id="editLokasi" name="lokasi"
                        class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                        required>
                </div>
                <div class="pt-4">
                    <button
                        class="w-full py-2.5 bg-primary hover:bg-primary-dark text-white rounded-lg text-sm font-bold transition-colors">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        function editJadwal(jadwal) {
            document.getElementById('editNama').value = jadwal.nama;
            document.getElementById('editTanggal').value = jadwal.tanggal;
            document.getElementById('editWaktu').value = jadwal.waktu;
            document.getElementById('editLokasi').value = jadwal.lokasi;

            // Set action URL dynamically
            document.getElementById('formEdit').action = "{{ route('admin.jadwal_seleksi.update', ':id') }}".replace(':id', jadwal.id);

            document.getElementById('modalEdit').showModal();
        }
    </script>
@endsection