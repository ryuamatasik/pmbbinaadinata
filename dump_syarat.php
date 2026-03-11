<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$syarat = App\Models\SyaratDokumen::all();
$out = "";
foreach ($syarat as $s) {
    $out .= "ID: {$s->id}, Name: [{$s->nama}], Format: [{$s->format}]\n";
}
file_put_contents('syarat_dump.txt', $out);
echo "Done\n";
