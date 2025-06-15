<?php include("inc_header.php") ?>
<?php include_once("inc/inc_koneksi.php"); ?>
<?php
$email = "";
$password = "";
$error = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == '' or $password == '') {
        $error .= "<li>Silahkan Masukkan Semua Data</li>";
    } else {
        $sql1 = "select * from members where email ='$email'";
        $q1 = mysqli_query($koneksi, $sql1);
        $r1 = mysqli_fetch_array($q1);
        $n1 = mysqli_num_rows($q1);

        if ($r1['status'] != '1' && $n1 > 0) {
            $error .= "<li>Akun yang Anda Miliki Belum Aktif</li>";
        }

        if ($r1['password'] != md5($password) && $n1 > 0 && $r1['status'] == '1') {
            $error .= "<li>Password Tidak Sesuai</li>";
        }

        if ($n1 < 1) {
            $error .= "<li>Akun Tidak Ditemukan</li>";
        }

        if (empty($error)) {
            $_SESSION['members_email'] = $email;
            $_SESSION['members_nama_lengkap'] = $r1['nama_lengkap'];
            $_SESSION['success_message'] = "Selamat Datang " . $r1['nama_lengkap'] . "! Anda Telah Berhasil Login.";
            header("location:index.php");
            exit();
        }
    }
}
?>
<div style="max-width: 700px; margin: 0 auto; padding: 20px;">
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
    <h3>Login Ke Halaman Members</h3>
    <?php if ($error) {
        echo "<div class='error'><ul class='pesan'>$error</ul></div>";
    } ?>
    <form action="" method="POST">
        <table>
            <tr>
                <td class="label">Email</td>
                <td><input type="text" name="email" class="input" value="<?php echo $email ?>" /></td>
            </tr>
            <tr>
                <td class="label">Password</td>
                <td><input type="password" name="password" class="input" />
                    <br />
                    Lupa Password? Silahkan <a href='<?php echo url_dasar() ?>/lupa_password.php'> Reset Password </a>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="login" value="Login" class="tbl-biru" /></td>
            </tr>
        </table>
    </form>
</div>

<?php include("inc_footer.php") ?>