@extends(
    auth()->user()->role === 'admin' ? 'layouts.admin' : 
    (auth()->user()->role === 'pimpinan' ? 'layouts.pimpinan' : 'layouts.student')
)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 pb-24 lg:pb-8">
    
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white">Profil Pengguna</h1>
        <p class="text-slate-500 dark:text-slate-400 mt-1">Kelola informasi akun dan preferensi keamanan Anda.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        @method('PUT')

        <!-- Left Sidebar: Identity & Stats -->
        <div class="lg:col-span-1 flex flex-col gap-6">
            <!-- Profile Card -->
            <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-sm border border-slate-100 dark:border-slate-800 flex flex-col items-center text-center relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-br from-blue-500 to-indigo-600"></div>
                
                <div class="relative mt-8 mb-4 flex flex-col items-center gap-4">
                    <div class="relative group">
                        <div class="size-32 rounded-full border-4 border-white dark:border-surface-dark shadow-md overflow-hidden bg-slate-100 relative group-hover:scale-105 transition-transform duration-300 flex items-center justify-center">
                            <img id="profile-preview" src="{{ auth()->user()->profile_photo_path ? Storage::url(auth()->user()->profile_photo_path) : '' }}" 
                                alt="{{ auth()->user()->name }}" 
                                class="w-full h-full object-cover {{ auth()->user()->profile_photo_path ? '' : 'hidden' }}">
                            
                            <div id="profile-icon" class="w-full h-full flex items-center justify-center bg-slate-200 dark:bg-slate-700 text-slate-400 {{ auth()->user()->profile_photo_path ? 'hidden' : '' }}">
                                <span class="material-symbols-outlined text-6xl">person</span>
                            </div>
                            
                            <!-- Photo Upload Overlay (Desktop Hover) -->
                            <label for="photo-upload" class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer z-10">
                                <span class="material-symbols-outlined text-white text-3xl">photo_camera</span>
                            </label>
                        </div>

                        <!-- Mobile Upload Button (Visible always on small screens, hidden on lg group-hover) -->
                        <label for="photo-upload" class="lg:hidden absolute bottom-0 right-0 bg-white dark:bg-slate-700 text-primary dark:text-white p-2 rounded-full shadow-lg border border-slate-200 dark:border-slate-600 flex items-center justify-center cursor-pointer z-20">
                            <span class="material-symbols-outlined text-xl">edit</span>
                        </label>
                    </div>
                    
                    <input type="file" id="photo-upload" name="photo" class="hidden" accept="image/*" onchange="previewImage(this)">
                    
                    @error('photo')
                        <span class="text-red-500 text-xs font-bold">{{ $message }}</span>
                    @enderror
                </div>

                <h2 class="text-xl font-bold text-slate-900 dark:text-white">{{ auth()->user()->name }}</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mb-4 capitalize">{{ auth()->user()->role ?? 'User' }}</p>

                @if(auth()->user()->role === 'mahasiswa' && isset($pendaftar))
                    <div class="w-full pt-4 border-t border-slate-100 dark:border-slate-800 flex flex-col gap-2">
                        <div class="flex justify-between text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">
                            <span>Kelengkapan Data</span>
                            <span class="text-primary">{{ $pendaftar->progress_completion ?? 0 }}%</span>
                        </div>
                        <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-2 overflow-hidden">
                            <div class="bg-primary h-2 rounded-full transition-all duration-500" style="width: {{ $pendaftar->progress_completion ?? 0 }}%"></div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Mahasiswa Specific: Program Studi -->
            @if(auth()->user()->role === 'mahasiswa' && isset($pendaftar))
                <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 shadow-sm border border-slate-100 dark:border-slate-800">
                    <h3 class="font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">school</span>
                        Program Studi Pilihan
                    </h3>
                    
                    @if($pendaftar->pilihan_prodi)
                        <div class="flex flex-col gap-3">
                            @foreach(explode(',', $pendaftar->pilihan_prodi) as $index => $prodi)
                            <div class="p-3 bg-slate-50 dark:bg-slate-800/50 rounded-lg border border-slate-100 dark:border-slate-700">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wide block mb-1">Pilihan {{ $index + 1 }}</span>
                                <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">{{ trim($prodi) }}</span>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4 text-slate-500 text-sm italic">
                            Belum memilih program studi.
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Right Content: Form -->
        <div class="lg:col-span-2 flex flex-col gap-6">
            <!-- Account Information -->
            <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 md:p-8 shadow-sm border border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100 dark:border-slate-800">
                    <span class="material-symbols-outlined text-primary text-2xl">manage_accounts</span>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Informasi Akun</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary transition-colors">
                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-span-2 md:col-span-1">
                         <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary transition-colors">
                        @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Additional Read-only Info for Context -->
                    @if(auth()->user()->role === 'mahasiswa' && isset($pendaftar))
                    <div class="col-span-2 md:col-span-1">
                         <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nomor Pendaftaran</label>
                        <input type="text" value="{{ $pendaftar->nomor_pendaftaran }}" readonly class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500 cursor-not-allowed">
                    </div>
                    @endif
                </div>
            </div>

            <!-- Security (Password Change) -->
            <div class="bg-white dark:bg-surface-dark rounded-2xl p-6 md:p-8 shadow-sm border border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100 dark:border-slate-800">
                    <span class="material-symbols-outlined text-red-500 text-2xl">shield_lock</span>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Keamanan</h3>
                </div>

                <div class="grid grid-cols-1 gap-6" x-data="{ changePassword: false }">
                    <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-100 dark:border-slate-700">
                        <div>
                            <p class="font-bold text-slate-900 dark:text-white">Ganti Kata Sandi</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Disarankan menggunakan kombinasi huruf dan angka.</p>
                        </div>
                        <button type="button" @click="changePassword = !changePassword" class="px-4 py-2 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-lg text-sm font-bold text-slate-700 dark:text-white hover:bg-slate-50 transition-colors">
                            <span x-text="changePassword ? 'Batal' : 'Ubah Password'"></span>
                        </button>
                    </div>

                    <div x-show="changePassword" x-transition class="grid grid-cols-1 gap-4 p-4 border border-slate-200 dark:border-slate-700 rounded-xl bg-slate-50/50 dark:bg-slate-800/30">
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Password Saat Ini</label>
                            <input type="password" name="current_password" class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary transition-colors" placeholder="Wajib diisi jika ingin mengganti password">
                            @error('current_password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Password Baru</label>
                            <input type="password" name="new_password" class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary transition-colors">
                            @error('new_password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" class="w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary transition-colors">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sticky Save Button (Mobile) or Standard (Desktop) -->
            <div class="flex justify-end pt-8 pb-12 md:pb-0">
                <button type="submit" class="flex items-center gap-2 px-8 py-4 bg-primary text-white font-bold rounded-xl shadow-lg shadow-blue-500/30 hover:bg-blue-700 hover:-translate-y-0.5 transition-all w-full md:w-auto justify-center">
                    <span class="material-symbols-outlined">save</span>
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('profile-preview');
                const icon = document.getElementById('profile-icon');
                
                if(img) {
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                }
                if(icon) {
                    icon.classList.add('hidden');
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
