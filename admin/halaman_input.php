<?php include("inc_header.php") ?>
<?php include("../inc/inc_koneksi.php");
?>
<?php
$perihal = "";
$pengirim = "";
$penerima = "";
$jsurat = "";
$isi = "";
$error = "";
$sukses = "";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = "";
}

if($id !=""){
    $sql1       = "select * from halaman where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $perihal    = $r1['perihal'];
    $pengirim   = $r1['pengirim'];
    $penerima   = $r1['penerima'];
    $jsurat     = $r1['jsurat'];
    $isi        = $r1['isi'];

    if($isi == ''){
        $error = "Data Tidak Ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $perihal = $_POST['perihal'];
    $pengirim = $_POST['pengirim'];
    $penerima = $_POST['penerima'];
    $jsurat = $_POST['jsurat'];
    $isi = $_POST['isi'];

    if ($perihal == '' or $pengirim == '' or $penerima == '' or $isi == '') {
        $error = "Silakan Masukkan Semua Data";
    }

    if (empty($error)) {
        if($id !=""){
            $sql1   = "update halaman set perihal = '$perihal', pengirim = '$pengirim', penerima = '$penerima', jsurat = '$jsurat', isi = '$isi', tgl_isi = now() where id = '$id'";
        }else{
            $sql1       = "insert into halaman(perihal, pengirim, penerima, jsurat, isi) values ('$perihal','$pengirim','$penerima','$jsurat','$isi')";
        }
        
        $q1 = mysqli_query($koneksi, $sql1);
        if ($q1) {
            $sukses = "Sukses Memasukkan Data";
        } else {
            $error = "Gagal Memasukkan Data";
        }
    }
}

?>
<h1>Home Input Data</h1>
<div class="mb-3 row">
    <a href="halaman.php">
        << Kembali ke Home</a>
</div>
<?php
if ($error) {
    ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error ?>
    </div>
    <?php
}
?>
<?php
if ($sukses) {
    ?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses ?>
    </div>
    <?php
}
?>

<form action="" method="post">
    <div class="mb-3 row">
        <label for="perihal" class="col-sm-2 col-form-label">Perihal</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="perihal" value="<?php echo $perihal ?>" name="perihal">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="pengirim" class="col-sm-2 col-form-label">Pengirim</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="pengirim" value="<?php echo $pengirim ?>" name="pengirim">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="penerima" class="col-sm-2 col-form-label">Penerima</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="penerima" value="<?php echo $penerima ?>" name="penerima">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="jsurat" class="col-sm-2 col-form-label">Jenis Surat</label>
        <div class="col-sm-10">
            <select class="form-select" id="jsurat" name="jsurat" required>
                <option value="">-- Pilih Jenis Surat --</option>
                <option value="Surat Masuk" <?php if ($jsurat == "Surat Masuk")
                    echo "selected"; ?>>Surat Masuk</option>
                <option value="Surat Keluar" <?php if ($jsurat == "Surat Keluar")
                    echo "selected"; ?>>Surat Keluar
                </option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="isi" class="col-sm-2 col-form-label">Isi</label>
        <div class="col-sm-10">
            <textarea name="isi" class="form-control" id="summernote"><?php echo $isi ?></textarea>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
        </div>
    </div>
</form>
<?php include("inc_footer.php") ?>