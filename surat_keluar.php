<?php include_once("inc_header.php") ?>
<?php include_once("inc/inc_koneksi.php"); ?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$error = "";
$sukses = "";

if (isset($_SESSION['sukses'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['sukses'] . "</div>";
    unset($_SESSION['sukses']); // Agar tidak muncul terus
}
?>

<div class="container mt-4">
    <?php
    $sukses = "";
    $katakunci = (isset($_GET['katakunci'])) ? $_GET['katakunci'] : "";
    if (isset($_GET['op'])) {
        $op = $_GET['op'];
    } else {
        $op = "";
    }
    if ($op == 'delete') {
        $id = $_GET['id'];
        $sql1 = "delete from surat_keluar where id = '$id'";
        $q1 = mysqli_query($koneksi, $sql1);
        if ($q1) {
            $sukses = "Data Berhasil Dihapus";
        }
    }
    ?>
    <h1>Surat Keluar</h1>
    <p>
        <a href="surat_keluar_input.php">
            <input type="button" class="btn btn-primary" value="Masukkan Data Baru" />
        </a>
    </p>
    <?php
    if ($sukses) {
        ?>
        <div class="alert alert-primary" role="alert">
            <?php echo $sukses ?>
        </div>
        <?php
    }
    ?>
    <form class="row g-3" method="get">
        <div class="col-auto">
            <input type="text" class="form-control" placeholder="Masukkan Kata Kunci" name="katakunci"
                value="<?php echo $katakunci ?>" />
        </div>
        <div class="col-auto">
            <input type="submit" name="cari" value="Cari Tulisan" class="btn btn-secondary" />
        </div>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-1">No</th>
                <th>Perihal</th>
                <th>Pengirim</th>
                <th>Penerima</th>
                <th>Jenis Surat</th>
                <?php if (isset($_SESSION['members_email'])): ?>
                    <th class="col-2">Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $sqltambahan = "";
            $per_halaman = 10;
            if ($katakunci != '') {
                $array_katakunci = explode(" ", $katakunci);
                for ($x = 0; $x < count($array_katakunci); $x++) {
                    $sqlcari[] = "(perihal like '%" . $array_katakunci[$x] . "%' or pengirim like '%" . $array_katakunci[$x] . "%' or penerima like '%" . $array_katakunci[$x] . "%' or jsurat like '%" . $array_katakunci[$x] . "%' or isi like '%" . $array_katakunci[$x] . "%' or tgl_isi like '%" . $array_katakunci[$x] . "%')";
                }
                $sqltambahan = "where" . implode(" or ", $sqlcari);
            }
            $sql1 = "select * from surat_keluar $sqltambahan";
            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            $mulai = ($page > 1) ? ($page * $per_halaman) - $per_halaman : 0;
            $q1 = mysqli_query($koneksi, $sql1);
            $total = mysqli_num_rows($q1);
            $pages = ceil($total / $per_halaman);
            $nomor = $mulai + 1;
            $sql1 = $sql1 . " order by tgl_isi desc limit $mulai, $per_halaman";

            $q1 = mysqli_query($koneksi, $sql1);
            while ($r1 = mysqli_fetch_array($q1)) {
                ?>
                <tr>
                    <td><?php echo $nomor++ ?></td>
                    <td><?php echo $r1['perihal'] ?></td>
                    <td><?php echo $r1['pengirim'] ?></td>
                    <td><?php echo $r1['penerima'] ?></td>
                    <td><?php echo $r1['jsurat'] ?></td>
                    <td>
                        <?php if (isset($_SESSION['members_email'])): ?>
                        <a href="surat_keluar_detail.php?id=<?php echo $r1['id'] ?>">
                            <span class="badge text-bg-info">Lihat</span>
                        </a>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['members_email'])): ?>
                        <a href="surat_keluar_input.php?id=<?php echo $r1['id'] ?>">
                            <span class="badge text-bg-warning">Edit</span>
                        </a>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['members_email'])): ?>
                            <a href="surat_keluar.php?op=delete&id=<?php echo $r1['id'] ?>"
                                onclick="return confirm('Apakah Anda Yakin Data Ini Ingin Dihapus?')">
                                <span class="badge text-bg-danger">Delete</span>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            $cari = (isset($_GET['cari'])) ? $_GET['cari'] : "";
            for ($i = 1; $i <= $pages; $i++) {
                ?>
                <li class="page-item">
                    <a class="page-link"
                        href="surat_keluar.php?katakunci=<?php echo $katakunci ?>&cari=<?php echo $cari ?>&page=<?php echo $i ?>"><?php echo $i ?></a>
                </li>
                <?php
            }
            ?>
        </ul>
    </nav>
</div>

<?php include_once("inc_footer.php") ?>