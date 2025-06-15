<?php
session_start();

if (!isset($_SESSION['uploaded_file'])) {
    echo "Tidak ada file yang diupload.";
    exit;
}

$filePath = $_SESSION['uploaded_file'];
?>

<a href="lihat_file.php?file=<?php echo urlencode($filePath); ?>">Lihat File</a>
