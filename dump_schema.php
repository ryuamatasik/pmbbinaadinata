<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$table = 'pendaftar';
$results = DB::select("DESCRIBE $table");

$output = "";
foreach ($results as $row) {
    $output .= "{$row->Field} | {$row->Type} | {$row->Null} | {$row->Key} | {$row->Default} | {$row->Extra}\n";
}

file_put_contents('schema_dump.txt', $output);
echo "Schema dumped to schema_dump.txt\n";
