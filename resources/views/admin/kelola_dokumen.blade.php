@extends('layouts.admin')

@section('title', 'Kelola Dokumen - Dashboard Admin')

@section('content')
    <div class="p-4 md:p-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div class="flex flex-col gap-1">
                <h1 class="text-2xl font-bold text-[#111318] dark:text-white">Kelola Dokumen</h1>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Atur persyaratan dokumen
                    pendaftaran untuk calon mahasiswa.</p>
            </div>
            <div>
                <button onclick="document.getElementById('modalTambah').showModal()"
                    class="flex items-center justify-center gap-2 px-4 py-2 bg-primary hover:bg-primary-dark text-white rounded-lg text-sm font-medium transition-colors shadow-sm w-full md:w-auto">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Dokumen Baru
                </button>
            </div>
        </div>

        @if(session('success'))
            <div
                class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-lg text-sm font-bold">
                {{ session('success') }}
            </div>
        @endif

        <div
            class="bg-transparent md:bg-white md:dark:bg-gray-900 rounded-xl border-none md:border md:border-[#f0f2f4] md:dark:border-gray-800 shadow-sm overflow-hidden flex flex-col mb-6">
            <div class="p-0 md:p-6 md:border-b border-[#f0f2f4] dark:border-gray-800 mb-4 md:mb-0">
                <h3 class="font-bold text-lg text-[#111318] dark:text-white hidden md:block">Daftar Persyaratan Dokumen</h3>
            </div>
            <div class="overflow-visible md:overflow-x-auto">
                <table class="w-full text-left md:border-collapse block md:table">
                    <thead
                        class="bg-gray-50 dark:bg-gray-800/50 border-b border-[#f0f2f4] dark:border-gray-800 hidden md:table-header-group">
                        <tr>
                            <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500 dark:text-gray-400 w-16">
                                No</th>
                            <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500 dark:text-gray-400">
                                Nama Dokumen</th>
                            <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500 dark:text-gray-400">
                                Format</th>
                            <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500 dark:text-gray-400 text-center">
                                Wajib/Opsional</th>
                            <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500 dark:text-gray-400">
                                Ukuran Maksimal</th>
                            <th class="py-4 px-6 text-xs font-bold uppercase text-gray-500 dark:text-gray-400 text-center">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody
                        class="block md:table-row-group space-y-4 md:space-y-0 divide-y-0 md:divide-y divide-[#f0f2f4] dark:divide-gray-800">
                        @forelse($dokumens as $dokumen)
                            <!-- Mobile Compact Card -->
                            <tr
                                class="md:hidden block bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-4">
                                <td class="block p-0 border-none">
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
                                                <span class="material-symbols-outlined text-primary text-[20px]">
                                                    @if(str_contains(strtolower($dokumen->nama), 'foto')) image
                                                    @elseif(str_contains(strtolower($dokumen->nama), 'ijazah')) school
                                                    @else description @endif
                                                </span>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-900 dark:text-white text-sm line-clamp-2">
                                                    {{ $dokumen->nama }}</h4>
                                                <span
                                                    class="inline-block mt-1 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide {{ $dokumen->wajib ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400' }}">
                                                    {{ $dokumen->wajib ? 'WAJIB' : 'OPSIONAL' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400 mb-4 border-t border-b border-gray-50 dark:border-gray-800/50 py-2">
                                        <div class="flex flex-col">
                                            <span class="text-[10px] uppercase font-bold text-gray-400">Format</span>
                                            <span
                                                class="font-medium text-gray-700 dark:text-gray-300">{{ $dokumen->format }}</span>
                                        </div>
                                        <div class="w-px h-6 bg-gray-200 dark:bg-gray-700"></div>
                                        <div class="flex flex-col">
                                            <span class="text-[10px] uppercase font-bold text-gray-400">Max Size</span>
                                            <span
                                                class="font-medium text-gray-700 dark:text-gray-300">{{ $dokumen->max_size }}</span>
                                        </div>
                                    </div>
                                    <div class="flex justify-end gap-2">
                                        <button onclick="editDokumen({{ $dokumen }})"
                                            class="flex-1 flex items-center justify-center gap-1.5 px-3 py-2 bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-lg transition-colors text-xs font-bold">
                                            <span class="material-symbols-outlined text-[16px]">edit</span>
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.kelola_dokumen.destroy', $dokumen->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus dokumen ini?');" class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full flex items-center justify-center gap-1.5 px-3 py-2 bg-red-50 hover:bg-red-100 dark:bg-red-900/20 dark:hover:bg-red-900/40 text-red-600 dark:text-red-400 rounded-lg transition-colors text-xs font-bold">
                                                <span class="material-symbols-outlined text-[16px]">delete</span>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Desktop Table Row -->
                            <tr class="hidden md:table-row hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="py-4 px-6 text-sm text-gray-900 dark:text-white">{{ $loop->iteration }}</td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-primary text-xl">
                                            @if(str_contains(strtolower($dokumen->nama), 'foto')) image
                                            @elseif(str_contains(strtolower($dokumen->nama), 'ijazah')) school
                                            @else description @endif
                                        </span>
                                        <span
                                            class="text-sm font-medium text-gray-900 dark:text-white">{{ $dokumen->nama }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-400">{{ $dokumen->format }}</td>
                                <td class="py-4 px-6 text-center">
                                    <span
                                        class="inline-flex px-2.5 py-1 rounded-full text-[11px] font-bold {{ $dokumen->wajib ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400' }}">
                                        {{ $dokumen->wajib ? 'WAJIB' : 'OPSIONAL' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-500 dark:text-gray-400">{{ $dokumen->max_size }}</td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="editDokumen({{ $dokumen }})"
                                            class="p-2 text-gray-500 hover:text-primary transition-colors rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </button>
                                        <form action="{{ route('admin.kelola_dokumen.destroy', $dokumen->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus dokumen ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-gray-500 hover:text-red-600 transition-colors rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada dokumen dikonfigurasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div
                class="p-4 bg-gray-50 dark:bg-gray-800/50 border-t border-[#f0f2f4] dark:border-gray-800 flex items-center justify-between">
                <p class="text-xs text-gray-500 dark:text-gray-400">Menampilkan {{ count($dokumens) }} dokumen
                    persyaratan</p>
            </div>
        </div>

        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-blue-50 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-900/30 rounded-xl p-6">
                <div class="flex items-start gap-4">
                    <div class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-lg text-blue-600 dark:text-blue-400">
                        <span class="material-symbols-outlined">info</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-blue-900 dark:text-blue-300">Catatan Konfigurasi</h4>
                        <p class="text-sm text-blue-700 dark:text-blue-400/80 mt-1">Setiap perubahan pada
                            persyaratan dokumen akan langsung berdampak pada formulir pendaftaran calon
                            mahasiswa. Pastikan format dan ukuran file sudah sesuai dengan kemampuan server.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit share logic via JS populating forms -->
    <dialog id="modalTambah" class="modal rounded-xl p-0 backdrop:bg-black/50 w-full max-w-lg">
        <div class="bg-white dark:bg-gray-900">
            <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
                <h3 class="font-bold text-lg dark:text-white">Tambah Syarat Dokumen</h3>
                <button onclick="document.getElementById('modalTambah').close()" class="text-gray-400 hover:text-gray-600">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form action="{{ route('admin.kelola_dokumen.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama Dokumen</label>
                    <input type="text" name="nama" placeholder="e.g. Pas Foto 4x6"
                        class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                        required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Format File</label>
                        <input type="text" name="format" value="PDF, JPG, PNG"
                            class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Ukuran Max</label>
                        <input type="text" name="max_size" value="2 MB"
                            class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                            required>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="wajib" id="wajib"
                        class="rounded border-gray-300 text-primary focus:ring-primary" checked>
                    <label for="wajib" class="text-sm text-gray-700 dark:text-gray-300">Wajib Diupload?</label>
                </div>
                <div class="pt-4">
                    <button
                        class="w-full py-2.5 bg-primary hover:bg-primary-dark text-white rounded-lg text-sm font-bold transition-colors">Simpan
                        Dokumen</button>
                </div>
            </form>
        </div>
    </dialog>

    <dialog id="modalEdit" class="modal rounded-xl p-0 backdrop:bg-black/50 w-full max-w-lg">
        <div class="bg-white dark:bg-gray-900">
            <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
                <h3 class="font-bold text-lg dark:text-white">Edit Syarat Dokumen</h3>
                <button onclick="document.getElementById('modalEdit').close()" class="text-gray-400 hover:text-gray-600">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form id="formEdit" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama Dokumen</label>
                    <input type="text" id="editNama" name="nama"
                        class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                        required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Format File</label>
                        <input type="text" id="editFormat" name="format"
                            class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Ukuran Max</label>
                        <input type="text" id="editMaxSize" name="max_size"
                            class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 text-sm focus:ring-primary focus:border-primary"
                            required>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="wajib" id="editWajib"
                        class="rounded border-gray-300 text-primary focus:ring-primary">
                    <label for="editWajib" class="text-sm text-gray-700 dark:text-gray-300">Wajib Diupload?</label>
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
        function editDokumen(doc) {
            document.getElementById('editNama').value = doc.nama;
            document.getElementById('editFormat').value = doc.format;
            document.getElementById('editMaxSize').value = doc.max_size;
            document.getElementById('editWajib').checked = doc.wajib == 1;

            document.getElementById('formEdit').action = "{{ route('admin.kelola_dokumen.update', ':id') }}".replace(':id', doc.id);
            document.getElementById('modalEdit').showModal();
        }
    </script>
@endsection