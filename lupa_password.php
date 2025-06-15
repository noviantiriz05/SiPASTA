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
    <h1>Lupa Password</h1>
    <?php
    if (isset($_SESSION['members_email']) != '') {
        header("location:index.php");
        exit();
    }

    $error = "";
    $sukses = "";
    $email = "";

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        if ($email == '') {
            $error = "Silahkan Masukkan Email";
        } else {
            $sql1 = "select * from members where email = '$email'";
            $q1 = mysqli_query($koneksi, $sql1);
            $n1 = mysqli_num_rows($q1);

            if ($n1 < 1) {
                $error = "Email: <b>$email</b> Tidak Ditemukan";
            }
        }

        if (empty($error)) {
            $token_ganti_password = md5(rand(0, 1000));
            $judul_email = "Ganti Password";
            $isi_email = "Seseorang Meminta untuk Melakukan Perubahan Password. Silahkan Klik Link Dibawah Ini:<br/>";
            $isi_email .= url_dasar() . "/ganti_password.php?email=$email&token=$token_ganti_password";
            kirim_email($email, $email, $judul_email, $isi_email);

            $sql1 = "update members set token_ganti_password = '$token_ganti_password' where email = '$email'";
            $q1 = mysqli_query($koneksi, $sql1);
            $sukses = "Link Ganti Password Telah Dikirimkan ke Email Anda";
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
                <td class="label">Email</td>
                <td><input type="text" name="email" class="input" value="<?php echo $email ?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" value="Lupa Password" class="tbl-biru" />
                </td>
            </tr>
        </table>
    </form>
</div>
<?php include("inc_footer.php") ?>