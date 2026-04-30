<?php
$c = mysqli_connect('127.0.0.1', 'root', '');
if (!$c) {
    die("Connection failed: " . mysqli_connect_error());
}
$res = mysqli_query($c, 'SHOW DATABASES');
while($row = mysqli_fetch_assoc($res)) {
    echo $row['Database'] . PHP_EOL;
}
