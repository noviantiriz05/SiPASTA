<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "sipasta";

$koneksi = mysqli_connect($host, $user, $pass, $db);

// Tambahkan pemeriksaan koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>