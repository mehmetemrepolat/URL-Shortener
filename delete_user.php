<?php
session_start();

include 'vt.php';
if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "5672") {

    header("Location: profile.php");


}
elseif (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == 6666)
{

}
else{
    header('location: index.php');

}
// Veritabanı bağlantısı yapılıp, veriler çekildiği varsayılmıştır

// Form verilerini al
$auth_mail = $_POST['id1'];

// Veritabanından main_url'i sil
$query = "DELETE FROM user WHERE user_mail = '$auth_mail'";
mysqli_query($baglanti, $query);

$baglanti ->close();

header('location: admin_userlist.php');
// Ana sayfaya yönlendir




