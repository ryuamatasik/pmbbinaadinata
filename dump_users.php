<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$results = DB::select("SELECT id, email, role FROM users");

$output = "--- USERS DUMP ---\n";
foreach ($results as $row) {
    $output .= "ID: {$row->id} | EMAIL: {$row->email} | ROLE: {$row->role}\n";
}

file_put_contents('users_dump.txt', $output);
echo "Users dumped to users_dump.txt\n";
