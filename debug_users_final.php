<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

try {
    $users = \App\Models\User::all(['id', 'email', 'role', 'name']);
    echo "COUNT: " . count($users) . "\n";
    foreach ($users as $user) {
        echo "ID: {$user->id} | EMAIL: {$user->email} | ROLE: {$user->role} | NAME: {$user->name}\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
