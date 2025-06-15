<?php
session_start();
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiPASTA</title>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <link href="../css/summernote-image-list.min.css">
    <script src="../js/summernote-image-list.min.js"></script>

    <link rel="stylesheet" href="<?php echo url_dasar() ?>/css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .image-list-content .col-lg-3 {
            width: 100%;
        }

        .image-list-content img {
            float: left;
            width: 20%;
        }

        .image-list-content p {
            float: left;
            padding-left: 20px;
        }

        .image-list-item {
            padding: 10px 0px 10px 0px;
        }
    </style>
</head>

<body>
    <nav>
        <div class="wrapper">
            <div class="logo"><a href='<?php echo url_dasar() ?>'>SiPASTA</a></div>
            <div class="menu">
                <ul>
                    <li><a href="<?php echo url_dasar() ?>#home">Home</a></li>
                    <li><a href="<?php echo url_dasar() ?>#surat_masuk">Surat Masuk</a></li>
                    <li><a href="<?php echo url_dasar() ?>#surat_keluar">Surat Keluar</a></li>
                    <li><a href="<?php echo url_dasar() ?>#arsip_surat">Arsip Surat</a></li>
                    <li><a href="<?php echo url_dasar() ?>#contact">Contact</a></li>
                    <li>
                        <?php if (isset($_SESSION['members_nama_lengkap'])) {
                            echo "<a href='" . url_dasar() . "/ganti_profile.php'>" . $_SESSION['members_nama_lengkap'] . "</a> | <a href='" . url_dasar() . "/logout.php'>Logout</a>";
                        } else { ?>
                            <a href="pendaftaran.php" class="tbl-biru">Sign Up</a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper"></div>