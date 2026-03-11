<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$columns = DB::select('DESCRIBE gelombangs');
foreach ($columns as $c) {
    echo $c->Field . "\n";
}
