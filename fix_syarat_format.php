<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$syarat = App\Models\SyaratDokumen::all();
echo "SANITIZING SYARAT DOKUMEN FORMATS:\n";
foreach ($syarat as $s) {
    $oldFormat = $s->format;
    // Remove dots, remove spaces, lowercase, then ensure standard comma separation
    $newFormat = str_replace([' ', '.'], '', $oldFormat);
    $newFormat = strtolower($newFormat);

    // If it was "PDF/JPG", make it "pdf,jpg"
    $newFormat = str_replace('/', ',', $newFormat);

    if ($oldFormat !== $newFormat) {
        $s->update(['format' => $newFormat]);
        echo "- ID: {$s->id} [{$s->nama}]: '{$oldFormat}' -> '{$newFormat}' (UPDATED)\n";
    } else {
        echo "- ID: {$s->id} [{$s->nama}]: '{$oldFormat}' (OK)\n";
    }
}
echo "\nDone!\n";
