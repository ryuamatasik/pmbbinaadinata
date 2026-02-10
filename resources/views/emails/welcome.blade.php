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

        .message-text {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #475569;
        }

        .steps-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 25px;
            margin: 0 auto 30px auto;
            text-align: left;
            max-width: 450px;
        }

        .step-item {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }

        .step-item:last-child {
            margin-bottom: 0;
        }

        .step-icon {
            background-color: #e2e8f0;
            color: #334155;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .step-text {
            font-size: 15px;
            color: #334155;
            line-height: 1.5;
            padding-top: 6px;
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
                <h1>Selamat Datang!</h1>
            </div>

            <!-- Content -->
            <div class="content">
                <div class="greeting">
                    Halo, {{ $pendaftar->nama_lengkap }} 👋
                </div>

                <div class="message-text">
                    Terima kasih telah bergabung dengan <strong>Iteb Bina Adinata</strong>.
                    <br>Akun pendaftaran Anda berhasil dibuat.
                </div>

                <div class="steps-box">
                    <p
                        style="margin: 0 0 15px 0; font-weight: 700; color: #1e293b; text-transform: uppercase; font-size: 12px; letter-spacing: 1px;">
                        Langkah Selanjutnya:</p>

                    <div class="step-item">
                        <div class="step-icon">🔐</div>
                        <div class="step-text">Login ke Portal PMB dengan email & password Anda.</div>
                    </div>
                    <div class="step-item">
                        <div class="step-icon">📝</div>
                        <div class="step-text">Lengkapi <strong>Formulir Pendaftaran</strong> (Data Diri, Sekolah,
                            Ortu).</div>
                    </div>
                    <div class="step-item">
                        <div class="step-icon">📤</div>
                        <div class="step-text">Unggah <strong>Berkas Persyaratan</strong> & Bukti Pembayaran.</div>
                    </div>
                    <div class="step-item">
                        <div class="step-icon">⏳</div>
                        <div class="step-text">Pantau status verifikasi dan pengumuman panitia.</div>
                    </div>
                </div>

                <div class="message-text" style="font-size: 14px; margin-top: 10px; color: #64748b;">
                    Simpan email ini data login Anda.<br>
                    <strong>Email:</strong> {{ $pendaftar->email }}
                </div>

                <div style="margin-top: 30px;">
                    <a href="{{ route('login') }}" class="btn">Login & Lengkapi Formulir</a>
                </div>
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