<!-- inc/vt.php-->
<?php
//mysql veri tabanına bağlanıyoruz
//sizde kendi veri tabanına göre bilgilerinizi güncelleyin
//3. parametre password bende boş sizde kendi kullanıcı bilgilerinize göre düzenleyin
$baglanti = new mysqli("localhost:3306","root","413508","urlshortener");
if($baglanti->connect_error)
{
    //hata varsa yazdırıyoruz ve sayfayı sonlandırıyor
    echo $baglanti->connect_error." hatası oluştu";
    exit;
}
else
{
}

//türkçe karakter sorunu olmasın diye karakter setini ayarlıyoruz
$baglanti->set_charset("utf8");
?>
