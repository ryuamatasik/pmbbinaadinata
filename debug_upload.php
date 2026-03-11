<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$syarat = App\Models\SyaratDokumen::all();
echo "SYARAT DOKUMEN:\n";
foreach ($syarat as $s) {
    $field = \Illuminate\Support\Str::slug($s->nama, '_');
    $mimes = strtolower(str_replace(' ', '', $s->format));
    echo "- Name: [{$s->nama}], Slug: [{$field}], Format: [{$s->format}], Mimes Rule: [{$mimes}]\n";
}

echo "\nMIME SETTINGS:\n";
echo "fileinfo extension: " . (extension_loaded('fileinfo') ? 'Loaded' : 'NOT Loaded') . "\n";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "\n";
echo "post_max_size: " . ini_get('post_max_size') . "\n";

$pendaftar = App\Models\Pendaftar::where('email', 'like', '%')->latest()->first(); // Just get latest for context
if ($pendaftar) {
    echo "\nLATEST PENDAFTAR: {$pendaftar->nama_lengkap} (ID: {$pendaftar->id})\n";
    $docs = App\Models\DokumenPendaftar::where('pendaftar_id', $pendaftar->id)->get();
    foreach ($docs as $d) {
        echo "- Doc: [{$d->jenis_dokumen}], Name: [{$d->original_name}], Status: [{$d->status}]\n";
    }
}
