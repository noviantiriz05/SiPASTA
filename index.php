<?php include_once("inc_header.php") ?>

<?php
if (isset($_SESSION['success_message'])) {
    echo "<div style='max-width: 1180px; margin: 20px auto; padding: 20px; background-color: #D0E9FF; color: #003366; font-weight: bold; border-radius: 10px; text-align: center;'>
            " . $_SESSION['success_message'] . "
          </div>";
    unset($_SESSION['success_message']);
}
?>

<style>
    section {
        padding-left: 50px;
        padding-right: 50px;
    }

    .gambar-responsif {
        max-width: 100%;
        width: 35%;
        height: auto;
    }

    @media (max-width: 768px) {
        .gambar-responsif {
            width: 100%;
            margin-left: 0;
        }
    }
</style>
<!-- untuk home -->
<section id="home">
    <img src="<?php echo ambil_gambar('13') ?>" />
    <div class="kolom" style="text-align: justify;">
        <p class="deskripsi"><?php echo ambil_kutipan('13') ?></p>
        <h2><?php echo ambil_judul('13') ?></h2>
        <?php echo maximum_kata(ambil_isi('13'), 50) ?>
        <p><a href="<?php echo buat_link_halaman('13') ?>" class="tbl-pink">Pelajari Lebih Lanjut</a></p>
    </div>
</section>

<!-- untuk surat masuk -->
<section id="surat_masuk">
    <div class="kolom" style="text-align: justify;">
        <p class="deskripsi"><?php echo ambil_kutipan('14') ?></p>
        <h2><?php echo ambil_judul('14') ?></h2>
        <?php echo maximum_kata(ambil_isi('14'), 50) ?>
        <p><a href="surat_masuk.php" class="tbl-biru">Pelajari Lebih Lanjut</a></p>
    </div>
    <img src="<?php echo ambil_gambar('14') ?>" class="gambar-responsif" style="display: block; margin: 20px 20px;" />
</section>

<!-- untuk surat keluar -->
<section id="surat_keluar">
    <div class="kolom" style="text-align: justify; flex: 1;">
        <p class="deskripsi"><?php echo ambil_kutipan('15') ?></p>
        <h2><?php echo ambil_judul('15') ?></h2>
        <?php echo maximum_kata(ambil_isi('15'), 50) ?>
        <p><a href="surat_keluar.php" class="tbl-biru">Pelajari Lebih Lanjut</a></p>
    </div>
    <img src="<?php echo ambil_gambar('15') ?>" class="gambar-responsif"
        style="display: block; margin: 20px 20px;" />
</section>

<!-- untuk arsip surat -->
<section id="arsip_surat">
    <div class="tengah">
        <div class="kolom">
            <p class="deskripsi"><?php echo ambil_kutipan('16') ?></p>
            <h2><?php echo ambil_judul('16') ?></h2>
            <?php echo maximum_kata(ambil_isi('16'), 50) ?>
        </div>

        <div class="tengah">
            <p><a href="arsip_surat.php" class="tbl-biru">Pelajari Lebih Lanjut</a></p>
        </div>

        <div class="partner-list">
            <div class="tengah">
                <img src="<?php echo ambil_gambar('16') ?>" class="gambar-responsif"
                    style="margin-left: 10px; margin-bottom: 20px" />
            </div>
        </div>
    </div>
</section>
<?php include_once("inc_footer.php") ?>