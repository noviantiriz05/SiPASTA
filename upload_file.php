<?php
session_start();
include_once("inc/inc_koneksi.php");

$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

if (isset($_FILES['isi'])) {
    $file = $_FILES['isi'];
    $allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx'];
    $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "File tidak diizinkan."; exit;
    }

    $newFileName = uniqid() . "_" . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file['name']);
    $targetFile = $uploadDir . $newFileName;

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        $perihal = mysqli_real_escape_string($koneksi, $_POST['perihal'] ?? '');
        $pengirim = mysqli_real_escape_string($koneksi, $_POST['pengirim'] ?? '');
        $penerima = mysqli_real_escape_string($koneksi, $_POST['penerima'] ?? '');
        $jsurat = mysqli_real_escape_string($koneksi, $_POST['jsurat'] ?? '');
        $isi = $newFileName;
        $tgl_isi = date('Y-m-d');

        // Cek jenis surat dari parameter
        $jenis = $_GET['jenis'] ?? 'masuk';

        if ($jenis == 'masuk') {
            $sql = "INSERT INTO surat_masuk (perihal, pengirim, penerima, jsurat, isi, tgl_isi)
                    VALUES ('$perihal', '$pengirim', '$penerima', '$jsurat', '$isi', '$tgl_isi')";
        } else if ($jenis == 'keluar') {
            $sql = "INSERT INTO surat_keluar (perihal, pengirim, penerima, jsurat, isi, tgl_isi)
                    VALUES ('$perihal', '$pengirim', '$penerima', '$jsurat', '$isi', '$tgl_isi')";
        } else {
            echo "Jenis surat tidak dikenal.";
            exit;
        }

        $q = mysqli_query($koneksi, $sql);
        if ($q) {
            $_SESSION['sukses'] = "Upload berhasil!";
            header("Location: surat_{$jenis}.php");
            exit;
        } else {
            echo "Gagal simpan ke DB: " . mysqli_error($koneksi);
        }
    } else {
        echo "Gagal memindahkan file.";
    }
} else {
    echo "Tidak ada file diupload.";
}
?>