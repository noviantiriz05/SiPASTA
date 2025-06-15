<?php
include "inc/koneksi.php";         // Jika ingin menyimpan ke database

$target_dir = "uploads/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if (isset($_FILES["file"])) {
    $fileName = basename($_FILES["file"]["name"]);
    $target_file = $target_dir . $fileName;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed = ["pdf", "doc", "docx", "xls", "xlsx"];

    if (in_array($fileType, $allowed)) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo $target_file; // URL akan dikembalikan ke Summernote
        } else {
            http_response_code(500);
            echo "Gagal upload.";
        }
    } else {
        http_response_code(400);
        echo "Tipe file tidak diizinkan.";
    }
}
?>
