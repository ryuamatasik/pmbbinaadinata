<?php
$dbs = ['pendaftaran', 'pmbmahasiswa'];
foreach ($dbs as $db) {
    echo "--- Checking DB: $db ---\n";
    $c = mysqli_connect('127.0.0.1', 'root', '', $db);
    if ($c) {
        $res = mysqli_query($c, 'SHOW TABLES');
        while($row = mysqli_fetch_row($res)) {
            echo "Table: " . $row[0] . PHP_EOL;
        }
    } else {
        echo "Could not connect to $db\n";
    }
}
