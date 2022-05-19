
<?php
session_start();
$con = mysqli_connect("db host", "db user", "db pass", "db name");

if (isset($_POST['save_ads'])) {
    $jenispaket = $_POST['jenispaket'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $nomortelepon = $_POST['nomortelepon'];
    $namausaha = $_POST['namausaha'];
    $bidangusaha = $_POST['bidangusaha'];
    $deskripsiusaha = $_POST['deskripsiusaha'];
    $tujuaniklan = $_POST['tujuaniklan'];
    $tanggaliklan = $_POST['tanggaliklan'];
    $anggaraniklan = $_POST['anggaraniklan'];
    $targetlokasi = $_POST['targetlokasi'];
    $lokasilanjutan = $_POST['lokasilanjutan'];
    $usiaminimal = $_POST['usiaminimal'];
    $usiamaksimal = $_POST['usiamaksimal'];
    $targetgender = $_POST['targetgender'];
    $orangcocok = $_POST['orangcocok'];
    $berbahasa = implode(', ', $_POST['berbahasa']);
    $ditayangkan = implode(', ', $_POST['ditayangkan']);


    //start uploading gambar
    $uploadgambar = array_filter($_FILES['uploadgambar']['name']); //Use something similar before processing files.
    // Count the number of uploaded files in array
    $total_count = count($_FILES['uploadgambar']['name']);
    // Loop through every file
    for ($i = 0; $i < $total_count; $i++) {
        //The temp file path is obtained
        $tmpFilePath = $_FILES['uploadgambar']['tmp_name'][$i];
        //A file path needs to be present
        if ($tmpFilePath != "") {
            //Setup our new file path
            $dirusers = "upload-gambar-fb-ads/" . $nama;
            mkdir($dirusers);
            $newFilePath = "$dirusers/" . $_FILES['uploadgambar']['name'][$i];
            //File is uploaded to temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                //Other code goes here
            }
        }
    }



    // foreach($_FILES['uploadgambar']['name'] as $key => $val) {
    //     $rand = rand('11111111','99999999');
    //     $uploadgambar = $rand. '_'.$val;
    //     move_uploaded_file($_FILES['uploadgambar']['tmp_name'][$key],'upload-gambar-fb-ads/'.$uploadgambar);
    // }

    $linkiklan = $_POST['linkiklan'];
    $juduliklan = $_POST['juduliklan'];
    $captioniklan = $_POST['captioniklan'];
    $tombol = $_POST['tombol'];
    $linktombol = $_POST['linktombol'];
    $tanggal = date("Y-m-d H:i:s");
    $referral =  $_POST["referral"];


    $query = "INSERT INTO formads (jenispaket, nama,email,alamat,nomortelepon,namausaha,bidangusaha,deskripsiusaha, tujuaniklan, tanggaliklan, anggaraniklan, targetlokasi, lokasilanjutan, usiaminimal, usiamaksimal, targetgender, orangcocok, berbahasa, ditayangkan, uploadgambar, linkiklan, juduliklan, captioniklan, tombol, linktombol, tanggal, referral) VALUES ('$jenispaket', '$nama', '$email','$alamat','$nomortelepon', '$namausaha','$bidangusaha' ,'$deskripsiusaha', '$tujuaniklan', '$tanggaliklan', '$anggaraniklan', '$targetlokasi', '$lokasilanjutan', '$usiaminimal', '$usiamaksimal', '$targetgender', '$orangcocok', '$berbahasa', '$ditayangkan', '$uploadgambar', '$linkiklan', '$juduliklan', '$captioniklan', '$tombol', '$linktombol', '$tanggal', '$referral')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "Inserted Successfully";
        header("Location: konfirmasi-brief-ads.php");
    } else {
        $_SESSION['status'] = "Inserted Failed";
        header("Location: brief-ads.php");
    }
}
?> 