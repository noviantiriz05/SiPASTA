<?php
session_start();

if (!isset($_SESSION['members_email'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['file'])) {
    echo "Parameter file tidak ditemukan.";
    exit();
}

// HANYA ambil nama file (hindari path traversal)
$filename = basename($_GET['file']);
$uploadDir = __DIR__ . '/uploads/';
$filePath = $uploadDir . $filename;

if (!file_exists($filePath)) {
    http_response_code(404);
    echo "File tidak ditemukan atau akses tidak valid.";
    exit();
}

$mimeType = mime_content_type($filePath);
header("Content-Type: $mimeType");
header('Content-Disposition: inline; filename="' . $filename . '"');
readfile($filePath);
exit();
?>