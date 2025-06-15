<?php include_once("inc_header.php") ?>
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
    <h3>Buat Akun</h3>
    <?php
    $email = "";
    $nama_lengkap = "";
    $error = "";
    $sukses = "";

    if (isset($_POST['simpan'])) {
        $email = $_POST['email'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $password = $_POST['password'];
        $konfirmasi_password = $_POST['konfirmasi_password'];

        if ($email == '' or $nama_lengkap == '' or $konfirmasi_password == '' or $password == '') {
            $error .= "<li>Silahkan Masukkan Semua Data</li>";
        }

        //cek di bagian db, apakah email sudah ada atau belum
        if ($email != '') {
            $sql1 = "select email from members where email = '$email'";
            $q1 = mysqli_query($koneksi, $sql1);
            $n1 = mysqli_num_rows($q1);
            if ($n1 > 0) {
                $error .= "<li>Email Sudah Terdaftar</li>";
            }

            //validasi email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error .= "<li>Email Tidak Valid</li>";
            }
        }

        //cek kesesuaian password & konfirmasi password
        if ($password != $konfirmasi_password) {
            $error .= "<li>Password dan Konformasi Password Tidak Sesuai</li>";
        }

        if (strlen($password) < 6) {
            $error .= "<li>Panjang Karakter Password yang Diizinkan Paling Tidak 6 Karakter</li>";
        }

        if (empty($error)) {
            $status = md5(rand(0, 1000));
            $judul_email = "Halaman Konfirmasi Pendaftaran";
            $isi_email = "Akun yang Anda Miliki dengan Email <b>$email</b> Telah Siap Digunakan. ";
            $isi_email .= "Sebelumnya Silahkan Melakukan Aktifasi Email di Link di Bawah ini:<br/>";
            $isi_email .= url_dasar() . "/verifikasi.php?email=$email&kode=$status";

            kirim_email($email, $nama_lengkap, $judul_email, $isi_email);

            $password_hash = md5($password);
            $sql1 = "insert into members(email,nama_lengkap,password,status) values('$email','$nama_lengkap','$password_hash','$status')";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Proses Berhasil. Silahkan Cek Email Anda untuk Verifikasi";
            }
        }
    }
    ?>
    <?php if ($error) {
        echo "<div class='error'><ul>$error</ul></div>";
    } ?>
    <?php if ($sukses) {
        echo "<div class='sukses'>$sukses</div>";
    } ?>
    <form action="" method="POST">
        <table>
            <tr>
                <td class="label">Email</td>
                <td>
                    <input type="text" name="email" class="input" value="<?php echo $email ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">Nama Lengkap</td>
                <td>
                    <input type="text" name="nama_lengkap" class="input" value="<?php echo $nama_lengkap ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">Password</td>
                <td>
                    <input type="password" name="password" class="input" />
                </td>
            </tr>
            <tr>
                <td class="label">Konfirmasi Password</td>
                <td>
                    <input type="password" name="konfirmasi_password" class="input" />
                    <br />
                    Sudah Punya Akun? Silahkan <a href='<?php echo url_dasar() ?>/login.php'> Login </a>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="simpan" value="simpan" class="tbl-biru" />
                </td>
            </tr>
        </table>
    </form>
</div>

<?php include_once("inc_footer.php") ?>