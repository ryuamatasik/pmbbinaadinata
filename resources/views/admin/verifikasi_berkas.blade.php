@extends('layouts.admin')

@section('title', 'Verifikasi Berkas - Dashboard Admin')

@section('content')
    <div class="flex flex-col h-full overflow-hidden" x-data="verifikasiAppV2()">

        <header
            class="h-16 flex items-center justify-between bg-white dark:bg-gray-900 border-b border-slate-200 dark:border-slate-800 px-4 lg:px-8 flex-none">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">verified_user</span>
                <h2 class="text-slate-800 dark:text-white font-bold text-sm lg:text-base">Verifikasi Berkas Mahasiswa</h2>
            </div>
            <div class="flex items-center gap-6">
                <div class="relative hidden lg:block">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">search</span>
                    <input
                        class="pl-9 pr-4 py-1.5 bg-slate-100 dark:bg-slate-800 border-none rounded-full text-xs w-64 focus:ring-2 focus:ring-primary transition-all dark:text-white"
                        placeholder="Cari No. Registrasi..." />
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-hidden flex flex-col">
            <!-- Breadcrumbs & Stats -->
            <div
                class="px-4 lg:px-8 py-4 bg-white dark:bg-gray-900 border-b border-slate-100 dark:border-slate-800 flex flex-col lg:flex-row justify-between lg:items-center gap-4 flex-none">
                <div class="flex items-center gap-2 text-xs font-medium text-slate-500">
                    <a class="hover:text-primary transition-colors" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <span class="material-symbols-outlined text-[10px]">chevron_right</span>
                    <span class="text-slate-900 dark:text-white font-semibold">Verifikasi Berkas</span>
                </div>
                <div class="flex gap-1.5 overflow-x-auto w-full lg:w-auto pb-2 lg:pb-0 hide-scrollbar">
                    <a href="{{ route('admin.verifikasi_berkas', ['status' => 'Menunggu']) }}"
                        class="px-4 py-1.5 {{ $status == 'Menunggu' || $status == 'Verifikasi' ? 'bg-primary text-white shadow-sm' : 'text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800' }} text-[11px] font-bold rounded-full transition-all whitespace-nowrap">
                        Menunggu ({{ $countMenunggu }})
                    </a>
                    <a href="{{ route('admin.verifikasi_berkas', ['status' => 'Selesai']) }}"
                        class="px-4 py-1.5 {{ $status == 'Selesai' || $status == 'Diterima' ? 'bg-primary text-white shadow-sm' : 'text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800' }} text-[11px] font-bold rounded-full transition-all whitespace-nowrap">
                        Selesai ({{ $countSelesai }})
                    </a>
                    <a href="{{ route('admin.verifikasi_berkas', ['status' => 'Revisi']) }}"
                        class="px-4 py-1.5 {{ $status == 'Revisi' || $status == 'Ditolak' ? 'bg-primary text-white shadow-sm' : 'text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800' }} text-[11px] font-bold rounded-full transition-all whitespace-nowrap">
                        Revisi ({{ $countRevisi }})
                    </a>
                </div>
            </div>

            <div class="flex-1 flex flex-col lg:flex-row overflow-y-auto lg:overflow-hidden">
                <!-- Left Sidebar: Antrean Pendaftar -->
                <div
                    class="w-full lg:w-72 shrink-0 bg-white dark:bg-gray-900 border-r-0 lg:border-r border-b lg:border-b-0 border-slate-200 dark:border-slate-800 flex flex-col overflow-hidden h-auto lg:h-full">
                    <div class="h-48 lg:flex-1 flex flex-col min-h-0">
                        <div
                            class="p-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50 flex-shrink-0">
                            <h3 class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Antrean Pendaftar
                            </h3>
                        </div>
                        <div class="flex-1 overflow-y-auto">
                            @forelse($antrean as $item)
                                <a href="{{ route('admin.verifikasi_berkas', $item->id) }}"
                                    class="block p-4 border-b border-slate-50 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800 cursor-pointer transition-all {{ isset($pendaftar) && $pendaftar->id == $item->id ? 'bg-primary/5 border-l-4 border-l-primary' : 'border-l-4 border-l-transparent' }}">
                                    <div class="flex justify-between items-start mb-1">
                                        <p
                                            class="text-xs font-bold {{ isset($pendaftar) && $pendaftar->id == $item->id ? 'text-primary' : 'text-slate-700 dark:text-slate-200' }}">
                                            {{ $item->nama_lengkap }}
                                        </p>
                                        @if ($item->status == 'Verifikasi')
                                            <span
                                                class="bg-blue-100 text-blue-600 text-[8px] px-1.5 py-0.5 rounded font-bold">Ready</span>
                                        @else
                                            <span
                                                class="bg-gray-100 text-gray-600 text-[8px] px-1.5 py-0.5 rounded font-bold">{{ $item->status }}</span>
                                        @endif
                                    </div>
                                    <p class="text-[10px] text-slate-500 font-medium">
                                        {{ $item->nomor_pendaftaran ?? 'No. Reg N/A' }}
                                    </p>
                                    <div class="mt-2 flex items-center gap-1.5 text-[9px] text-slate-400">
                                        <span class="material-symbols-outlined text-[12px]">schedule</span>
                                        <span>{{ $item->updated_at->diffForHumans() }}</span>
                                    </div>
                                </a>
                            @empty
                                <div class="p-4 text-center text-xs text-slate-500">
                                    Tidak ada antrean.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Middle Sidebar (Bottom Left): Checklist Dokumen -->
                    <div class="h-72 border-t border-slate-200 dark:border-slate-800 flex flex-col">
                        <div
                            class="p-4 border-b border-slate-50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50 flex-shrink-0">
                            <p class="text-[10px] font-bold uppercase text-slate-400">Checklist Dokumen</p>
                        </div>
                        <div class="flex-1 overflow-y-auto p-4 custom-scrollbar">
                            @if(isset($pendaftar))
                                <div class="space-y-1.5 pb-2">
                                    <template x-for="(doc, index) in documents" :key="index">
                                        <button @click="setActiveDoc(doc)"
                                            class="w-full flex items-center justify-between p-2.5 rounded text-[11px] transition-all group border"
                                            :class="activeDoc.name === doc.name ? 
                                                                                                                                                                                            'bg-primary/10 border-primary/20 text-primary font-bold shadow-sm' : 
                                                                                                                                                                                            'border-transparent hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-300 font-medium'">
                                            <span class="flex items-center gap-2.5">
                                                <span class="material-symbols-outlined text-[16px]"
                                                    :class="activeDoc.name === doc.name ? 'font-normal' : 'text-slate-400'"
                                                    x-text="doc.icon"></span>
                                                <span x-text="(index + 1) + '. ' + doc.name"></span>
                                            </span>
                                            <span class="material-symbols-outlined text-[16px] transition-colors"
                                                :class="doc.uploaded ? 'text-green-500' : 'text-slate-300'"
                                                style="font-variation-settings: 'FILL' 1;">
                                                check_circle
                                            </span>
                                        </button>
                                    </template>
                                </div>
                            @else
                                <div class="text-center text-xs text-slate-400 mt-10">Pilih pendaftar terlebih dahulu.</div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Main Content: Document Preview -->
                <div class="flex-1 flex flex-col bg-slate-100 dark:bg-slate-900 min-w-0">
                    @if(isset($pendaftar))
                        <div
                            class="h-12 flex items-center justify-between bg-white dark:bg-gray-900 border-b border-slate-200 dark:border-slate-800 px-4 flex-none">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-slate-700 dark:text-slate-300"
                                    x-text="activeDoc.name || 'Pilih Dokumen'"></span>
                                <template x-if="activeDoc.uploaded">
                                    <span
                                        class="bg-green-100 text-green-700 text-[9px] px-1.5 py-0.5 rounded font-bold uppercase">Terverifikasi
                                        Sistem</span>
                                </template>
                                <template x-if="!activeDoc.uploaded">
                                    <span
                                        class="bg-red-100 text-red-700 text-[9px] px-1.5 py-0.5 rounded font-bold uppercase">Belum
                                        Upload</span>
                                </template>
                            </div>
                            <div class="flex items-center gap-3">
                                <!-- Status Controls for Active Document -->
                                <template x-if="activeDoc.uploaded">
                                    <div class="flex items-center gap-1 mr-2">
                                        <button @click="updateDocStatus('valid')"
                                            :class="activeDoc.status == 'valid' ? 'bg-green-100 text-green-700 ring-2 ring-green-500' : 'bg-slate-100 dark:bg-slate-800 text-slate-500 hover:bg-green-50 hover:text-green-600'"
                                            class="flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-bold transition-all"
                                            title="Tandai Valid">
                                            <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                            Valid
                                        </button>
                                        <button @click="openRejectionModal()"
                                            :class="activeDoc.status == 'invalid' ? 'bg-red-100 text-red-700 ring-2 ring-red-500' : 'bg-slate-100 dark:bg-slate-800 text-slate-500 hover:bg-red-50 hover:text-red-600'"
                                            class="flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-bold transition-all"
                                            title="Tandai Revisi">
                                            <span class="material-symbols-outlined text-[16px]">cancel</span>
                                            Revisi
                                        </button>
                                    </div>
                                </template>

                                <div class="flex items-center bg-slate-100 dark:bg-slate-800 rounded px-1">
                                    <button @click="zoomOut()" class="p-1 hover:text-primary transition-colors"><span
                                            class="material-symbols-outlined text-sm">zoom_out</span></button>
                                    <span class="text-[10px] font-bold px-2 w-10 text-center" x-text="zoomLevel + '%'"></span>
                                    <button @click="zoomIn()" class="p-1 hover:text-primary transition-colors"><span
                                            class="material-symbols-outlined text-sm">zoom_in</span></button>
                                </div>
                                <button @click="rotate()" class="p-1.5 hover:bg-slate-100 dark:hover:bg-slate-800 rounded"><span
                                        class="material-symbols-outlined text-sm">rotate_right</span></button>
                                <a :href="activeDoc.url" target="_blank"
                                    :class="!activeDoc.url ? 'pointer-events-none opacity-50' : ''"
                                    class="p-1.5 hover:bg-slate-100 dark:hover:bg-slate-800 rounded"><span
                                        class="material-symbols-outlined text-sm text-primary">download</span></a>
                            </div>
                        </div>

                        <!-- Document Preview Area -->
                        <div
                            class="flex-1 p-4 overflow-hidden flex justify-center items-center bg-slate-200 dark:bg-[#0f1523] relative">
                            <template x-if="activeDoc.url">
                                <div class="w-full h-full flex items-center justify-center overflow-auto"
                                    id="preview-container">
                                    <!-- Logic: If image (check extension), show IMG. Else (PDF), show Iframe -->
                                    <template x-if="isImage(activeDoc.url)">
                                        <img :src="activeDoc.url"
                                            :style="`width: ${zoomLevel}%; transform: rotate(${rotation}deg); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);`"
                                            class="rounded-lg shadow-sm bg-white border border-slate-300 object-contain origin-center"
                                            :class="zoomLevel <= 100 ? 'max-w-full max-h-full' : 'max-w-none h-auto'">
                                    </template>
                                    <template x-if="!isImage(activeDoc.url)">
                                        <iframe :src="activeDoc.url"
                                            :style="`width: ${zoomLevel}%; height: ${zoomLevel <= 100 ? '100%' : 'auto'}; min-height: 100%; transform: rotate(${rotation}deg); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);`"
                                            class="rounded-lg shadow-sm bg-white border border-slate-300"></iframe>
                                    </template>
                                </div>
                            </template>

                            <template x-if="!activeDoc.url">
                                <div
                                    class="flex flex-col items-center justify-center p-10 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-dashed border-slate-300 dark:border-slate-700">
                                    <div
                                        class="size-20 bg-slate-50 dark:bg-slate-700 rounded-full flex items-center justify-center mb-4">
                                        <span
                                            class="material-symbols-outlined text-4xl text-slate-300 dark:text-slate-500">folder_off</span>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-700 dark:text-slate-200">Berkas Kosong</h3>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 max-w-[200px] text-center">
                                        Pendaftar belum mengunggah dokumen <span x-text="activeDoc.name"
                                            class="font-bold"></span>.</p>
                                </div>
                            </template>
                        </div>
                    @else
                        <div class="flex-1 flex flex-col items-center justify-center text-slate-400">
                            <span class="material-symbols-outlined text-6xl opacity-20 mb-4">person_search</span>
                            <p class="text-sm font-medium">Pilih pendaftar dari antrean untuk memulai verifikasi.</p>
                        </div>
                    @endif
                </div>

                <!-- Right Sidebar: Panel Verifikasi -->
                <div
                    class="w-80 shrink-0 bg-white dark:bg-gray-900 border-l border-slate-200 dark:border-slate-800 flex flex-col overflow-hidden">
                    <div class="p-4 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
                        <h3 class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Panel Verifikasi
                        </h3>
                    </div>
                    @if(isset($pendaftar))
                        <form action="{{ route('admin.verifikasi.store') }}" method="POST"
                            class="p-5 flex-1 flex flex-col overflow-y-auto">
                            @csrf
                            <input type="hidden" name="pendaftar_id" value="{{ $pendaftar->id }}">

                            <div class="mb-6">
                                <p class="text-[10px] font-bold text-slate-400 uppercase mb-3">Hasil Pemeriksaan</p>
                                <div class="space-y-2">
                                    <label
                                        class="flex items-center gap-3 p-3 rounded-xl border-2 border-primary bg-primary/5 cursor-pointer transition-all">
                                        <input checked="" class="text-primary focus:ring-primary size-4 border-slate-300"
                                            name="status" value="Diterima" type="radio" />
                                        <div class="flex-1">
                                            <p class="text-xs font-bold text-primary">Terima Dokumen</p>
                                            <p class="text-[9px] text-slate-500">Data valid &amp; terbaca</p>
                                        </div>
                                    </label>
                                    <label
                                        class="flex items-center gap-3 p-3 rounded-xl border-2 border-transparent bg-slate-50 dark:bg-slate-800 hover:border-red-200 cursor-pointer transition-all group">
                                        <input class="text-red-500 focus:ring-red-500 size-4 border-slate-300" name="status"
                                            value="Ditolak" type="radio" />
                                        <div class="flex-1">
                                            <p class="text-xs font-bold group-hover:text-red-600 transition-colors">
                                                Tolak / Revisi</p>
                                            <p class="text-[9px] text-slate-500">Membutuhkan perbaikan</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="flex-1 flex flex-col">
                                <p class="text-[10px] font-bold text-slate-400 uppercase mb-2">Catatan Verifikator</p>
                                <textarea name="catatan"
                                    class="flex-1 w-full bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl p-4 text-xs focus:ring-2 focus:ring-primary focus:border-transparent resize-none placeholder:text-slate-400"
                                    placeholder="Berikan alasan jika dokumen ditolak atau instruksi revisi..."
                                    rows="5"></textarea>
                                <div class="mt-6 flex flex-col gap-3">
                                    <div class="flex justify-between items-center text-[10px] font-medium text-slate-400">
                                        <span>Kemajuan Verifikasi:</span>
                                        <span class="text-primary font-bold">Siap Diproses</span>
                                    </div>
                                    <div class="w-full h-1.5 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">
                                        <div class="bg-primary h-full w-full"></div>
                                    </div>
                                    <button type="submit"
                                        class="mt-2 w-full bg-primary text-white font-bold py-3.5 rounded-xl hover:bg-primary/90 shadow-lg shadow-primary/20 transition-all flex items-center justify-center gap-2 text-sm">
                                        <span class="material-symbols-outlined text-lg">verified</span>
                                        <span>Simpan Keputusan</span>
                                    </button>
                                    <p class="text-center text-[9px] text-slate-400 italic">Terakhir diupdate: {{ date('H:i') }}
                                        WIB
                                    </p>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="p-10 text-center text-slate-400 text-xs">
                            Panel aktif setelah memilih pendaftar.
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Custom Rejection Modal -->
        <div x-show="rejectionModalOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
            style="display: none;">

            <div @click.outside="closeRejectionModal()" x-show="rejectionModalOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden ring-1 ring-gray-900/5">

                <div class="p-6">
                    <div class="flex items-center gap-3 mb-4 text-red-600 dark:text-red-400">
                        <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg">
                            <span class="material-symbols-outlined text-xl">gpp_bad</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Alasan Revisi Dokumen</h3>
                    </div>

                    <p class="text-sm text-gray-500 mb-4">
                        Mohon berikan alasan mengapa dokumen ini ditolak. Catatan ini akan terlihat oleh calon mahasiswa.
                    </p>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase mb-1">
                            Catatan / Instruksi
                        </label>
                        <textarea x-model="rejectionReason" rows="3"
                            class="w-full text-sm rounded-xl border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-red-500 focus:border-red-500 placeholder:text-gray-400"
                            placeholder="Contoh: Foto buram, harap upload ulang..."></textarea>
                    </div>
                </div>

                <div
                    class="px-6 py-4 bg-gray-50 dark:bg-gray-800/50 flex justify-end gap-3 border-t border-gray-100 dark:border-gray-700">
                    <button @click="closeRejectionModal()"
                        class="px-4 py-2 text-sm font-bold text-gray-600 hover:bg-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        Batal
                    </button>
                    <button @click="submitRejection()"
                        class="px-4 py-2 text-sm font-bold text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-lg shadow-red-600/20 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">save</span>
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function verifikasiAppV2() {
                return {
                    activeDoc: {},
                    zoomLevel: 100,
                    rotation: 0,
                    documents: [
                        { name: 'KTP Pribadi', icon: 'badge', key: 'ktp', uploaded: false, url: null },
                        { name: 'KTP Orang Tua / Wali', icon: 'diversity_3', key: 'ktp_ortu', uploaded: false, url: null },
                        { name: 'Akte Kelahiran', icon: 'child_care', key: 'akte', uploaded: false, url: null },
                        { name: 'Ijazah SMA', icon: 'description', key: 'ijazah', uploaded: false, url: null },
                        { name: 'Kartu Keluarga', icon: 'family_restroom', key: 'kk', uploaded: false, url: null },
                        { name: 'Pass Foto', icon: 'account_circle', key: 'foto', uploaded: false, url: null },
                        { name: 'Transkrip Nilai', icon: 'receipt_long', key: 'transkrip', uploaded: false, url: null },
                        { name: 'Bukti Pembayaran', icon: 'payments', key: 'bukti_pembayaran', uploaded: false, url: null }
                    ],
                    uploadedDocs: @json($dokumen ?? []),

                    init() {
                        console.log('Init App V2', this.uploadedDocs);
                        // Update documents based on uploadedDocs object { key: {id, url, status, catatan} }
                        this.documents = this.documents.map(doc => {
                            let docData = null;
                            if (this.uploadedDocs && this.uploadedDocs[doc.key]) {
                                docData = this.uploadedDocs[doc.key];
                            }

                            return {
                                ...doc,
                                uploaded: !!docData,
                                url: docData ? docData.url : null,
                                id: docData ? docData.id : null,
                                status: docData ? docData.status : 'pending',
                                catatan: docData ? docData.catatan : ''
                            };
                        });

                        if (this.documents.length > 0) {
                            this.activeDoc = this.documents[0];
                        }
                    },

                    setActiveDoc(doc) {
                        this.activeDoc = doc;
                        this.zoomLevel = 100;
                        this.rotation = 0;
                    },

                    async updateDocStatus(status, catatan = null) {
                        return new Promise(async (resolve, reject) => {
                            if (!this.activeDoc.id) {
                                alert("Error: ID Dokumen tidak ditemukan. Mohon refresh halaman.");
                                resolve(false);
                                return;
                            }

                            // Optimistic Update
                            this.activeDoc.status = status;
                            if (catatan) this.activeDoc.catatan = catatan;

                            try {
                                const response = await fetch(`/admin/verifikasi-berkas/dokumen/${this.activeDoc.id}`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({ status: status, catatan: catatan })
                                });

                                if (!response.ok) throw new Error('Update failed');
                                console.log('Status updated');
                                resolve(true);
                            } catch (error) {
                                alert('Gagal memperbarui status dokumen.');
                                console.error(error);
                                resolve(false);
                            }
                        });
                    },

                    // REJECTION MODAL STATE
                    rejectionModalOpen: false,
                    rejectionReason: '',

                    openRejectionModal() {
                        this.rejectionReason = this.activeDoc.catatan || '';
                        this.rejectionModalOpen = true;
                    },

                    closeRejectionModal() {
                        this.rejectionModalOpen = false;
                        this.rejectionReason = '';
                    },

                    submitRejection() {
                        if (!this.rejectionReason.trim()) {
                            alert("Mohon isi alasan penolakan/revisi.");
                            return;
                        }
                        this.updateDocStatus('invalid', this.rejectionReason);
                        this.closeRejectionModal();
                    },

                    zoomIn() {
                        if (this.zoomLevel < 300) this.zoomLevel += 25;
                    },

                    zoomOut() {
                        if (this.zoomLevel > 25) this.zoomLevel -= 25;
                    },

                    rotate() {
                        this.rotation = (this.rotation + 90) % 360;
                    },

                    isImage(url) {
                        if (!url) return false;
                        const extension = url.split('.').pop().toLowerCase();
                        const cleanExt = extension.split('?')[0];
                        return ['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp'].includes(cleanExt);
                    }
                }
            }
        </script>

    @endpush

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        .dark .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #334155;
        }
    </style>
@endsection