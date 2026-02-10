<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Tanda Mahasiswa Sementara - {{ $pendaftar->nama_lengkap }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }

            .no-print {
                display: none !important;
            }

            .page-break {
                page-break-after: always;
            }
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 8rem;
            color: rgba(0, 0, 0, 0.05);
            font-weight: bold;
            pointer-events: none;
            z-index: 0;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen p-8 flex flex-col items-center justify-center">

    <!-- Card Container -->
    <div
        class="bg-white w-full max-w-[21cm] shadow-xl p-8 rounded-xl relative overflow-hidden print:shadow-none print:w-full print:max-w-none print:p-0 print:rounded-none">

        <div class="watermark">RESMI</div>

        <!-- Header -->
        <div class="border-b-4 border-blue-600 pb-6 mb-8 flex items-center justify-between relative z-10">
            <div class="flex items-center gap-4">
                <div
                    class="size-16 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-2xl">
                    UM
                </div>
                <div>
                    <h1 class="text-2xl font-black text-gray-900 tracking-tight uppercase">Universitas Merdeka</h1>
                    <p class="text-sm text-gray-500 font-medium">Jalan Terusan Dieng No. 62-64, Malang</p>
                    <p class="text-xs text-gray-400">Website: www.unmer.ac.id | Email: pmb@unmer.ac.id</p>
                </div>
            </div>
            <div class="text-right">
                <h2 class="text-xl font-bold text-blue-600">KARTU TANDA MAHASISWA</h2>
                <p class="text-sm font-semibold bg-green-100 text-green-700 px-3 py-1 rounded inline-block mt-1">
                    SEMENTARA</p>
            </div>
        </div>

        <!-- Content -->
        <div class="grid grid-cols-3 gap-8 relative z-10">
            <!-- Photo Section -->
            <div class="col-span-1">
                <div
                    class="aspect-[3/4] bg-gray-100 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden">
                    @php
                        $foto = \App\Models\DokumenPendaftar::where('pendaftar_id', $pendaftar->id)
                            ->where('jenis_dokumen', 'foto')
                            ->first();
                        $fotoUrl = $foto ? \Illuminate\Support\Facades\Storage::url($foto->file_path) : null;
                    @endphp

                    @if($fotoUrl)
                        <img src="{{ $fotoUrl }}" alt="Foto Peserta" class="w-full h-full object-cover">
                    @else
                        <span class="text-gray-400 text-sm font-medium">Foto 3x4</span>
                    @endif
                </div>
                <div class="mt-4 text-center">
                    <p class="text-xs text-gray-500 mb-1">Tanda Tangan Mahasiswa</p>
                    <div class="h-16 border-b border-gray-300"></div>
                </div>
            </div>

            <!-- Details Section -->
            <div class="col-span-2">
                <table class="w-full">
                    <tbody class="text-sm">
                        <tr class="border-b border-gray-100">
                            <td class="py-3 w-40 font-semibold text-gray-500">Nomor Pendaftaran</td>
                            <td class="py-3 font-bold text-gray-900">{{ $pendaftar->nomor_pendaftaran }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-3 w-40 font-semibold text-gray-500">Nama Lengkap</td>
                            <td class="py-3 font-bold text-gray-900 uppercase">{{ $pendaftar->nama_lengkap }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-3 w-40 font-semibold text-gray-500">Program Studi</td>
                            <td class="py-3 text-gray-900">{{ $pendaftar->pilihan_prodi }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-3 w-40 font-semibold text-gray-500">Jalur / Gelombang</td>
                            <td class="py-3 text-gray-900">Jalur Mandiri / Gelombang {{ $pendaftar->gelombang }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-3 w-40 font-semibold text-gray-500">Status</td>
                            <td class="py-3 font-bold text-green-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                DITERIMA
                            </td>
                        </tr>
                        <tr>
                            <td class="py-3 w-40 font-semibold text-gray-500">Tanggal Daftar</td>
                            <td class="py-3 text-gray-900">{{ $pendaftar->created_at->format('d F Y') }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-8 bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <p class="text-xs text-blue-800 font-medium mb-1">Catatan Penting:</p>
                    <ul class="text-[10px] text-blue-600 list-disc list-inside space-y-1">
                        <li>Kartu ini adalah bukti sah bahwa Anda telah <strong>DITERIMA</strong> sebagai mahasiswa
                            baru.</li>
                        <li>Harap simpan kartu ini untuk keperluan her-registrasi dan pengambilan KTM asli.</li>
                        <li>Segera lakukan registrasi ulang sesuai jadwal yang ditentukan.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-8 pt-6 border-t border-gray-200 flex items-end justify-between relative z-10">
            <div>
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ $pendaftar->nomor_pendaftaran }}"
                    alt="QR Code" class="size-16">
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-500">Dicetak pada: {{ date('d F Y H:i') }}</p>
                <p class="text-sm font-bold text-gray-900 mt-1">Panitia Penerimaan Mahasiswa Baru</p>
            </div>
        </div>

    </div>

    <!-- Print Controls -->
    <div class="fixed bottom-8 box-border p-4 bg-white shadow-2xl rounded-full flex gap-4 no-print print:hidden z-50">
        <button onclick="window.print()"
            class="bg-blue-600 text-white px-6 py-2 rounded-full font-bold hover:bg-blue-700 transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                </path>
            </svg>
            Cetak Kartu
        </button>
        <button onclick="window.close()"
            class="bg-gray-100 text-gray-600 px-6 py-2 rounded-full font-bold hover:bg-gray-200 transition-colors">
            Tutup
        </button>
    </div>

</body>

</html>