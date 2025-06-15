<?php include("inc_header.php")?>
<style>
    .error{
        padding: 20px;
        background-color: #f44336;
        color: #FFFFFF;
        margin-bottom: 15px;
    }
    .sukses{
        padding: 20px;
        background-color: #2196F3;
        color: #FFFFFF;
        margin-bottom: 15px;
    }
</style>
<?php
$error          ="";
$sukses         ="";

if(!isset($_GET['email']) or !isset($_GET['kode'])){
    $error      = "Data yang Diperlukan untuk Verifikasi Tidak Tersedia";
}else{
    $email      =$_GET['email'];
    $kode       = $_GET['kode'];

    $sql1       ="select * from members where email = '$email'";
    $q1         =mysqli_query($koneksi,$sql1);
    $r1         =mysqli_fetch_array($q1);
    if($r1['status']== $kode){
        $sql2   = "update members set status = '1' where email = '$email'";
        $q2     =mysqli_query($koneksi,$sql2);
        $sukses ="Akun Telah Aktif. Silahkan Login";
    }else{
        $error  ="Kode Tidak Valid";
    }
}
?>
<h3>Halaman Verifikasi</h3>
<?php if($error){echo"<div class='error'>$error</div>";}?>
<?php if($sukses){echo"<div class='sukses'>$sukses</div>";}?>
<?php include("inc_footer.php")?>