@extends('layouts.admin')

@section('title', 'Kelola Pengumuman - Admin Portal')

@section('content')
    <div class="p-4 md:p-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div class="flex flex-col gap-1">
                <h2 class="text-[#111318] dark:text-white text-3xl font-black tracking-tight">Kelola Pengumuman</h2>
                <p class="text-[#616f89] text-base">Buat dan kelola pengumuman untuk calon mahasiswa.</p>
            </div>
            <button onclick="document.getElementById('addModal').showModal()"
                class="flex items-center justify-center gap-2 px-5 py-2.5 bg-primary text-white rounded-lg font-bold text-sm shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all w-full md:w-auto">
                <span class="material-symbols-outlined text-[20px]">add</span>
                <span>Tambah Pengumuman</span>
            </button>
        </div>

        @if (session('success'))
            <div
                class="mb-6 p-4 rounded-xl bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 flex items-center gap-3">
                <span class="material-symbols-outlined text-green-600 dark:text-green-400">check_circle</span>
                <p class="text-green-700 dark:text-green-300 text-sm font-bold">{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800">
                <ul class="list-disc list-inside text-red-700 dark:text-red-300 text-sm font-bold">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div
            class="bg-transparent md:bg-white md:dark:bg-[#1a212e] rounded-xl border-none md:border md:border-[#e5e7eb] md:dark:border-gray-800 overflow-hidden shadow-sm">
            <div class="overflow-visible md:overflow-x-auto">
                <table class="w-full text-left md:border-collapse block md:table">
                    <thead class="hidden md:table-header-group">
                        <tr class="border-b border-[#e5e7eb] dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/30">
                            <th class="px-6 py-4 text-xs font-bold text-[#616f89] uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 text-xs font-bold text-[#616f89] uppercase tracking-wider">Isi Ringkas
                            </th>
                            <th class="px-6 py-4 text-xs font-bold text-[#616f89] uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-xs font-bold text-[#616f89] uppercase tracking-wider text-center">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="block md:table-row-group space-y-4 md:space-y-0 divide-y-0 md:divide-y divide-[#e5e7eb] dark:divide-gray-800">
                        @forelse($pengumuman as $item)
                            <!-- Mobile Compact Card -->
                            <tr
                                class="md:hidden block bg-white dark:bg-[#1a212e] rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-4 relative">
                                <td class="block p-0 border-none">
                                    <div class="flex justify-between items-start mb-2">
                                        <div class="pr-2">
                                            <h3 class="font-bold text-[#111318] dark:text-white text-base leading-tight">
                                                {{ $item->judul }}</h3>
                                            <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                                                {{ $item->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                        <span
                                            class="shrink-0 inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $item->is_active ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-700 dark:bg-gray-900/30 dark:text-gray-400' }}">
                                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-2 leading-relaxed">
                                        {{ Str::limit($item->isi, 80) }}
                                    </p>
                                    <div
                                        class="flex items-center justify-end gap-2 border-t border-gray-100 dark:border-gray-800 pt-3">
                                        <button
                                            onclick="editPengumuman('{{ $item->id }}', '{{ addslashes($item->judul) }}', `{{ addslashes($item->isi) }}`, '{{ $item->is_active }}')"
                                            class="flex items-center gap-1 px-3 py-1.5 bg-amber-50 text-amber-600 dark:bg-amber-900/20 rounded-lg text-xs font-bold transition-colors">
                                            <span class="material-symbols-outlined text-[16px]">edit</span> Edit
                                        </button>
                                        <button
                                            onclick="document.getElementById('deleteForm').action = '{{ route('admin.pengumuman.destroy', $item->id) }}'; document.getElementById('deleteModal').showModal()"
                                            class="flex items-center gap-1 px-3 py-1.5 bg-red-50 text-red-600 dark:bg-red-900/20 rounded-lg text-xs font-bold transition-colors">
                                            <span class="material-symbols-outlined text-[16px]">delete</span> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Desktop Table Row -->
                            <tr class="hidden md:table-row hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-[#111318] dark:text-white">{{ $item->judul }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->created_at->format('d M Y H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400 max-w-xs truncate">
                                    {{ Str::limit($item->isi, 50) }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full {{ $item->is_active ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-700 dark:bg-gray-900/30 dark:text-gray-400' }} text-xs font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                        {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        <button
                                            onclick="editPengumuman('{{ $item->id }}', '{{ addslashes($item->judul) }}', `{{ addslashes($item->isi) }}`, '{{ $item->is_active }}')"
                                            class="p-1.5 text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-900/20 rounded-md transition-all"
                                            title="Edit">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </button>
                                        <button
                                            onclick="document.getElementById('deleteForm').action = '{{ route('admin.pengumuman.destroy', $item->id) }}'; document.getElementById('deleteModal').showModal()"
                                            class="p-1.5 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-md transition-all"
                                            title="Hapus">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada pengumuman dibuat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <dialog id="addModal" class="modal rounded-xl p-0 backdrop:bg-black/50 w-full max-w-lg">
        <div class="bg-white dark:bg-[#1a212e] text-left shadow-xl w-full max-w-lg">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Tambah Pengumuman</h3>
                <button onclick="document.getElementById('addModal').close()"
                    class="text-gray-400 hover:text-gray-500 transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form action="{{ route('admin.pengumuman.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Judul</label>
                    <input type="text" name="judul" required
                        class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Isi Pengumuman</label>
                    <textarea name="isi" rows="4" required
                        class="form-textarea w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800"></textarea>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active_add" value="1" checked
                        class="rounded border-gray-300 text-primary focus:ring-primary">
                    <label for="is_active_add" class="text-sm font-medium text-gray-700 dark:text-gray-300">Publikasikan
                        Langsung</label>
                </div>
                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('addModal').close()"
                        class="px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-bold text-sm hover:bg-gray-50">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-primary text-white rounded-lg font-bold text-sm hover:bg-primary/90">Simpan</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Modal Edit -->
    <dialog id="editModal" class="modal rounded-xl p-0 backdrop:bg-black/50 w-full max-w-lg">
        <div class="bg-white dark:bg-[#1a212e] text-left shadow-xl w-full max-w-lg">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Edit Pengumuman</h3>
                <button onclick="document.getElementById('editModal').close()"
                    class="text-gray-400 hover:text-gray-500 transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form id="editForm" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Judul</label>
                    <input type="text" name="judul" id="edit_judul" required
                        class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Isi Pengumuman</label>
                    <textarea name="isi" id="edit_isi" rows="4" required
                        class="form-textarea w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800"></textarea>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="edit_is_active" value="1"
                        class="rounded border-gray-300 text-primary focus:ring-primary">
                    <label for="edit_is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">Status
                        Aktif</label>
                </div>
                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('editModal').close()"
                        class="px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-bold text-sm hover:bg-gray-50">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-primary text-white rounded-lg font-bold text-sm hover:bg-primary/90">Update</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Modal Hapus -->
    <dialog id="deleteModal" class="modal rounded-xl p-0 backdrop:bg-black/50 w-full max-w-sm">
        <div class="bg-white dark:bg-gray-900 p-6 text-center">
            <div
                class="w-16 h-16 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-3xl">warning</span>
            </div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Hapus Pengumuman?</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm mb-6">
                Yakin ingin menghapus pengumuman ini?
            </p>
            <div class="flex gap-3 justify-center">
                <button onclick="document.getElementById('deleteModal').close()"
                    class="px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-bold text-sm hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <form id="deleteForm" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-bold text-sm transition-colors shadow-lg shadow-red-600/20">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </dialog>

    <script>
        function editPengumuman(id, judul, isi, isActive) {
            document.getElementById('editForm').action = `/admin/pengumuman/${id}`;
            document.getElementById('edit_judul').value = judul;
            document.getElementById('edit_isi').value = isi;
            document.getElementById('edit_is_active').checked = isActive == 1; // Correct string/bool comparison
            document.getElementById('editModal').showModal();
        }
    </script>
@endsection