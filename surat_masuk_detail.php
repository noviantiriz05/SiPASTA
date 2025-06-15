<?php
include_once("inc_header.php");
include_once("inc/inc_koneksi.php");
include_once("inc_session_check.php");

if (!isset($_GET['id'])) {
    echo "Data tidak ditemukan.";
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM surat_masuk WHERE id = $id";
$q = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($q);

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}
?>

<div class="container mt-4">
    <h2>Detail Surat Masuk</h2>
    <table class="table table-bordered">
        <tr>
            <th>Perihal</th><td><?= $data['perihal'] ?></td>
        </tr>
        <tr>
            <th>Pengirim</th><td><?= $data['pengirim'] ?></td>
        </tr>
        <tr>
            <th>Penerima</th><td><?= $data['penerima'] ?></td>
        </tr>
        <tr>
            <th>Jenis Surat</th><td><?= $data['jsurat'] ?></td>
        </tr>
        <tr>
            <th>Tanggal Isi</th><td><?= $data['tgl_isi'] ?></td>
        </tr>
        <tr>
            <th>Isi</th>
            <td>
                <?php if (!empty($data['isi'])): ?>
                    <a href="lihat_file.php?file=<?= urlencode($data['isi']) ?>" target="_blank">Lihat Lampiran</a>
                <?php else: ?>
                    Tidak ada file
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <a href="surat_masuk.php" class="btn btn-secondary mb-5">Kembali</a>
</div>

<?php include_once("inc_footer.php"); ?>
