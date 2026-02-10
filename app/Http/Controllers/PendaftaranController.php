<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{
    public function index()
    {
        return view('mahasiswa.pendaftaran');
    }

    public function store(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('PendaftaranController::store reached', $request->all());
        $rules = [
            'gelombang' => 'required',
            'pilihan_prodi' => 'required',
            'nik' => 'required|numeric|digits:16',
            'nisn' => 'required|numeric',
            'nama_lengkap' => 'required|string',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat_lengkap' => 'required|string',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kabupaten' => 'required|string',
            'provinsi' => 'required|string',
            'email' => 'required|email',
            'no_hp' => 'required',
            'nama_sekolah' => 'required|string',
            'jurusan_sekolah' => 'nullable|string',
            'tahun_lulus' => 'required|numeric',
            'nilai_rata_rata' => 'nullable|numeric',
            'alamat_sekolah' => 'nullable|string',
            // Modal 2 Additional
            'rt' => 'nullable',
            'rw' => 'nullable',
            'kode_pos' => 'nullable',
            'negara' => 'nullable',
            'agama' => 'nullable',
            'tinggi_badan' => 'nullable|numeric',
            'berat_badan' => 'nullable|numeric',
            'kewarganegaraan' => 'nullable',
            'status_pernikahan' => 'nullable',
            'npwp' => 'nullable',
            // School Detail
            'alamat_sekolah_kota' => 'nullable',
            'alamat_sekolah_provinsi' => 'nullable',
            // Parents
            'nama_ayah' => 'nullable|string',
            'nik_ayah' => 'nullable',
            'hp_ayah' => 'nullable',
            'nama_ibu' => 'nullable|string',
            'nik_ibu' => 'nullable',
            'hp_ibu' => 'nullable',
            'pekerjaan_ibu' => 'nullable|string',
            'penghasilan_ibu' => 'nullable',
            'nama_wali' => 'nullable|string',
            'no_hp_wali' => 'nullable',
            'sumber_biaya' => 'nullable',
            // Transfer
            'univ_asal' => 'nullable',
            'prodi_asal' => 'nullable',
            'status_akreditasi_asal' => 'nullable',
            'ipk' => 'nullable',
        ];

        if ($request->input('action') === 'draft') {
            // Relaxed rules for draft: only require minimal info to create a record
            $rules = [
                'gelombang' => 'nullable',
                'pilihan_prodi' => 'nullable',
                'nik' => 'nullable|numeric',
                'nama_lengkap' => 'nullable|string',
                'email' => 'nullable|email',
                'no_hp' => 'nullable',
                // Make everything else nullable
            ];
        }

        $request->validate($rules);

        $data = $request->except(['_token', 'action']);

        if ($request->input('action') === 'draft') {
            $defaults = [
                'gelombang' => '1',
                'pilihan_prodi' => '-',
                'nik' => '0000000000000000',
                'nisn' => '0',
                'nama_lengkap' => 'Calon Mahasiswa',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => '-',
                'tanggal_lahir' => '2000-01-01',
                'alamat_lengkap' => '-',
                'kelurahan' => '-',
                'kecamatan' => '-',
                'kabupaten' => '-',
                'provinsi' => '-',
                'no_hp' => '-',
                'nama_sekolah' => '-',
                'jurusan_sekolah' => '-',
                'tahun_lulus' => date('Y'),
                'nilai_rata_rata' => 0,
                'alamat_sekolah' => '-',
                'nama_ayah' => '-',
                'pekerjaan_ayah' => '-',
                'hp_ayah' => '-',
                'nama_ibu' => '-',
                'pekerjaan_ibu' => '-',
                'hp_ibu' => '-',
                'email' => 'draft' . time() . '@example.com', // Unique dummy email
            ];

            foreach ($defaults as $key => $val) {
                if (empty($data[$key])) {
                    $data[$key] = $val;
                }
            }
        }

        // Handle numeric fields that cannot be null in DB but are nullable in form
        $data['nilai_rata_rata'] = $data['nilai_rata_rata'] ?? 0;
        $data['tinggi_badan'] = $data['tinggi_badan'] ?? 0;
        $data['berat_badan'] = $data['berat_badan'] ?? 0;
        $data['penghasilan_ayah'] = $data['penghasilan_ayah'] ?? '< 1 Juta';
        $data['penghasilan_ibu'] = $data['penghasilan_ibu'] ?? '< 1 Juta';

        // Check if user already has a pendaftar record
        $existingPendaftar = null;
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
            $existingPendaftar = Pendaftar::where('user_id', Auth::id())->first();
        } else {
            // For guest (if allowed), maybe check email? But auth is now required so we stick to user_id
            $data['user_id'] = null;
        }

        try {
            if ($existingPendaftar) {
                // UPDATE existing record
                $existingPendaftar->update($data);
                $pendaftar = $existingPendaftar;
            } else {
                // CREATE new record
                $data['nomor_pendaftaran'] = 'REG-' . date('Y') . '-' . mt_rand(10000, 99999);
                $pendaftar = Pendaftar::create($data);

                // Send Welcome Email only on CREATE
                try {
                    \Illuminate\Support\Facades\Mail::to($pendaftar->email)->send(new \App\Mail\WelcomeEmail($pendaftar));
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Email Sending Failed: ' . $e->getMessage());
                }
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Draft Save Error: ' . $e->getMessage());
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['message' => 'Database Error: ' . $e->getMessage()], 500);
            }
            return back()->with('error', 'Gagal menyimpan data (DB Error).');
        }

        // Store ID in session for the next step
        session(['pendaftar_id' => $pendaftar->id]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['status' => 'success', 'redirect' => route('mahasiswa.upload')]);
        }

        return redirect()->route('mahasiswa.upload')->with('success', 'Data pendaftaran berhasil disimpan. Silakan unggah dokumen.');
    }

    public function uploadIndex()
    {
        if (!session()->has('pendaftar_id')) {
            return redirect()->route('mahasiswa.pendaftaran')->with('error', 'Silakan isi formulir pendaftaran terlebih dahulu.');
        }

        $pendaftar_id = session('pendaftar_id');
        $pendaftar = \App\Models\Pendaftar::find($pendaftar_id);

        $dokumen = [];
        if ($pendaftar) {
            $dokumen = \App\Models\DokumenPendaftar::where('pendaftar_id', $pendaftar->id)
                ->get()
                ->keyBy('jenis_dokumen'); // Returns collection keyed by jenis_dokumen
        }

        return view('mahasiswa.upload_berkas', compact('pendaftar', 'dokumen'));
    }

    public function uploadStore(Request $request)
    {
        $pendaftar_id = session('pendaftar_id');
        if (!$pendaftar_id) {
            return redirect()->route('mahasiswa.pendaftaran');
        }

        $rules = [
            'ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:2048',
            'ktp_ortu' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:2048',
            'akte' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:3072',
            'ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
            'kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:3072',
            'foto' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'transkrip' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:2048',
        ];

        $messages = [
            'mimes' => 'Format file :attribute harus berupa: :values.',
            'max' => 'Ukuran file :attribute maksimal :max KB.',
            'file' => ':attribute harus berupa file yang valid.',
            'uploaded' => 'Gagal mengunggah :attribute. Ukuran file mungkin melebihi batas server.',
        ];

        $attributes = [
            'ktp' => 'KTP',
            'ktp_ortu' => 'KTP Orang Tua',
            'akte' => 'Akte Kelahiran',
            'ijazah' => 'Ijazah',
            'kk' => 'Kartu Keluarga',
            'foto' => 'Pas Foto',
            'transkrip' => 'Transkrip Nilai',
            'bukti_pembayaran' => 'Bukti Pembayaran',
        ];

        $request->validate($rules, $messages, $attributes);

        $documents = ['ktp', 'ktp_ortu', 'akte', 'ijazah', 'kk', 'foto', 'transkrip', 'bukti_pembayaran'];

        foreach ($documents as $doc) {
            if ($request->hasFile($doc)) {
                $file = $request->file($doc);
                $path = $file->store('uploads', 'public');
                $originalName = $file->getClientOriginalName();

                \App\Models\DokumenPendaftar::create([
                    'pendaftar_id' => $pendaftar_id,
                    'jenis_dokumen' => $doc,
                    'file_path' => $path,
                    'original_name' => $originalName,
                ]);
            }
        }

        // Update status to Verifikasi so it appears in Admin Dashboard
        \App\Models\Pendaftar::where('id', $pendaftar_id)->update(['status' => 'Verifikasi']);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Pendaftaran berhasil diselesaikan!');
    }

    public function dashboard()
    {
        $pendaftar_id = session('pendaftar_id');
        $pendaftar = null;
        $dokumen = [];

        if ($pendaftar_id) {
            $pendaftar = \App\Models\Pendaftar::find($pendaftar_id);
        }

        // Fallback: Try finding by Auth ID if session missed or pendaftar not found
        if (!$pendaftar && \Illuminate\Support\Facades\Auth::check()) {
            $pendaftar = \App\Models\Pendaftar::where('user_id', \Illuminate\Support\Facades\Auth::id())->first();
            if ($pendaftar) {
                // Restore session
                session(['pendaftar_id' => $pendaftar->id]);
            }
        }

        if ($pendaftar) {
            // Fetch uploaded documents
            $dokumen = \App\Models\DokumenPendaftar::where('pendaftar_id', $pendaftar->id)
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->jenis_dokumen => $item];
                });
        }

        // Fetch Active Announcements
        $pengumuman = \App\Models\Pengumuman::where('is_active', true)->latest()->take(5)->get();

        // Fetch Upcoming Exam Schedule
        $jadwalUjian = \App\Models\JadwalSeleksi::where('tanggal', '>=', now())
            ->orderBy('tanggal', 'asc')
            ->first();

        return view('mahasiswa.dashboard', compact('pendaftar', 'dokumen', 'pengumuman', 'jadwalUjian'));
    }

    public function status()
    {
        $pendaftar_id = session('pendaftar_id');
        $pendaftar = null;

        if ($pendaftar_id) {
            $pendaftar = \App\Models\Pendaftar::find($pendaftar_id);
        }

        // Fallback: Try finding by Auth ID
        if (!$pendaftar && \Illuminate\Support\Facades\Auth::check()) {
            $pendaftar = \App\Models\Pendaftar::where('user_id', \Illuminate\Support\Facades\Auth::id())->first();
            if ($pendaftar) {
                // Restore session
                session(['pendaftar_id' => $pendaftar->id]);
            }
        }

        if (!$pendaftar) {
            return redirect()->route('mahasiswa.pendaftaran')->with('error', 'Silakan isi formulir pendaftaran terlebih dahulu.');
        }

        // Fetch Upcoming Exam Schedule
        $jadwalUjian = \App\Models\JadwalSeleksi::where('tanggal', '>=', now())
            ->orderBy('tanggal', 'asc')
            ->first();

        // Dynamic Data for Timeline
        $timeline = [
            'akun_created' => $pendaftar->user ? $pendaftar->user->created_at->format('d M Y') : $pendaftar->created_at->format('d M Y'),
            'biodata_completed' => $pendaftar->created_at->format('d M Y'),
            'verifikasi_status' => $pendaftar->status == 'Diterima' ? 'Selesai' : ($pendaftar->status == 'Ditolak' ? 'Ditolak' : 'Sedang Proses'),
            'ujian_jadwal' => $jadwalUjian ? \Carbon\Carbon::parse($jadwalUjian->tanggal)->translatedFormat('d M Y') : 'Menunggu Jadwal',
            'pengumuman_estimasi' => \Carbon\Carbon::now()->addDays(14)->translatedFormat('d M Y'),
        ];

        $progress = 40;
        if ($pendaftar->created_at)
            $progress = 60;
        if ($pendaftar->status == 'Diterima')
            $progress = 100;
        if ($pendaftar->status == 'Ditolak')
            $progress = 100;

        return view('mahasiswa.status', compact('pendaftar', 'timeline', 'progress'));
    }

    public function cetakKartu()
    {
        $pendaftar_id = session('pendaftar_id');
        $pendaftar = null;

        if ($pendaftar_id) {
            $pendaftar = \App\Models\Pendaftar::find($pendaftar_id);
        }

        if (!$pendaftar && \Illuminate\Support\Facades\Auth::check()) {
            $pendaftar = \App\Models\Pendaftar::where('user_id', \Illuminate\Support\Facades\Auth::id())->first();
        }

        if (!$pendaftar) {
            return redirect()->route('mahasiswa.pendaftaran');
        }

        if ($pendaftar->status != 'Diterima') {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Status Anda belum diterima.');
        }

        return view('mahasiswa.kartu_peserta', compact('pendaftar'));
    }
}
