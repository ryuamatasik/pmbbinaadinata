<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$syarat = App\Models\SyaratDokumen::all();
$out = "ID | Nama | Wajib | Format | Max Size\n";
$out .= str_repeat("-", 50) . "\n";
foreach ($syarat as $s) {
    $out .= "{$s->id} | {$s->nama} | {$s->wajib} | {$s->format} | {$s->max_size}\n";
}
file_put_contents('syarat_check.txt', $out);
echo "Dumped to syarat_check.txt\n";
