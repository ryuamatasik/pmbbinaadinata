<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pendaftars = Pendaftar::latest()->take(5)->get();
        $totalPendaftar = Pendaftar::count();
        $menungguVerifikasi = Pendaftar::where('status', 'Verifikasi')->count();
        $lolosSeleksi = Pendaftar::where('status', 'Diterima')->count();
        $ditolak = Pendaftar::where('status', 'Ditolak')->count();
        // Pendapatan Real (Hanya yang status_pembayaran = 'lunas')
        $pendapatan = Pendaftar::where('status_pembayaran', 'lunas')->count() * 150000;

        // Jadwal Ujian (DEBUG: Ambil yang paling baru dibuat, abaikan tanggal)
        $jadwalUjian = \App\Models\JadwalSeleksi::latest()->first();

        // Sebaran Pendaftar
        $prodiList = ['Sistem Informasi', 'Sistem Komputer', 'Bisnis Digital'];
        $sebaranProdi = [];

        foreach ($prodiList as $prodi) {
            $totalInProdi = Pendaftar::where('pilihan_prodi', $prodi)->count();
            $acceptedInProdi = Pendaftar::where('pilihan_prodi', $prodi)->where('status', 'Diterima')->count();

            $percentage = $totalInProdi > 0 ? round(($acceptedInProdi / $totalInProdi) * 100) : 0;

            // Assign color based on prodi for consistent UI
            $color = match ($prodi) {
                'Sistem Informasi' => ['bg' => 'bg-primary', 'text' => 'text-primary'],
                'Sistem Komputer' => ['bg' => 'bg-purple-400', 'text' => 'text-purple-600'],
                'Bisnis Digital' => ['bg' => 'bg-blue-400', 'text' => 'text-blue-600'],
                default => ['bg' => 'bg-gray-400', 'text' => 'text-gray-600'],
            };

            $sebaranProdi[] = [
                'nama' => $prodi,
                'count' => $acceptedInProdi,
                'total' => $totalInProdi,
                'percentage' => $percentage,
                'color' => $color
            ];
        }

        return view('admin.dashboard', compact('pendaftars', 'totalPendaftar', 'menungguVerifikasi', 'lolosSeleksi', 'ditolak', 'pendapatan', 'jadwalUjian', 'sebaranProdi'));
    }

    public function dataCalonMahasiswa(Request $request)
    {
        $query = Pendaftar::latest();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nomor_pendaftaran', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->status != '' && $request->status != 'Semua Status') {
            $query->where('status', $request->status);
        }

        if ($request->has('prodi') && $request->prodi != '' && $request->prodi != 'Semua Program Studi') {
            $query->where('pilihan_prodi', $request->prodi);
        }

        $pendaftars = $query->paginate(10);

        return view('admin.data_calon_mahasiswa', compact('pendaftars'));
    }

    public function verifikasiBerkas(Request $request, $id = null)
    {
        $status = $request->query('status', 'Verifikasi'); // Default to 'Verifikasi' (Menunggu)

        // Mapping visual tabs to DB statuses
        // Tab: Menunggu -> DB: Verifikasi
        // Tab: Selesai -> DB: Diterima
        // Tab: Revisi -> DB: Ditolak
        $dbStatus = $status;
        if ($status == 'Menunggu')
            $dbStatus = 'Verifikasi';
        if ($status == 'Selesai')
            $dbStatus = 'Diterima';
        if ($status == 'Revisi')
            $dbStatus = 'Ditolak';

        // Counts for tabs
        $countMenunggu = Pendaftar::where('status', 'Verifikasi')->count();
        $countSelesai = Pendaftar::where('status', 'Diterima')->count();
        $countRevisi = Pendaftar::where('status', 'Ditolak')->count();

        // Fetch list based on status
        $antrean = Pendaftar::where('status', $dbStatus)->orderBy('updated_at', 'desc')->get();

        $pendaftar = null;
        if ($id) {
            $pendaftar = Pendaftar::find($id); // Find global (allow viewing ID even if status changed)
        } elseif ($antrean->isNotEmpty()) {
            $pendaftar = $antrean->first();
        }

        $dokumen = [];
        if ($pendaftar) {
            $dokumen = \App\Models\DokumenPendaftar::where('pendaftar_id', $pendaftar->id)
                ->get()
                ->mapWithKeys(function ($item) {
                    return [
                        $item->jenis_dokumen => [
                            'id' => $item->id,
                            'url' => \Illuminate\Support\Facades\Storage::url($item->file_path),
                            'status' => $item->status,
                            'catatan' => $item->catatan
                        ]
                    ];
                })
                ->toArray();
        }

        return view('admin.verifikasi_berkas', compact('antrean', 'pendaftar', 'dokumen', 'countMenunggu', 'countSelesai', 'countRevisi', 'status'));
    }

    // VERIFIKASI FILES
    public function storeVerifikasi(Request $request)
    {
        $request->validate([
            'pendaftar_id' => 'required|exists:pendaftar,id',
            'status' => 'required|in:Diterima,Ditolak',
            'catatan' => 'nullable|string'
        ]);

        $pendaftar = Pendaftar::findOrFail($request->pendaftar_id);

        $pendaftar->status = $request->status;
        if ($request->has('catatan')) {
            $pendaftar->catatan = $request->catatan;
        }

        $pendaftar->save();

        // Send Email notification
        try {
            \Illuminate\Support\Facades\Mail::to($pendaftar->email)
                ->send(new \App\Mail\StatusPendaftaranEmail($pendaftar, $request->status, $request->catatan));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Verifikasi Email Failed: ' . $e->getMessage());
        }

        if ($request->status == 'Diterima') {
            return redirect()->route('admin.verifikasi_berkas', ['status' => 'Selesai'])->with('success', 'Berkas berhasil diverifikasi dan diterima.');
        } else {
            return redirect()->route('admin.verifikasi_berkas', ['status' => 'Revisi'])->with('success', 'Berkas ditolak dan status revisi telah dikirim.');
        }
    }

    public function jadwalSeleksi()
    {
        $jadwals = \App\Models\JadwalSeleksi::latest()->get();
        return view('admin.jadwal_seleksi', compact('jadwals'));
    }

    public function storeJadwal(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
        ]);

        \App\Models\JadwalSeleksi::create($request->all());

        return back()->with('success', 'Jadwal seleksi berhasil ditambahkan.');
    }

    public function updateJadwal(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
        ]);

        $jadwal = \App\Models\JadwalSeleksi::findOrFail($id);
        $jadwal->update($request->all());

        return back()->with('success', 'Jadwal seleksi berhasil diperbarui.');
    }

    public function destroyJadwal($id)
    {
        $jadwal = \App\Models\JadwalSeleksi::findOrFail($id);
        $jadwal->delete();

        return back()->with('success', 'Jadwal seleksi berhasil dihapus.');
    }

    // PENGUMUMAN METHODS
    public function pengumuman()
    {
        $pengumuman = Pengumuman::latest()->get();
        return view('admin.pengumuman', compact('pengumuman'));
    }

    public function storePengumuman(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'is_active' => 'boolean',
        ]);

        // Checkbox returns '1' or null/nothing, handle boolean conversion
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        Pengumuman::create($data);

        return back()->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function updatePengumuman(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $pengumuman = Pengumuman::findOrFail($id);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active'); // Handle checkbox

        $pengumuman->update($data);

        return back()->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroyPengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        return back()->with('success', 'Pengumuman berhasil dihapus.');
    }


    public function kelolaDokumen()
    {
        $dokumens = \App\Models\SyaratDokumen::all();
        return view('admin.kelola_dokumen', compact('dokumens'));
    }

    public function pengaturan()
    {
        $gelombangs = \App\Models\Gelombang::latest()->get()->map(function ($g) {
            return [
                'id' => $g->id,
                'tahun' => $g->tahun,
                'nama' => $g->nama,
                'status' => $g->status,
                'class' => $g->status == 'Aktif'
                    ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-500'
                    : 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400'
            ];
        });

        $settings = \App\Models\SystemSetting::all()->pluck('value', 'key');

        return view('admin.pengaturan', compact('gelombangs', 'settings'));
    }

    public function saveProfil(Request $request)
    {
        $request->validate([
            'profile_photo' => 'nullable|image|max:2048',
            'nama_universitas' => 'nullable|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
        ]);

        // Handle Admin Profile Photo
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            auth()->user()->update(['profile_photo_path' => $path]);
        }

        // Handle Campus Profile Settings
        $settings = [
            'nama_universitas' => $request->nama_universitas,
            'tagline' => $request->tagline,
            'visi' => $request->visi,
            'misi' => $request->misi,
        ];

        foreach ($settings as $key => $value) {
            \App\Models\SystemSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Pengaturan profil berhasil diperbarui.');
    }

    public function storeGelombang(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
            'nama' => 'required',
        ]);

        \App\Models\Gelombang::create([
            'tahun' => $request->tahun,
            'nama' => $request->nama,
            'status' => 'Aktif'
        ]);

        return back()->with('success', 'Gelombang pendaftaran berhasil ditambahkan.');
    }

    public function updateGelombangStatus(Request $request, $id)
    {
        $gelombang = \App\Models\Gelombang::findOrFail($id);
        $gelombang->update(['status' => $request->status]);

        $statusMsg = $request->status == 'Aktif' ? 'dibuka' : 'ditutup';
        return back()->with('success', "Gelombang pendaftaran berhasil $statusMsg.");
    }

    public function updateStatusPembayaran(Request $request, $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        // Toggle logic or set from request. For simple toggle button:
        $newStatus = $pendaftar->status_pembayaran == 'lunas' ? 'belum_bayar' : 'lunas';
        $pendaftar->update(['status_pembayaran' => $newStatus]);

        $msg = $newStatus == 'lunas' ? 'Lunas' : 'Belum Bayar';

        // Sync with Enrollment Status
        if ($newStatus == 'lunas') {
            $pendaftar->update(['status' => 'Diterima']);

            // Send Email for Payment/Acceptance
            try {
                \Illuminate\Support\Facades\Mail::to($pendaftar->email)->send(new \App\Mail\StatusPendaftaranEmail($pendaftar, 'Diterima'));
            } catch (\Exception $e) {
                // Log error
            }

        } elseif ($newStatus == 'belum_bayar' && $pendaftar->status == 'Diterima') {
            $pendaftar->update(['status' => 'Verifikasi']); // Revert if unpaid
        }

        return back()->with('success', "Status pembayaran diubah menjadi $msg.");
    }

    public function updateAkun(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ]);

        $user = auth()->user();

        if (!\Illuminate\Support\Facades\Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Kata sandi lama salah.');
        }

        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Kata sandi berhasil diperbarui.');
    }

    public function detail($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);

        // Fetch uploaded documents
        $dokumen = \App\Models\DokumenPendaftar::where('pendaftar_id', $id)->get();

        // Pass documents to the view as well, even if the provided HTML structure 
        // mainly focuses on a few hardcoded examples, we should try to make it dynamic where possible.
        return view('admin.detail-pendaftar', compact('pendaftar', 'dokumen'));
    }
    public function updateStatus(Request $request, $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $oldStatus = $pendaftar->status;

        $request->validate([
            'status' => 'required|in:Diterima,Ditolak,Verifikasi,Revisi', // Add Revisi if strictly used
        ]);

        $status = $request->status;

        // Custom mapping if UI sends specific strings
        if ($status == 'Terima')
            $status = 'Diterima';
        if ($status == 'Tolak')
            $status = 'Ditolak';

        $pendaftar->update(['status' => $status]);

        // Send Email if status changed
        if ($oldStatus != $status) {
            try {
                \Illuminate\Support\Facades\Mail::to($pendaftar->email)->send(new \App\Mail\StatusPendaftaranEmail($pendaftar, $status));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Status Email Failed: ' . $e->getMessage());
            }
        }

        return back()->with('success', "Status pendaftaran berhasil diperbarui menjadi $status.");
    }
    public function destroy($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);

        // Delete User Account if exists (Strict Delete)
        if ($pendaftar->user_id) {
            $user = \App\Models\User::find($pendaftar->user_id);
            if ($user) {
                // If the user being deleted is the currently logged-in admin
                if ($user->id === auth()->id()) {
                    // Do NOT delete the User, only delete the Pendaftar record
                    // This allows cleaning up duplicate Pendaftar entries connected to the Admin's account
                    $pendaftar->delete();
                    return back()->with('success', 'Data pendaftaran dihapus. Akun pengguna Anda TETAP AKTIF.');
                }

                // For other users (students), delete the account as well
                $user->delete();
            }
        }

        $pendaftar->delete();

        return back()->with('success', 'Data pendaftar dan akun berhasil dihapus.');
    }

    public function edit($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        return view('admin.edit_pendaftar', compact('pendaftar'));
    }

    public function update(Request $request, $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);

        $validatedData = $request->validate([
            // Data Utama
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pendaftar,email,' . $id,
            'no_hp' => 'required|string|max:20',
            'nik' => 'nullable|numeric|digits:16',
            'nisn' => 'nullable|numeric|digits:10',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',

            // Alamat
            'alamat_lengkap' => 'required|string',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'kode_pos' => 'nullable|numeric',
            'desa_kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',

            // Data Sekolah & Pilihan
            'nama_sekolah' => 'required|string|max:255',
            'tahun_lulus' => 'required|numeric|digits:4',
            'nilai_rata_rata' => 'required|numeric|between:0,100',
            'pilihan_prodi' => 'required|string',

            // Data Orang Tua (Ayah)
            'nama_ayah' => 'required|string|max:255',
            'nik_ayah' => 'nullable|numeric|digits:16',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'no_hp_ayah' => 'nullable|string|max:20',

            // Data Orang Tua (Ibu)
            'nama_ibu' => 'required|string|max:255',
            'nik_ibu' => 'nullable|numeric|digits:16',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'no_hp_ibu' => 'nullable|string|max:20',
        ]);

        $pendaftar->update($validatedData);

        return redirect()->route('admin.data_calon_mahasiswa')->with('success', 'Data pendaftar berhasil diperbarui.');
    }



    public function exportDataCalonMahasiswa()
    {
        $fileName = 'data_calon_mahasiswa_' . date('Y-m-d_H-i-s') . '.csv';
        $pendaftars = Pendaftar::latest()->get();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array(
            'No',
            'No Pendaftaran',
            'Nama Lengkap',
            'NIK',
            'NISN',
            'JK',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Pilihan Prodi',
            'Gelombang',
            'Status',
            'Pembayaran',
            'Email',
            'No HP',
            'Alamat Lengkap',
            'Provinsi',
            'Kabupaten',
            'Asal Sekolah',
            'Tahun Lulus',
            'Nilai Rata-rata',
            'Nama Ayah',
            'Nama Ibu',
            'Nama Wali',
            'No HP Ortu',
            'Tanggal Daftar'
        );

        $callback = function () use ($pendaftars, $columns) {
            $file = fopen('php://output', 'w');

            // Add BOM for Excel UTF-8 compatibility
            fwrite($file, "\xEF\xBB\xBF");

            // Use semicolon (;) separator which is safer for Excel in many regions
            fputcsv($file, $columns, ';');

            foreach ($pendaftars as $index => $row) {
                fputcsv($file, array(
                    $index + 1,
                    $row->nomor_pendaftaran,
                    $row->nama_lengkap,
                    $row->nik,
                    $row->nisn,
                    $row->jenis_kelamin,
                    $row->tempat_lahir,
                    $row->tanggal_lahir,
                    $row->pilihan_prodi,
                    $row->gelombang,
                    ucfirst($row->status),
                    $row->status_pembayaran == 'lunas' ? 'Lunas' : 'Belum Bayar',
                    $row->email,
                    $row->no_hp,
                    $row->alamat_lengkap,
                    $row->provinsi,
                    $row->kabupaten,
                    $row->nama_sekolah,
                    $row->tahun_lulus,
                    $row->nilai_rata_rata,
                    $row->nama_ayah,
                    $row->nama_ibu,
                    $row->nama_wali,
                    $row->hp_ayah ?? $row->hp_ibu ?? '-',
                    $row->created_at->format('d-m-Y H:i')
                ), ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    public function updateDokumenStatus(Request $request, $id)
    {
        \Illuminate\Support\Facades\Log::info("Update Dokumen Status: ID=$id", $request->all());

        $request->validate([
            'status' => 'required|in:valid,invalid',
            'catatan' => 'nullable|string'
        ]);

        $dokumen = \App\Models\DokumenPendaftar::findOrFail($id);
        $dokumen->update([
            'status' => $request->status,
            'catatan' => $request->catatan
        ]);

        return response()->json(['success' => true, 'message' => 'Status dokumen berhasil diperbarui.']);
    }
}
