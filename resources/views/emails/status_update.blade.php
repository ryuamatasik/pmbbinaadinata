<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        /* Base Reset */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            outline: none;
            text-decoration: none;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f6f6f8;
            margin: 0;
            padding: 0;
            width: 100% !important;
        }

        .wrapper {
            width: 100%;
            background-color: #f6f6f8;
            padding: 40px 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .header {
            background-color: #ffffff;
            padding: 30px 20px 10px 20px;
            text-align: center;
            border-bottom: 4px solid #135bec;
        }

        .logo-img {
            width: 80px;
            height: auto;
            margin-bottom: 15px;
        }

        .header h1 {
            color: #135bec;
            font-size: 22px;
            margin: 0;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .content {
            padding: 40px 30px;
            color: #334155;
            text-align: center;
        }

        .greeting {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #1e293b;
        }

        .status-box {
            text-align: center;
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 30px 25px;
            margin: 25px 0;
            border: 1px dashed #cbd5e1;
            /* Border dashed for clean look */
        }

        .status-badge {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 16px;
            color: white;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .bg-green {
            background-color: #10b981;
        }

        .bg-red {
            background-color: #ef4444;
        }

        .bg-blue {
            background-color: #3b82f6;
        }

        .bg-amber {
            background-color: #f59e0b;
        }

        .message-text {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 15px;
            text-align: center;
            color: #475569;
        }

        .note-box {
            background-color: #fff7ed;
            border-left: 4px solid #f59e0b;
            padding: 20px;
            margin-top: 25px;
            border-radius: 4px;
            font-size: 15px;
            color: #7c2d12;
            text-align: left;
        }

        .btn {
            display: inline-block;
            background-color: #135bec;
            color: #ffffff;
            padding: 16px 32px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s;
            box-shadow: 0 4px 10px rgba(19, 91, 236, 0.25);
        }

        .btn:hover {
            background-color: #0e45b5;
        }

        .footer {
            background-color: #f1f5f9;
            padding: 25px;
            text-align: center;
            color: #64748b;
            font-size: 12px;
            border-top: 1px solid #e2e8f0;
        }

        /* Mobile */
        @media only screen and (max-width: 620px) {
            .container {
                width: 100%;
                border-radius: 0;
            }

            .content {
                padding: 30px 20px;
            }

            .btn {
                width: 100%;
                box-sizing: border-box;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <!-- Header (Logo Removed) -->
            <div class="header">
                <h1>Iteb Bina Adinata</h1>
            </div>

            <!-- Content -->
            <div class="content">
                <div class="greeting">
                    Halo, {{ $pendaftar->nama_lengkap }} 👋
                </div>

                <div class="status-box">
                    <p
                        style="margin-bottom: 20px; font-weight: 500; color: #64748b; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">
                        Status Pendaftaran Anda:</p>

                    @if ($statusCheck == 'Diterima')
                        <div class="status-badge bg-green">DITERIMA</div>
                        <div class="message-text">
                            <strong>Selamat!</strong> Anda telah dinyatakan lulus seleksi masuk.
                            <br>Kami menunggu kehadiran Anda sebagai mahasiswa baru.
                        </div>
                    @elseif($statusCheck == 'Ditolak')
                        <div class="status-badge bg-red">TIDAK DITERIMA</div>
                        <div class="message-text">
                            Mohon maaf, Anda belum lolos pada seleksi tahap ini.
                            <br>Tetap semangat dan coba lagi di kesempatan berikutnya.
                        </div>
                    @elseif($statusCheck == 'Verifikasi')
                        <div class="status-badge bg-amber">SEDANG DIVERIFIKASI</div>
                        <div class="message-text">
                            Berkas Anda sedang dalam proses pemeriksaan oleh tim seleksi.
                            <br>Mohon tunggu update selanjutnya dalam 1-2 hari kerja.
                        </div>
                    @else
                        <div class="status-badge bg-blue">{{ strtoupper($statusCheck) }}</div>
                    @endif
                </div>

                @if ($catatan)
                    <div class="note-box">
                        <strong style="display: block; margin-bottom: 5px;">📝 Catatan Panitia:</strong>
                        "{{ $catatan }}"
                    </div>
                @endif

                <div style="margin-top: 35px;">
                    <a href="{{ route('login') }}" class="btn">Login ke Portal PMB</a>
                </div>

                <p style="text-align: center; margin-top: 30px; font-size: 13px; color: #94a3b8;">
                    Jika ada pertanyaan, silakan hubungi bagian administrasi kami.
                </p>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p style="margin: 0 0 10px 0;">&copy; {{ date('Y') }} Institut Teknologi & Bisnis Bina Adinata.</p>
                <p style="margin: 0;">Jalan Kampus Utama No. 123, Kota Pendidikan</p>
                <p style="margin-top: 15px; font-size: 11px; color: #94a3b8;">Email ini dikirim secara otomatis oleh
                    sistem.</p>
            </div>
        </div>
    </div>
</body>

</html>