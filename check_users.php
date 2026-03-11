<?php
define('LARAVEL_START', microtime(true));
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();
$kernel->terminate($request, $response);

// Use DB facade directly to be safer
try {
    $users = Illuminate\Support\Facades\DB::table('users')->get(['id', 'email', 'role']);
    echo "--- USERS ---\n";
    foreach ($users as $u) {
        echo "ID: {$u->id} | EMAIL: {$u->email} | ROLE: {$u->role}\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
