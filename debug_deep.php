<?php

echo "=== DEEP DEBUG START ===\n";

// 1. Check DB Record
$d = \App\Models\DokumenPendaftar::where('jenis_dokumen', 'foto')->latest()->first();
if (!$d) {
    die("No record found.\n");
}

echo "[DB] ID: {$d->id}\n";
echo "[DB] File Path: {$d->file_path}\n";

// 2. Check Storage Config
echo "[Config] Filesystem Driver: " . config('filesystems.default') . "\n";
echo "[Config] Public Disk Root: " . config('filesystems.disks.public.root') . "\n";
echo "[Config] Public Disk URL: " . config('filesystems.disks.public.url') . "\n";

// 3. Generate URL
$url = \Illuminate\Support\Facades\Storage::url($d->file_path);
echo "[URL] Generated: {$url}\n";

// 4. Physical File Check (Storage)
$storagePath = storage_path('app/public/' . $d->file_path);
echo "[File] Expected Storage Path: {$storagePath}\n";
echo "[File] Exists in Storage? " . (file_exists($storagePath) ? "YES" : "NO") . "\n";

if (!file_exists($storagePath)) {
    echo "  -> SEARCHING for file name in storage/app...\n";
    $filename = basename($d->file_path);
    $found = glob(storage_path("app/public/uploads/{$filename}"));
    if ($found) {
        echo "  -> FOUND at: " . $found[0] . "\n";
    } else {
        echo "  -> NOT FOUND anywhere obvious.\n";
    }
}

// 5. Physical File Check (Public Symlink)
$publicSymlinkPath = public_path('storage/' . $d->file_path);
echo "[Symlink] Access via Public: {$publicSymlinkPath}\n";
echo "[Symlink] Exists via Public? " . (file_exists($publicSymlinkPath) ? "YES" : "NO") . "\n";

// 6. Test File
$testFile = public_path('test_check.txt');
file_put_contents($testFile, 'Test Public Access');
echo "[Test] Created public/test_check.txt\n";

// 7. Symlink Check
echo "[Sys] public/storage is link? " . (is_link(public_path('storage')) ? "YES" : "NO") . "\n";
if (is_link(public_path('storage'))) {
    echo "[Sys] Link Target: " . readlink(public_path('storage')) . "\n";
}

// 8. Copy to verify corruption
if (file_exists($storagePath)) {
    $copyDest = public_path('debug_image.jpg');
    copy($storagePath, $copyDest);
    echo "[Action] Copied image to public/debug_image.jpg for direct access test.\n";
}

echo "=== DEEP DEBUG END ===\n";
