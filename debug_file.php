<?php

$d = \App\Models\DokumenPendaftar::where('jenis_dokumen', 'foto')->latest()->first();

if (!$d) {
    echo "No document found.\n";
    return;
}

echo "ID: " . $d->id . "\n";
echo "Path (DB): " . $d->file_path . "\n";
echo "Updated At: " . $d->updated_at . "\n";

$exists = \Illuminate\Support\Facades\Storage::disk('public')->exists($d->file_path);
echo "Storage::disk('public')->exists: " . ($exists ? 'YES' : 'NO') . "\n";

$url = \Illuminate\Support\Facades\Storage::url($d->file_path);
echo "URL: " . $url . "\n";

$publicPath = public_path('storage/' . $d->file_path);
echo "Public Path: " . $publicPath . "\n";
echo "File Exists (PHP realpath): " . (file_exists($publicPath) ? 'YES' : 'NO') . "\n";

// Also check if public/storage is a link
echo "public/storage is link: " . (is_link(public_path('storage')) ? 'YES' : 'NO') . "\n";
