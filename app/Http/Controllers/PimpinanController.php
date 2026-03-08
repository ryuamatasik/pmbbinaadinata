<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    public function dashboard()
    {
        $totalPendaftar = Pendaftar::count();
        $totalLolos = Pendaftar::where('status', 'diterima')->count();

        // Target penerimaan from Settings
        $targetPenerimaan = \App\Models\SystemSetting::where('key', 'target_kuota')->value('value') ?? 3500;
        $persentaseKuota = $targetPenerimaan > 0 ? ($totalLolos / $targetPenerimaan) * 100 : 0;

        // Pendapatan Real (Hanya yang status_pembayaran = 'lunas')
        $regFee = \App\Models\SystemSetting::where('key', 'reg_fee')->value('value') ?? 150000;
        $pendapatan = Pendaftar::where('status_pembayaran', 'lunas')->count() * $regFee;

        $recentPendaftar = Pendaftar::latest()->take(5)->get();

        $prodiStats = Pendaftar::selectRaw('SUBSTRING_INDEX(pilihan_prodi, ",", 1) as main_prodi, count(*) as count')
            ->groupBy('main_prodi')
            ->orderByDesc('count')
            ->take(5)
            ->get();

        // Map main_prodi back to pilihan_prodi for view compatibility
        $prodiStats->map(function ($item) {
            $item->pilihan_prodi = $item->main_prodi;
            return $item;
        });

        // Daily Stats for Chart (Last 30 days) - Extended from 7 to see more data
        $dailyStats = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $count = Pendaftar::whereDate('created_at', $date)->count();
            $simpleDay = now()->subDays($i)->format('d M');

            $dailyStats[] = [
                'day' => $simpleDay,
                'count' => $count,
                'date' => $date
            ];
        }

        // Weekly Stats for Chart (Last 6 weeks)
        $weeklyStats = [];
        $weeklyLabels = [];
        for ($i = 5; $i >= 0; $i--) {
            $start = now()->subWeeks($i)->startOfWeek();
            $end = now()->subWeeks($i)->endOfWeek();
            $count = Pendaftar::whereBetween('created_at', [$start, $end])->count();
            $weeklyStats[] = $count;
            $weeklyLabels[] = $start->format('d M');
        }

        // Fetch Gelombang with pendaftar counts
        $gelombangs = \App\Models\Gelombang::withCount('pendaftar')->get();

        return view('pimpinan.dashboard', compact(
            'totalPendaftar',
            'totalLolos',
            'recentPendaftar',
            'prodiStats',
            'persentaseKuota',
            'pendapatan',
            'dailyStats',
            'weeklyStats',
            'weeklyLabels',
            'gelombangs'
        ));
    }

    public function analitik()
    {
        $totalPendaftar = Pendaftar::count();

        // Target penerimaan
        $targetPenerimaan = \App\Models\SystemSetting::where('key', 'target_kuota')->value('value') ?? 3500;
        $persentaseKuota = $targetPenerimaan > 0 ? ($totalPendaftar / $targetPenerimaan) * 100 : 0;

        // Data Breakdown Jalur Masuk (Simulasi untuk saat ini, idealnya ada kolom 'jalur_masuk' di tabel)
        $jalurPrestasi = Pendaftar::where('nilai_rata_rata', '>', 90)->count();
        $jalurBeasiswa = Pendaftar::whereBetween('nilai_rata_rata', [85, 90])->count();
        $jalurMandiri = $totalPendaftar - $jalurPrestasi - $jalurBeasiswa;

        $jalurStats = [
            'Mandiri' => $jalurMandiri,
            'Beasiswa' => $jalurBeasiswa,
            'Prestasi' => $jalurPrestasi
        ];

        // Fetch all prodi counts (Jurusan) - Group by first choice
        $prodiCounts = Pendaftar::selectRaw('SUBSTRING_INDEX(pilihan_prodi, ",", 1) as main_prodi, count(*) as count')
            ->groupBy('main_prodi')
            ->pluck('count', 'main_prodi');

        // Format for view (Jurusan)
        $jurusanStats = [];
        foreach ($prodiCounts as $key => $val) {
            if (empty($key) || $key == '-')
                continue;
            $jurusanStats[] = ['name' => $key, 'count' => $val];
        }

        usort($jurusanStats, fn($a, $b) => $b['count'] <=> $a['count']);

        // Prepare Weekly Stats for Chart (last 6 weeks)
        $weeklyStats = [];
        $weeklyLabels = [];

        for ($i = 5; $i >= 0; $i--) {
            $startParams = now()->subWeeks($i)->startOfWeek();
            $endParams = now()->subWeeks($i)->endOfWeek();

            $count = Pendaftar::whereBetween('created_at', [$startParams, $endParams])->count();
            $weeklyStats[] = $count;
            $weeklyLabels[] = $startParams->format('d M') . ' - ' . $endParams->format('d M');
        }

        // Fetch Real Gelombang Data
        $gelombangs = \App\Models\Gelombang::all();

        return view('pimpinan.analitik', compact('totalPendaftar', 'jurusanStats', 'jalurStats', 'weeklyStats', 'weeklyLabels', 'gelombangs'));
    }

    public function laporan()
    {
        return view('pimpinan.laporan');
    }

    public function exportLaporan(Request $request)
    {
        $type = $request->query('type', 'pendaftar');
        $fileName = 'laporan-' . $type . '-' . date('Y-m-d') . '.csv';

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $callback = function () use ($type) {
            $file = fopen('php://output', 'w');

            if ($type == 'statistik') {
                $columns = ['Jurusan', 'Jumlah Pendaftar', 'Persentase'];
                fputcsv($file, $columns);
                $total = Pendaftar::count();
                $stats = Pendaftar::selectRaw('pilihan_prodi, count(*) as count')->groupBy('pilihan_prodi')->get();
                foreach ($stats as $s) {
                    $row['Prodi'] = $s->pilihan_prodi;
                    $row['Jumlah'] = $s->count;
                    $row['Persentase'] = $total > 0 ? round(($s->count / $total) * 100, 2) . '%' : '0%';
                    fputcsv($file, array($row['Prodi'], $row['Jumlah'], $row['Persentase']));
                }
            } elseif ($type == 'keuangan') {
                $columns = ['ID', 'Nama Lengkap', 'Prodi', 'Status Pembayaran', 'Tanggal Daftar'];
                fputcsv($file, $columns);
                $pendaftar = Pendaftar::where('status_pembayaran', '!=', 'belum_bayar')->get();
                foreach ($pendaftar as $p) {
                    $row['ID'] = $p->id;
                    $row['Nama'] = $p->nama_lengkap;
                    $row['Prodi'] = $p->pilihan_prodi;
                    $row['Status Bayar'] = $p->status_pembayaran ?? 'Menunggu Verifikasi';
                    $row['Tanggal'] = $p->created_at;
                    fputcsv($file, array($row['ID'], $row['Nama'], $row['Prodi'], $row['Status Bayar'], $row['Tanggal']));
                }
            } else {
                $columns = ['ID', 'NIK', 'NISN', 'Nama Lengkap', 'Email', 'No HP', 'Asal Sekolah', 'Jurusan Sekolah', 'Tahun Lulus', 'Nilai Rata-rata', 'Prodi', 'Status', 'Tanggal Daftar'];
                fputcsv($file, $columns);
                $pendaftar = Pendaftar::all();
                foreach ($pendaftar as $p) {
                    fputcsv($file, [
                        $p->id,
                        $p->nik,
                        $p->nisn,
                        $p->nama_lengkap,
                        $p->email,
                        $p->no_hp,
                        $p->nama_sekolah,
                        $p->jurusan_sekolah,
                        $p->tahun_lulus,
                        $p->nilai_rata_rata,
                        $p->pilihan_prodi,
                        $p->status,
                        $p->created_at
                    ]);
                }
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function detail($id)
    {
        $pendaftar = Pendaftar::with('dokumen')->findOrFail($id);
        return view('pimpinan.detail-pendaftar', compact('pendaftar'));
    }

    public function approve($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $oldStatus = $pendaftar->status;
        $status = 'Diterima';
        $pendaftar->update(['status' => $status]);

        if ($oldStatus != $status) {
            try {
                \Illuminate\Support\Facades\Mail::to($pendaftar->email)->send(new \App\Mail\StatusPendaftaranEmail($pendaftar, $status));
            } catch (\Exception $e) {
            }
        }

        return back()->with('success', 'Status calon mahasiswa berhasil disetujui (Diterima).');
    }

    public function pengaturan()
    {
        $totalPendaftar = Pendaftar::count();
        $settings = \App\Models\SystemSetting::pluck('value', 'key');
        $kuota = $settings['target_kuota'] ?? 3500;
        $periodeStart = $settings['periode_start'] ?? date('Y-01-01');
        $periodeEnd = $settings['periode_end'] ?? date('Y-05-31');

        // Gelombang aktif
        $gelombangAktif = \App\Models\Gelombang::where('status', 'Aktif')->first();

        return view('pimpinan.pengaturan', compact('totalPendaftar', 'kuota', 'periodeStart', 'periodeEnd', 'gelombangAktif'));
    }

    public function updatePengaturan(Request $request)
    {
        $request->validate([
            'target_kuota' => 'nullable|numeric',
            'periode_start' => 'nullable|date',
            'periode_end' => 'nullable|date|after_or_equal:periode_start'
        ]);

        if ($request->has('target_kuota')) {
            \App\Models\SystemSetting::updateOrCreate(['key' => 'target_kuota'], ['value' => $request->target_kuota]);
        }
        if ($request->has('periode_start')) {
            \App\Models\SystemSetting::updateOrCreate(['key' => 'periode_start'], ['value' => $request->periode_start]);
        }
        if ($request->has('periode_end')) {
            \App\Models\SystemSetting::updateOrCreate(['key' => 'periode_end'], ['value' => $request->periode_end]);
        }

        return back()->with('success', 'Pengaturan sistem berhasil diperbarui.');
    }
}
