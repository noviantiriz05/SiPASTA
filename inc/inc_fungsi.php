<?php
function url_dasar(){
    //$_SERVER['SERVER_NAME'] : alamat website, misalkan sipasta.com
    //$_SERVER['SCRIPT_NAME'] : directory website, sipasta.com/blog/ $_SERVER['SCRIPT_NAME'] : blog
    $url_dasar = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']);
    return $url_dasar;
}
function ambil_gambar($id_tulisan){
    global $koneksi;
    $sql1   = "select * from halaman where id = '$id_tulisan'";
    $q1     = mysqli_query($koneksi, $sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = $r1["isi"];

    preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $text, $img);
    $gambar = $img[1]; // ../gambar/filename.jpg
    $gambar = str_replace("../gambar/",url_dasar()."/gambar/", $gambar);
    return $gambar;
}
function ambil_kutipan($id_tulisan){
    global $koneksi;
    $sql1   = "select * from halaman where id = '$id_tulisan'";
    $q1     = mysqli_query($koneksi, $sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = $r1["pengirim"];
    return $text;
}
function ambil_judul($id_tulisan){
    global $koneksi;
    $sql1   = "select * from halaman where id = '$id_tulisan'";
    $q1     = mysqli_query($koneksi, $sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = $r1["perihal"];
    return $text;
}
function ambil_isi($id_tulisan){
    global $koneksi;
    $sql1   = "select * from halaman where id = '$id_tulisan'";
    $q1     = mysqli_query($koneksi, $sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = strip_tags($r1["isi"]);
    return $text;
}
function bersihkan_judul($perihal){
    if (!is_string($perihal) || empty($perihal)) return '';

    $judul_baru = strtolower(trim($perihal)); // trim untuk buang spasi di awal/akhir
    $judul_baru = preg_replace("/[^a-z0-9\s]/", "", $judul_baru); // hanya huruf kecil dan angka
    $judul_baru = preg_replace("/\s+/", "-", $judul_baru); // ganti spasi banyak jadi satu strip
    return $judul_baru;
}
function buat_link_halaman($id){
    global $koneksi;
    $sql1       = "select * from halaman where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $perihal    = $r1["perihal"];
    //http://localhost/sipasta/halaman.php/13/judul
    return url_dasar()."/halaman.php/$id/$perihal";
}

function dapatkan_id(){
    $id     = "";
    if (isset($_SERVER['PATH_INFO'])){
        $id = dirname($_SERVER['PATH_INFO']);
        $id = preg_replace("/[^0-9]/","",$id);
    }
    return $id;
}

function set_isi( $isi ){
    $isi    = str_replace("../gambar/",url_dasar()."/gambar/",$isi);
    return $isi;
}

function maximum_kata($isi,$maximum){
    $array_isi = explode(" ",$isi);
    $array_isi = array_slice($array_isi,0,$maximum);
    $isi       = implode(" ",$array_isi);
    return $isi;
}

function maksimal_kata($text, $jumlah_kata = 20) {
    $kata = explode(" ", $text);
    $potongan = array_slice($kata, 0, $jumlah_kata);
    return implode(" ", $potongan) . (count($kata) > $jumlah_kata ? "..." : "");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function kirim_email($email_penerima, $nama_penerima, $judul_email, $isi_email){

    $email_pengirim         = "lunavia61@gmail.com";
    $nama_pengirim          = "SiPASTA";

    //Load Composer's autoloader (created by composer, not included with PHPMailer)
    require getcwd().'/vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $email_pengirim;                     //SMTP username
        $mail->Password   = 'qpsbnxalfgsaxdpo';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($email_pengirim, $nama_pengirim);
        $mail->addAddress($email_penerima, $nama_penerima);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $judul_email;
        $mail->Body    = $isi_email;

        $mail->send();
        return "sukses";
    } catch (Exception $e) {
        return "gagal: {$mail->ErrorInfo}";
    }
}
?>