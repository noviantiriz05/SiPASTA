<?php include_once("inc_header.php") ?>
<div style="max-width: 700px; margin: 0 auto; padding: 20px;">
    <?php
    if (isset($_SESSION['members_email']) == '') {
        header("location:login.php");
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
    <h3>Ganti Profile Akun</h3>
    <?php
    $email = "";
    $nama_lengkap = "";
    $error = "";
    $sukses = "";

    if (isset($_POST['simpan'])) {
        $nama_lengkap           = $_POST['nama_lengkap'];
        $password_lama          = $_POST['password_lama'];
        $password               = $_POST['password'];
        $konfirmasi_password    = $_POST['konfirmasi_password'];

        if($nama_lengkap == ''){
            $error              .= "<li>Silahkan Masukkan Nama Lengkap</li>";
        }

        if($password != ''){ //jika akan melakukan perubahan password
            $sql1               = "select * from members where email = '".$_SESSION['members_email']."'";
            $q1                 = mysqli_query($koneksi, $sql1);
            $r1                 = mysqli_fetch_array($q1);
            if(md5($password_lama) != $r1['password']){
                $error          .= "<li>Password yang Anda Masukkan Tidak Sesuai dengan Password Sebelumnya</li>";
            }

            if($password_lama == '' or $konfirmasi_password == '' or $password == ''){
                $error          .= "<li>Silahkan Masukkan Password Lama, Password Baru, Serta Konfirmasi Password</li>";
            }

            if($password != $konfirmasi_password){
                $error          .= "<li>Silahkan Masukkan Password dan Konfirmasi Password yang Sama</li>";
            }

            if(strlen($password) < 6){
                $error          .= "<li>Panjang Karakter yang Diizinkan untuk Password Adalah Minimal 6 Karakter</li>";
            }
        }

        if(empty($error)){
            $sql1               = "update members set nama_lengkap = '".$nama_lengkap."' where email = '".$_SESSION['members_email']."'";
            $q1                 = mysqli_query($koneksi,$sql1);
            $_SESSION['members_nama_lengkap'] = $nama_lengkap;

            if($password){
                $sql2           = "update members set password = md5('$password') where email = '".$_SESSION['members_email']."'";
                $q2             = mysqli_query($koneksi, $sql2);
            }

            $sukses     = "Data Berhasil Diubah";
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
                    <?php echo $_SESSION['members_email']?>
                </td>
            </tr>
            <tr>
                <td class="label">Nama Lengkap</td>
                <td>
                    <input type="text" name="nama_lengkap" class="input" value="<?php echo $_SESSION['members_nama_lengkap'] ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">Password Lama</td>
                <td>
                    <input type="password" name="password_lama" class="input" />
                </td>
            </tr>
            <tr>
                <td class="label">Password Baru</td>
                <td>
                    <input type="password" name="password" class="input" />
                </td>
            </tr>
            <tr>
                <td class="label">Konfirmasi Password Baru</td>
                <td>
                    <input type="password" name="konfirmasi_password" class="input" />
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