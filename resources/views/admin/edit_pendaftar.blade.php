@extends('layouts.admin')

@section('title', 'Edit Data Pendaftar - Admin Portal')

@section('content')
    <div class="p-8">
        <div class="mb-8 flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.data_calon_mahasiswa') }}"
                    class="flex items-center justify-center w-10 h-10 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors text-gray-500">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-[#111318] dark:text-white">Edit Data Pendaftar</h1>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Perbarui informasi calon mahasiswa: <span
                            class="font-bold text-primary">{{ $pendaftar->nama_lengkap }}</span></p>
                </div>
            </div>
        </div>

        <div
            class="bg-white dark:bg-[#1a212e] rounded-xl border border-[#e5e7eb] dark:border-gray-800 shadow-sm overflow-hidden">
            <form action="{{ route('admin.pendaftar.update', $pendaftar->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Tab Navigation NOT IMPLEMENTED via JS/CSS simplicy, using Vertical Sections instead for clarity -->

                <div class="p-8 space-y-10 divide-y divide-gray-100 dark:divide-gray-800">

                    <!-- 1. DATA PRIBADI & AKUN -->
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                        <div class="lg:col-span-1">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Data Utama</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Informasi dasar dan kontak pendaftar.
                            </p>
                        </div>
                        <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Lengkap -->
                            <div class="col-span-2">
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama
                                    Lengkap</label>
                                <input type="text" name="nama_lengkap"
                                    value="{{ old('nama_lengkap', $pendaftar->nama_lengkap) }}"
                                    class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 @error('nama_lengkap') border-red-500 @enderror">
                                @error('nama_lengkap')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email & HP -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email', $pendaftar->email) }}"
                                    class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">No. HP /
                                    WA</label>
                                <input type="text" name="no_hp" value="{{ old('no_hp', $pendaftar->no_hp) }}"
                                    class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 @error('no_hp') border-red-500 @enderror">
                                @error('no_hp')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Identitas -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">NIK</label>
                                <input type="text" name="nik" value="{{ old('nik', $pendaftar->nik) }}"
                                    class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 @error('nik') border-red-500 @enderror">
                                @error('nik')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">NISN</label>
                                <input type="text" name="nisn" value="{{ old('nisn', $pendaftar->nisn) }}"
                                    class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                            </div>

                            <!-- TTL & Gender -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Tempat
                                    Lahir</label>
                                <input type="text" name="tempat_lahir"
                                    value="{{ old('tempat_lahir', $pendaftar->tempat_lahir) }}"
                                    class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Tanggal
                                    Lahir</label>
                                <input type="date" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir', $pendaftar->tanggal_lahir) }}"
                                    class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Jenis
                                    Kelamin</label>
                                <select name="jenis_kelamin"
                                    class="form-select w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                                    <option value="L" {{ $pendaftar->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="P" {{ $pendaftar->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Agama</label>
                                <select name="agama"
                                    class="form-select w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                                    @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                        <option value="{{ $agama }}" {{ $pendaftar->agama == $agama ? 'selected' : '' }}>
                                            {{ $agama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- 2. ALAMAT LENGKAP -->
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 pt-10">
                        <div class="lg:col-span-1">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Alamat Domisili</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Alamat tempat tinggal saat ini.</p>
                        </div>
                        <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Alamat Lengkap
                                    (Jalan)</label>
                                <textarea name="alamat_lengkap" rows="2"
                                    class="form-textarea w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800">{{ old('alamat_lengkap', $pendaftar->alamat_lengkap) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">RT / RW</label>
                                <div class="flex gap-2">
                                    <input type="text" name="rt" placeholder="RT" value="{{ old('rt', $pendaftar->rt) }}"
                                        class="form-input w-1/2 rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                                    <input type="text" name="rw" placeholder="RW" value="{{ old('rw', $pendaftar->rw) }}"
                                        class="form-input w-1/2 rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Kode
                                    Pos</label>
                                <input type="text" name="kode_pos" value="{{ old('kode_pos', $pendaftar->kode_pos) }}"
                                    class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Desa /
                                    Kelurahan</label>
                                <input type="text" name="desa_kelurahan"
                                    value="{{ old('desa_kelurahan', $pendaftar->desa_kelurahan) }}"
                                    class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Kecamatan</label>
                                <input type="text" name="kecamatan" value="{{ old('kecamatan', $pendaftar->kecamatan) }}"
                                    class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Kabupaten /
                                    Kota</label>
                                <input type="text" name="kabupaten" value="{{ old('kabupaten', $pendaftar->kabupaten) }}"
                                    class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Provinsi</label>
                                <input type="text" name="provinsi" value="{{ old('provinsi', $pendaftar->provinsi) }}"
                                    class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                            </div>
                        </div>
                    </div>

                    <!-- 3. DATA SEKOLAH -->
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 pt-10">
                        <div class="lg:col-span-1">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Data Sekolah</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Asal sekolah dan nilai akademik.</p>
                        </div>
                        <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama Sekolah
                                    Asal</label>
                                <input type="text" name="nama_sekolah"
                                    value="{{ old('nama_sekolah', $pendaftar->nama_sekolah) }}"
                                    class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Tahun
                                    Lulus</label>
                                <input type="number" name="tahun_lulus"
                                    value="{{ old('tahun_lulus', $pendaftar->tahun_lulus) }}"
                                    class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nilai Rata-Rata
                                    Ujian</label>
                                <input type="number" step="0.01" name="nilai_rata_rata"
                                    value="{{ old('nilai_rata_rata', $pendaftar->nilai_rata_rata) }}"
                                    class="form-input w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 @error('nilai_rata_rata') border-red-500 @enderror">
                                @error('nilai_rata_rata')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- 4. DATA PILIHAN -->
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 pt-10">
                        <div class="lg:col-span-1">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Pilihan Program Studi</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Jurusan yang diminati.</p>
                        </div>
                        <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Program
                                    Studi</label>
                                <select name="pilihan_prodi"
                                    class="form-select w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                                    @foreach(['Teknik Informatika', 'Sistem Informasi', 'Manajemen Bisnis', 'Ilmu Komunikasi', 'Akuntansi'] as $prodi)
                                        <option value="{{ $prodi }}" {{ $pendaftar->pilihan_prodi == $prodi ? 'selected' : '' }}>
                                            {{ $prodi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- 5. DATA ORANG TUA (Collapsed style or simple block) -->
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 pt-10">
                        <div class="lg:col-span-1">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Data Orang Tua</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Informasi Ayah/Ibu/Wali.</p>
                        </div>
                        <div class="lg:col-span-3 space-y-6">
                            <!-- AYAH -->
                            <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                <h4 class="font-bold mb-4 text-primary">Data Ayah</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="col-span-2 md:col-span-1">
                                        <label class="block text-xs font-bold text-gray-500 mb-1">Nama Ayah</label>
                                        <input type="text" name="nama_ayah"
                                            value="{{ old('nama_ayah', $pendaftar->nama_ayah) }}"
                                            class="w-full text-sm rounded border-gray-200 dark:border-gray-600 dark:bg-gray-700">
                                    </div>
                                    <div class="col-span-2 md:col-span-1">
                                        <label class="block text-xs font-bold text-gray-500 mb-1">NIK Ayah</label>
                                        <input type="text" name="nik_ayah"
                                            value="{{ old('nik_ayah', $pendaftar->nik_ayah) }}"
                                            class="w-full text-sm rounded border-gray-200 dark:border-gray-600 dark:bg-gray-700">
                                    </div>
                                    <div class="col-span-2 md:col-span-1">
                                        <label class="block text-xs font-bold text-gray-500 mb-1">Pekerjaan</label>
                                        <input type="text" name="pekerjaan_ayah"
                                            value="{{ old('pekerjaan_ayah', $pendaftar->pekerjaan_ayah) }}"
                                            class="w-full text-sm rounded border-gray-200 dark:border-gray-600 dark:bg-gray-700">
                                    </div>
                                    <div class="col-span-2 md:col-span-1">
                                        <label class="block text-xs font-bold text-gray-500 mb-1">No HP Ayah</label>
                                        <input type="text" name="no_hp_ayah"
                                            value="{{ old('no_hp_ayah', $pendaftar->no_hp_ayah) }}"
                                            class="w-full text-sm rounded border-gray-200 dark:border-gray-600 dark:bg-gray-700">
                                    </div>
                                </div>
                            </div>
                            <!-- IBU -->
                            <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                <h4 class="font-bold mb-4 text-primary">Data Ibu</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="col-span-2 md:col-span-1">
                                        <label class="block text-xs font-bold text-gray-500 mb-1">Nama Ibu</label>
                                        <input type="text" name="nama_ibu"
                                            value="{{ old('nama_ibu', $pendaftar->nama_ibu) }}"
                                            class="w-full text-sm rounded border-gray-200 dark:border-gray-600 dark:bg-gray-700">
                                    </div>
                                    <div class="col-span-2 md:col-span-1">
                                        <label class="block text-xs font-bold text-gray-500 mb-1">NIK Ibu</label>
                                        <input type="text" name="nik_ibu" value="{{ old('nik_ibu', $pendaftar->nik_ibu) }}"
                                            class="w-full text-sm rounded border-gray-200 dark:border-gray-600 dark:bg-gray-700">
                                    </div>
                                    <div class="col-span-2 md:col-span-1">
                                        <label class="block text-xs font-bold text-gray-500 mb-1">Pekerjaan</label>
                                        <input type="text" name="pekerjaan_ibu"
                                            value="{{ old('pekerjaan_ibu', $pendaftar->pekerjaan_ibu) }}"
                                            class="w-full text-sm rounded border-gray-200 dark:border-gray-600 dark:bg-gray-700">
                                    </div>
                                    <div class="col-span-2 md:col-span-1">
                                        <label class="block text-xs font-bold text-gray-500 mb-1">No HP Ibu</label>
                                        <input type="text" name="no_hp_ibu"
                                            value="{{ old('no_hp_ibu', $pendaftar->no_hp_ibu) }}"
                                            class="w-full text-sm rounded border-gray-200 dark:border-gray-600 dark:bg-gray-700">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div
                    class="p-8 border-t border-gray-100 dark:border-gray-800 flex justify-end gap-3 bg-gray-50 dark:bg-gray-900/50">
                    <a href="{{ route('admin.data_calon_mahasiswa') }}"
                        class="px-5 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 font-bold text-sm hover:bg-white transition-colors">Batal</a>
                    <button type="submit"
                        class="px-5 py-2.5 bg-primary hover:bg-primary-dark text-white rounded-lg font-bold text-sm transition-colors shadow-lg shadow-primary/20">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection