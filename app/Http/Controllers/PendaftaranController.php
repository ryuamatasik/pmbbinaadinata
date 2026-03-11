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
        $pendaftar = null;
        if (Auth::check()) {
            $pendaftar = Pendaftar::where('user_id', Auth::id())->first();
        }
        return view('mahasiswa.pendaftaran', compact('pendaftar'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $pendaftar = \App\Models\Pendaftar::where('user_id', $user->id)->first();
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

        if ($request->input('action') === 'draft' || $request->input('action') === 'submit') {
            // Relaxed rules: only require minimal info to create/update a record
            // Enforce only the most critical fields if necessary, or make all nullable
            $rules = [
                'gelombang' => 'nullable',
                'pilihan_prodi' => 'nullable',
                'nik' => 'nullable|numeric',
                'nama_lengkap' => 'nullable|string',
                'email' => 'nullable|email',
                'no_hp' => 'nullable',
            ];
        }

        $request->validate($rules);

        $data = $request->except(['_token', 'action']);

        if ($request->input('action') === 'draft' || $request->input('action') === 'submit') {
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
                'email' => Auth::user()->email, // Use authenticated user's email if empty
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

        // Ensure KPS/KIP are strings "Ya"/"Tidak" to match application logic
        $data['penerima_kps'] = $data['penerima_kps'] ?? 'Tidak';
        $data['peserta_kip'] = $data['peserta_kip'] ?? 'Tidak';

        // Handle empty date strings to prevent MySQL strict mode errors (Invalid datetime format)
        if (empty($data['tanggal_lahir_ayah']))
            $data['tanggal_lahir_ayah'] = null;
        if (empty($data['tanggal_lahir_ibu']))
            $data['tanggal_lahir_ibu'] = null;

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
            return response()->json(['status' => 'success', 'redirect' => $request->input('action') === 'draft' ? route('mahasiswa.pendaftaran') : route('mahasiswa.upload')]);
        }

        if ($request->input('action') === 'draft') {
            return redirect()->route('mahasiswa.pendaftaran')->with('success', 'Data draf pendaftaran berhasil disimpan.')->with('was_draft', true);
        }

        return redirect()->route('mahasiswa.upload')->with('success', 'Data pendaftaran berhasil disimpan. Silakan unggah dokumen.');
    }

    public function uploadIndex()
    {
        $pendaftar = \App\Models\Pendaftar::where('user_id', Auth::id())->first();

        if (!$pendaftar) {
            return redirect()->route('mahasiswa.pendaftaran')->with('error', 'Silakan isi formulir pendaftaran terlebih dahulu.');
        }

        // Keep session for legacy compatibility if needed, but primary is DB
        session(['pendaftar_id' => $pendaftar->id]);

        $dokumen = [];
        if ($pendaftar) {
            $dokumen = \App\Models\DokumenPendaftar::where('pendaftar_id', $pendaftar->id)
                ->get()
                ->keyBy('jenis_dokumen'); // Returns collection keyed by jenis_dokumen
        }

        $syaratDokumen = \App\Models\SyaratDokumen::all();

        return view('mahasiswa.upload_berkas', compact('pendaftar', 'dokumen', 'syaratDokumen'));
    }

    public function uploadStore(Request $request)
    {
        $pendaftar = \App\Models\Pendaftar::where('user_id', Auth::id())->first();
        if (!$pendaftar) {
            return redirect()->route('mahasiswa.pendaftaran')->with('error', 'Silakan isi formulir pendaftaran terlebih dahulu.');
        }
        $pendaftar_id = $pendaftar->id;

        $syaratDokumen = \App\Models\SyaratDokumen::all();
        $rules = [];
        $attributes = [];

        foreach ($syaratDokumen as $syarat) {
            $field = \Illuminate\Support\Str::slug($syarat->nama, '_');

            if ($request->hasFile($field)) {
                $file = $request->file($field);
                if ($file->isValid()) {
                    $maxSize = (int) $syarat->max_size * 1024;
                    $rules[$field] = "file|max:{$maxSize}";
                    $attributes[$field] = $syarat->nama;
                }
            }
        }

        $messages = [
            'max' => 'Ukuran file :attribute terlalu besar (Maks: :max KB).',
            'file' => ':attribute harus berupa file yang valid.',
            'uploaded' => 'Gagal mengunggah :attribute. Batas server mungkin terlampaui (Maks total: 30MB).',
        ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules, $messages, $attributes);

        // Manual Extension Check Hook (More robust than MIME detection)
        $validator->after(function ($validator) use ($request, $syaratDokumen) {
            $debugLog = "--- Upload Debug " . date('Y-m-d H:i:s') . " ---\n";

            foreach ($syaratDokumen as $syarat) {
                $field = \Illuminate\Support\Str::slug($syarat->nama, '_');
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $fileExt = strtolower($file->getClientOriginalExtension());

                    // Sanitize comparison: remove spaces and dots
                    $formatRaw = str_replace([' ', '.'], '', $syarat->format);
                    $allowedExts = explode(',', strtolower(str_replace('/', ',', $formatRaw)));

                    $debugLog .= "Field: [{$field}], File: [{$file->getClientOriginalName()}], Ext: [{$fileExt}], Allowed: [" . implode(',', $allowedExts) . "]\n";

                    if (!in_array($fileExt, $allowedExts)) {
                        $validator->errors()->add($field, "Format file {$syarat->nama} (.{$fileExt}) tidak didukung. Harus berupa: " . implode(', ', $allowedExts));
                        $debugLog .= ">> REJECTED: Extension mismatch\n";
                    } else {
                        $debugLog .= ">> ACCEPTED\n";
                    }
                }
            }

            @file_put_contents(storage_path('logs/upload_debug.log'), $debugLog, FILE_APPEND);
            \Illuminate\Support\Facades\Log::info($debugLog);
        });

        $validator->validate();

        foreach ($syaratDokumen as $syarat) {
            $field = \Illuminate\Support\Str::slug($syarat->nama, '_');

            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $path = $file->store('uploads', 'public');
                $originalName = $file->getClientOriginalName();

                // Delete old one if exists
                \App\Models\DokumenPendaftar::where('pendaftar_id', $pendaftar_id)
                    ->where('jenis_dokumen', $field)
                    ->delete();

                \App\Models\DokumenPendaftar::create([
                    'pendaftar_id' => $pendaftar_id,
                    'jenis_dokumen' => $field,
                    'file_path' => $path,
                    'original_name' => $originalName,
                    'status' => 'valid' // Default to valid when uploaded by user
                ]);
            }
        }

        if ($request->input('action') === 'draft') {
            return redirect()->back()->with('success', 'Draf dokumen berhasil disimpan.')->with('was_draft', true);
        }

        // Update status to Verifikasi so it appears in Admin Dashboard if they click Selesai
        // regardless of completeness, as requested for a "non-blocking" flow.
        // The Admin can then request revisions if something is missing.
        \App\Models\Pendaftar::where('id', $pendaftar_id)->update(['status' => 'Verifikasi']);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Pendaftaran berhasil diselesaikan! Data Anda kini sedang dalam proses verifikasi.');
    }

    public function dashboard()
    {
        $pendaftar_id = session('pendaftar_id');
        $pendaftar = null;
        $dokumen = [];
        $progress = 0;
        $activeGelombang = \App\Models\Gelombang::where('status', 'Aktif')->first();

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

        $hasRejection = false;
        if ($pendaftar) {
            // Fetch uploaded documents
            $dokumen = \App\Models\DokumenPendaftar::where('pendaftar_id', $pendaftar->id)
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->jenis_dokumen => $item];
                });

            $hasRejection = $dokumen->contains('status', 'invalid') || $pendaftar->status == 'Ditolak';

            // Calculate Progress (Synchronized with Mandatory UI Fields)
            $fields = [
                'pilihan_prodi',
                'nik',
                'nomor_kk',
                'nama_lengkap',
                'jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
                'agama',
                'alamat_lengkap',
                'kelurahan',
                'kecamatan',
                'kabupaten',
                'provinsi',
                'email',
                'no_hp',
                'status_pernikahan',
                'tinggal_bersama',
                'kode_pos',
                'nama_sekolah',
                'jurusan_sekolah',
                'tahun_lulus',
                'status_ayah',
                'nama_ayah',
                'nik_ayah',
                'hp_ayah',
                'alamat_ayah',
                'status_ibu',
                'nama_ibu',
                'nik_ibu',
                'hp_ibu',
                'alamat_ibu'
            ];
            $filled = 0;
            foreach ($fields as $field) {
                if (!empty($pendaftar->$field) && $pendaftar->$field !== '-') {
                    $filled++;
                }
            }

            // Document progress (Dynamic based on DB requirements)
            $mandatoryDocs = \App\Models\SyaratDokumen::where('wajib', true)->get();
            $mandatoryDocSlugs = $mandatoryDocs->map(function ($doc) {
                return \Illuminate\Support\Str::slug($doc->nama, '_');
            })->toArray();

            $docsFilled = $dokumen->whereIn('jenis_dokumen', $mandatoryDocSlugs)->count();

            $totalFieldsCount = count($fields) + count($mandatoryDocSlugs);
            $totalFilledCount = $filled + $docsFilled;
            $progress = $totalFieldsCount > 0 ? round(($totalFilledCount / $totalFieldsCount) * 100) : 0;
        }

        // Fetch Active Announcements
        $pengumuman = \App\Models\Pengumuman::where('is_active', true)->latest()->take(5)->get();

        // Fetch Upcoming Exam Schedule
        $jadwalUjian = \App\Models\JadwalSeleksi::where('tanggal', '>=', now())
            ->orderBy('tanggal', 'asc')
            ->first();

        return view('mahasiswa.dashboard', compact('pendaftar', 'dokumen', 'pengumuman', 'jadwalUjian', 'hasRejection', 'progress', 'activeGelombang'));
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

        if (!in_array($pendaftar->status, ['Verifikasi', 'Diterima'])) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Status Anda belum diverifikasi atau diterima.');
        }

        if ($pendaftar->status == 'Diterima' && empty($pendaftar->nomor_ujian)) {
            $lastNumber = \App\Models\Pendaftar::whereNotNull('nomor_ujian')->count();
            $pendaftar->nomor_ujian = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            $pendaftar->save();
        }

        return view('mahasiswa.kartu_peserta', compact('pendaftar'));
    }

    public function showPengumuman($id)
    {
        $pendaftar_id = session('pendaftar_id');
        $pendaftar = null;

        if ($pendaftar_id) {
            $pendaftar = \App\Models\Pendaftar::find($pendaftar_id);
        }

        if (!$pendaftar && \Illuminate\Support\Facades\Auth::check()) {
            $pendaftar = \App\Models\Pendaftar::where('user_id', \Illuminate\Support\Facades\Auth::id())->first();
        }

        $pengumuman = \App\Models\Pengumuman::findOrFail($id);

        return view('mahasiswa.show-pengumuman', compact('pendaftar', 'pengumuman'));
    }
}
