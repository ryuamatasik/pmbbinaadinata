<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$pendaftarCount = App\Models\Pendaftar::count();
$gelombangCount = App\Models\Gelombang::count();
$pendaftarTop = App\Models\Pendaftar::select('id', 'pilihan_prodi', 'created_at')->latest()->take(5)->get();

echo "Pendaftar Count: $pendaftarCount\n";
echo "Gelombang Count: $gelombangCount\n";
echo "Top Pendaftar Prodi:\n";
foreach ($pendaftarTop as $p) {
    echo "ID: {$p->id} | PRODI: {$p->pilihan_prodi} | DATE: {$p->created_at}\n";
}

$prodiStats = App\Models\Pendaftar::selectRaw('pilihan_prodi, count(*) as count')
    ->groupBy('pilihan_prodi')
    ->get();

echo "Prodi Stats Raw:\n";
foreach ($prodiStats as $s) {
    echo "PRODI: '{$s->pilihan_prodi}' | COUNT: {$s->count}\n";
}
