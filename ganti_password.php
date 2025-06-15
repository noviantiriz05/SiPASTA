<?php include("inc_header.php") ?>
<div style="max-width: 700px; margin: 0 auto; padding: 20px;">
    <?php
    if (isset($_SESSION['members_email']) != '') {
        header("location:index.php");
        exit();
    }
    ?>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td {
            padding: 10px 5px;
            display: block;
            width: 100%;
        }

        td.label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input {
            border: 1px solid #CCCCCC;
            background-color: #dfdfdf;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        input.tbl-biru {
            border: none;
            background-color: #3f72af;
            border-radius: 20px;
            margin-top: 20px;
            padding: 15px 20px;
            color: #FFFFFF;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
        }

        input.tbl-biru:hover {
            background-color: #fc5185;
            text-decoration: none;
        }

        .error,
        .sukses {
            padding: 20px;
            color: #FFFFFF;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .error {
            background-color: #f44336;
        }

        .sukses {
            background-color: #2196F3;
        }

        .error ul {
            margin-left: 10px;
        }

        /* Responsif untuk layar kecil */
        @media screen and (min-width: 700px) {
            table td {
                display: table-cell;
                width: auto;
            }

            td.label {
                width: 40%;
            }

            input.tbl-biru {
                width: auto;
            }
        }
    </style>
    <h1>Ganti Password</h1>
    <?php
    if (isset($_SESSION['members_email']) != '') {
        header("location:index.php");
        exit();
    }

    $error = "";
    $sukses = "";

    $email = $_GET['email'];
    $token = $_GET['token'];

    if ($token == '' or $email == '') {
        $error .= "Link Tidak Valid. Email dan Token Tidak Tersedia";
    } else {
        $sql1 = "select * from members where email = '$email' and token_ganti_password = '$token'";
        $q1 = mysqli_query($koneksi, $sql1);
        $n1 = mysqli_num_rows($q1);

        if ($n1 < 1) {
            $error .= "Link Tidak Valid. Email dan Token Tidak Sesuai";
        }
    }

    if (isset($_POST['submit'])) {
        $password = $_POST['password'];
        $konfirmasi_password = $_POST['konfirmasi_password'];

        if ($password == '' or $konfirmasi_password == '') {
            $error .= "Silahkan Masukkan Password Serta Konfirmasi Password";
        } elseif ($konfirmasi_password != $password) {
            $error .= "Konfirmasi Password Tidak Sesuai dengan Password";
        } elseif (strlen($password) < 6) {
            $error .= "Jumlah Karakter yang Diperbolehkan untuk Password Minimal 6 Karakter";
        }

        if (empty($error)) {
            $sql1 = "update members set token_ganti_password = '',password=md5($password) where email = '$email'";
            $q1 = mysqli_query($koneksi, $sql1);
            $sukses = "Password Berhasil Diubah. Silahkan <a href='" . url_dasar() . "/login.php'> Login</a>";
        }
    }
    ?>
    <?php if ($error) {
        echo "<div class='error'>$error</div>";
    } ?>
    <?php if ($sukses) {
        echo "<div class='sukses'>$sukses</div>";
    } ?>
    <form action="" method="POST">
        <table>
            <tr>
                <td class="label">Password Baru</td>
                <td><input type="password" name="password" class="input" /></td>
            </tr>
            <tr>
                <td class="label">Konfirmasi Password Baru</td>
                <td><input type="password" name="konfirmasi_password" class="input" /></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" value="Ganti Password" class="tbl-biru" />
                </td>
            </tr>
        </table>
    </form>
</div>
<?php include("inc_footer.php") ?>