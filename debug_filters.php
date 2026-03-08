<?php

use App\Models\Pendaftar;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$data = Pendaftar::query()
    ->select('id', 'nama_lengkap', 'pilihan_prodi', 'status', 'nomor_pendaftaran')
    ->get();

header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT);
