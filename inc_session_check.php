<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah user sudah login
if (!isset($_SESSION['members_email'])) {
    // Jika tidak ada session login, redirect ke halaman login
    header("Location: login.php");
    exit();
}
?>