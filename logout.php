<!--Logout.php-->
<?php
//oturumu sonlandırıyoruz
session_start();
session_destroy();



//sayfayı yönlendiriyoruz
header("location:login.php");
?>
