<?php
session_start();

include 'vt.php';
// Veritabanı bağlantısı yapılıp, veriler çekildiği varsayılmıştır

// Form verilerini al
$shortened_url = $_POST['id'];

// Veritabanından main_url'i sil
$query = "DELETE FROM url WHERE short_url = '$shortened_url'";
mysqli_query($baglanti, $query);



//Dosyayı sil

$url = $shortened_url;
$url_parts = explode('/', $url);
$short_url = end($url_parts);
$short_url_parts = explode('.', $short_url);
$short_code = $short_url_parts[0];

echo $short_code;

$filename = $short_code.".php";
unlink($filename);


// Ana sayfaya yönlendir

if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "5672") {

    header("Location: profile.php");


}
elseif (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == 6666)
{
    header("Location: admin.php");

}
else{
    header('location: index.php');

}


