$file = "c:/xampp/htdocs/pmbbinaadinata/resources/views/mahasiswa/partials/modal-keluarga.blade.php";
$lines = file($file);
for($i=230; $i<260; $i++) { echo ($i+1) . ": " . $lines[$i]; }