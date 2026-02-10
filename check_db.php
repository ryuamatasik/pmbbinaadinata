<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Checking Pendaftar Records...\n";
$latest = \App\Models\Pendaftar::latest()->take(5)->get();
foreach ($latest as $p) {
    echo "ID: " . $p->id . " | UserID: " . ($p->user_id ?? 'NULL') . " | Name: " . $p->nama_lengkap . "\n";
}

echo "\nChecking Users...\n";
$users = \App\Models\User::latest()->take(5)->get();
foreach ($users as $u) {
    echo "ID: " . $u->id . " | Name: " . $u->name . " | Email: " . $u->email . "\n";
}
