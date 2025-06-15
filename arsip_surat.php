<?php include_once("inc_header.php") ?>
<?php include_once("inc/inc_koneksi.php"); ?>

<div class="container mt-4">
    <?php
    $sukses = "";
    $katakunci = (isset($_GET['katakunci'])) ? $_GET['katakunci'] : "";
    if (isset($_GET['op'])) {
        $op = $_GET['op'];
    } else {
        $op = "";
    }
    ?>
    <h1>Arsip Surat</h1>
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
            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            $per_halaman = 10;
            $mulai = ($page > 1) ? ($page * $per_halaman) - $per_halaman : 0;

            // Buat SQL tambahan pencarian
            $sqltambahan1 = "";
            $sqltambahan2 = "";
            if (!empty($katakunci)) {
                $array_katakunci = explode(" ", $katakunci);
                $sqlcari = [];
                foreach ($array_katakunci as $kata) {
                    $sqlcari[] = "(perihal LIKE '%$kata%' OR pengirim LIKE '%$kata%' OR penerima LIKE '%$kata%' OR jsurat LIKE '%$kata%' OR isi LIKE '%$kata%')";
                }
                $filter = implode(" OR ", $sqlcari);
                $sqltambahan1 = "WHERE $filter";
                $sqltambahan2 = "WHERE $filter";
            }

            // Hitung total data
            $sql_union_total = "
    (SELECT id FROM surat_masuk $sqltambahan1)
    UNION
    (SELECT id FROM surat_keluar $sqltambahan2)
";
            $q_total = mysqli_query($koneksi, $sql_union_total);
            $total = mysqli_num_rows($q_total);
            $pages = ceil($total / $per_halaman);
            $nomor = $mulai + 1;

            // Query ambil data dengan LIMIT
            $sql_union = "
    (SELECT id, perihal, pengirim, penerima, jsurat, isi, tgl_isi as tanggal, 'masuk' AS jenis_surat FROM surat_masuk $sqltambahan1)
    UNION
    (SELECT id, perihal, pengirim, penerima, jsurat, isi, tgl_isi as tanggal, 'keluar' AS jenis_surat FROM surat_keluar $sqltambahan2)
    ORDER BY tanggal DESC
    LIMIT $mulai, $per_halaman
";
            $q_union = mysqli_query($koneksi, $sql_union);

            // Tampilkan data surat masuk
            while ($r1 = mysqli_fetch_array($q_union)) {
                ?>
                <tr>
                    <td><?php echo $nomor++ ?></td>
                    <td><?php echo $r1['perihal'] ?></td>
                    <td><?php echo $r1['pengirim'] ?></td>
                    <td><?php echo $r1['penerima'] ?></td>
                    <td><?php echo $r1['jsurat'] ?></td>
                    <td>
                        <?php if (isset($_SESSION['members_email'])): ?>
                            <?php
                            // Ambil jenis surat dari data (pastikan ada kolom 'jenis_surat')
                            $jenis = $r1['jenis_surat']; // 'masuk' atau 'keluar'
                            $detail_page = "surat_" . $jenis . "_detail.php"; // hasil: surat_masuk_detail.php atau surat_keluar_detail.php
                            ?>
                            <a href="<?php echo $detail_page ?>?id=<?php echo $r1['id'] ?>">
                                <span class="badge text-bg-info">Lihat</span>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation example" class="mt-3">
        <ul class="pagination">
            <?php
            $cari = (isset($_GET['cari'])) ? $_GET['cari'] : "";
            for ($i = 1; $i <= $pages; $i++) {
                ?>
                <li class="page-item">
                    <a class="page-link"
                        href="arsip_surat.php?katakunci=<?php echo $katakunci ?>&cari=<?php echo $cari ?>&page=<?php echo $i ?>">
                        <?php echo $i ?>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
    </nav>
</div>

<?php include_once("inc_footer.php") ?>