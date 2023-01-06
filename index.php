<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kısalt Gel</title>

    <head>
        <meta charset="utf-8">
        <title>Responsive Navbar | CodingNepal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    </head>
<body>
<nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <label class="logo">KISALTIP GELİYORUM</label>
    <ul>
        <?php
        //<li><a href="profile.php"></a></li>

        if(session_start()) {


                    if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "5672") {


                        $mail_adress = $_SESSION["mail"];

                        echo "<li><a href='profile.php'>".$_SESSION["name"]." ".$_SESSION["s_name"]."</a></li>";

                        echo "  <li><a href='logout.php'>Çıkış Yap</a></li>";

                    }
                    else{

                        echo "<li><a href='login.php'>Giriş Yap</a></li>";

                    }



        }


        ?>

    </ul>

</nav>
</body>

<center><h3>Kısaltmak istediğiniz linki giriniz</h3></center>


<div class="w3-display-middle" style="width:65%" align="center">
    <form method="post" name="link_kisalt">

        <div>
        Link: <input type="text" formmethod="submit" id="adi" name="adi">
        </div>
        <div>
            Özelleştirilmiş Kısa Link: <input type="text" formmethod="submit" id="ozel_link" maxlength="10" name="ozel_link" placeholder="kisaltgel.co/">
        </div>
        <div>
            Sona Erme Tarihi <input type="date" formmethod="submit" name="sona_erme_tarihi" id="sona_erme_tarihi" required>
        </div>


        <input type="submit" value="Kısalt">


    </form>
    <?php
    if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "5672") {


        $mail_adress = $_SESSION["mail"];

    }
    else{

    }

    include 'vt.php';

    if($_POST)
    {
        $url =  $_POST['adi'];                           //URL inputtan alınır.
        $ozel_link = $_POST['ozel_link'];                //Ozel Link inputundan özel link alınır.
        $sona_erme = $_POST['sona_erme_tarihi'];         //Sona erme tarihini inputtan alınır.
        $sona_erme = strtotime($sona_erme);              //Gelen tarihi düzgünleştirir.

        //Url'de .com, .org, .co, .net mevcutsa işlemleri gerçekleştir
        if(strpos($url, '.com') or strpos($url, '.org') or  strpos($url, '.co') or strpos($url, '.net')) //Ekleme Yapılacak edu.tr ..
        {

            echo "<hr>";
            $girilen_tarih =  date("Y-m-d", $sona_erme); //Gün ay yıl'tarihlerini al sadece
            $todays_date = date("Y-m-d"); //Bugünün tarihini verir. Veritabında Linkin oluşturulan zamanını eklemek için kullanılıyor.


            if($ozel_link == "")                            //Özel Link Girilmediyse Linki Kendisi oluşturur.
            {
                if(strstr($url, 'http://'))
                {
                    $url_md5 = md5($url);                       //URL'yi md5 ile şifreler. Bir stringe atar.
                    $url_md5_cropped = substr($url_md5, 0, 3).substr($url_md5, 12, 3).substr($url_md5, 31, 1); //Kısa rastgele string oluşturulur.
                    $shortened_url = "kisaltgel.co/".$url_md5_cropped;                                          //Kısa Link oluşturulur. kisaltgel.co/14d89b5
                    $mail = $_SESSION["mail"];
                    $query = "INSERT INTO url (main_url, short_url, expire_date, create_date, auth_mail) VALUES ('$url', '$shortened_url', '$girilen_tarih', '$todays_date', '$mail_adress')";
                    if ($baglanti->query($query) == TRUE)
                    {
                        echo 'Shortened URL = <a href="'.$url_md5_cropped.'.php">'.$shortened_url.'</a>';

                        $myfile = fopen("$url_md5_cropped.php", "w") or die("Link oluşturulamadı!");//Kısa string'in adında bir php dosyası oluşturulur.
                        $txt = "
                            <?php
                                    
                            \$sql_update = \"UPDATE url SET counter_url = counter_url + 1 WHERE short_url = 'kisaltgel.co/$shortened_url'\";
                            include('vt.php');
                            \$url_name = basename(\$_SERVER['PHP_SELF']);
                            \$result = \$baglanti->query(\"UPDATE url SET counter_url = counter_url + 1 WHERE short_url = 'kisaltgel.co/\$url_name'\"); 
                            header('Location: $url');
                            ?>";

                        fwrite($myfile, $txt); ##.php dosyasına yaz
                        fclose($myfile); ##Kapatılması gerekiyor
                        echo "<hr> <div>";
                        echo "<a> url=".$url."</a>";                //URL yazdırılır.
                        echo "</div><hr> <div>";
                        echo "<a> url md5=".$url_md5."</a>";        //md5'e çevrilen url yazdırılır.
                        echo "<hr></div>";
                        echo "<a> url md5 cropped=".$url_md5_cropped."</a>";        //Rastgele yazdırılan string yazdırılır.
                        echo "<hr>";
                                echo "Shortened URL =".$shortened_url;                                                      //Kısa Link yazdırılır.
                    } else {
                        echo "Bu link daha önceden oluşturulmuştur. İsterseniz özel bir kısaltma ekleyerek linki kısaltabilirsiniz.";
                    }
                }
                elseif (strstr($url, 'https://'))
                {
                    $url_md5 = md5($url);
                    $url_md5_cropped = substr($url_md5, 0, 3).substr($url_md5, 12, 3).substr($url_md5, 31, 1);
                    $shortened_url = "kisaltgel.co/".$url_md5_cropped;
                    $mail = $_SESSION["mail"];
                    $query = "INSERT INTO url (main_url, short_url, expire_date, create_date, auth_mail) VALUES ('$url', '$shortened_url', '$girilen_tarih', '$todays_date', '$mail_adress')";
                    if ($baglanti->query($query) == TRUE) {
                        echo 'Shortened URL = <a href="'.$url_md5_cropped.'.php">'.$shortened_url.'</a>';
                        $myfile = fopen("$url_md5_cropped.php", "w") or die("Link oluşturulamadı!");//Kısa string'in adında bir php dosyası oluşturulur.


                        $txt = "
                            <?php        
                            \$sql_update = \"UPDATE url SET counter_url = counter_url + 1 WHERE short_url = 'kisaltgel.co/$shortened_url'\";
                            include('vt.php');
                            \$url_name = basename(\$_SERVER['PHP_SELF']);
                            \$result = \$baglanti->query(\"UPDATE url SET counter_url = counter_url + 1 WHERE short_url = 'kisaltgel.co/\$url_name'\"); 
                            header('Location: $url');
                            ?>";


                        fwrite($myfile, $txt);
                        fclose($myfile);
                        echo "<hr> <div>";
                        echo "<a> url=".$url."</a>";                //URL yazdırılır.
                        echo "</div><hr> <div>";
                        echo "<a> url md5=".$url_md5."</a>";        //md5'e çevrilen url yazdırılır.
                        echo "<hr></div>";
                        echo "<a> url md5 cropped=".$url_md5_cropped."</a>";        //Rastgele yazdırılan string yazdırılır.
                        echo "<hr>";
                        echo "Shortened URL =".$shortened_url;                                                      //Kısa Link yazdırılır.
                    }
                    else
                    {
                        echo "Bu link daha önceden oluşturulmuştur. İsterseniz özel bir kısaltma ekleyerek linki kısaltabilirsiniz.";
                    }

                }



                else //Gerçek linke girmek için başına https:// eklenmesi yapılır. Öbür türlü geçersiz link oluşturur.
                {
                    $url_md5 = md5($url);                       //URL'yi md5 ile şifreler. Bir stringe atar.
                    $url_md5_cropped = substr($url_md5, 0, 3).substr($url_md5, 12, 3).substr($url_md5, 31, 1); //Kısa rastgele string oluşturulur.
                    $shortened_url = "kisaltgel.co/".$url_md5_cropped;                                          //Kısa Link oluşturulur.
                    $mail = $_SESSION["mail"];

                    $query = "INSERT INTO url (main_url, short_url, expire_date, create_date, auth_mail) VALUES ('$url', '$shortened_url', '$girilen_tarih', '$todays_date', '$mail')";


                    if ($baglanti->query($query) == TRUE) {
                        echo 'Shortened URL = <a href="'.$url_md5_cropped.'.php">'.$shortened_url.'</a>';
                        $myfile = fopen("$url_md5_cropped.php", "w") or die("Link oluşturulamadı!");//Kısa string'in adında bir php dosyası oluşturulur.



                        $txt = "
                            <?php        
                            \$sql_update = \"UPDATE url SET counter_url = counter_url + 1 WHERE short_url = 'kisaltgel.co/$shortened_url'\";
                            include('vt.php');
                            \$url_name = basename(\$_SERVER['PHP_SELF']);
                            \$result = \$baglanti->query(\"UPDATE url SET counter_url = counter_url + 1 WHERE short_url = 'kisaltgel.co/\$url_name'\"); 
                            header('Location: https://$url');
                            ?>";



                        fwrite($myfile, $txt);
                        fclose($myfile);


                        echo "<hr> <div>";
                        echo "<a> url=".$url."</a>";                //URL yazdırılır.
                        echo "</div><div>";
                        //echo "<a> url md5=".$url_md5."</a>";        //md5'e çevrilen url yazdırılır.
                        echo "</div>";
                        //echo "<a> url md5 cropped=".$url_md5_cropped."</a>";        //Rastgele yazdırılan string yazdırılır.
                        //echo "<hr>";
                    } else {
                        echo "Bu link daha önceden oluşturulmuştur. İsterseniz özel bir kısaltma ekleyerek linki kısaltabilirsiniz.";
                    }
                }
                echo "<hr>";
                //$shortened_url
                //$url_md5_cropped
                echo "<hr>";

            }



            else{ //Özel Link Girildiyse eğer
                $dosya_ismi = $ozel_link.".php";
                $shortened_url = "kisaltgel.co/".$dosya_ismi;
                $_SESSION['shortened_url'] = $shortened_url;
                if(!file_exists($dosya_ismi)){
                    $myfile = fopen("$dosya_ismi", "w") or die("Link oluşturulamadı!");
                    if(strstr($url, 'http://'))
                    {
                        $txt = "
                            <?php        
                            \$sql_update = \"UPDATE url SET counter_url = counter_url + 1 WHERE short_url = 'kisaltgel.co/$shortened_url'\";
                            include('vt.php');
                            \$url_name = basename(\$_SERVER['PHP_SELF']);
                            \$result = \$baglanti->query(\"UPDATE url SET counter_url = counter_url + 1 WHERE short_url = 'kisaltgel.co/\$url_name'\"); 
                            header('Location: $url');
                            ?>";
                        fwrite($myfile, $txt);
                        fclose($myfile);
                    }
                    elseif (strstr($url, 'https://'))
                    {
                        $txt = "
                            <?php 
                            \$sql_update = \"UPDATE url SET counter_url = counter_url + 1 WHERE short_url = 'kisaltgel.co/$shortened_url'\";
                            include('vt.php');
                            \$url_name = basename(\$_SERVER['PHP_SELF']);
                            \$result = \$baglanti->query(\"UPDATE url SET counter_url = counter_url + 1 WHERE short_url = 'kisaltgel.co/\$url_name'\"); 
                            header('Location: $url');
                            ?>";
                        fwrite($myfile, $txt);
                        fclose($myfile);
                    }
                    else
                    {
                        $txt = "
                            <?php 
                            \$sql_update = \"UPDATE url SET counter_url = counter_url + 1 WHERE short_url = 'https://kisaltgel.co/$shortened_url'\";
                            include('vt.php');
                            \$url_name = basename(\$_SERVER['PHP_SELF']);
                            \$result = \$baglanti->query(\"UPDATE url SET counter_url = counter_url + 1 WHERE short_url = 'kisaltgel.co/\$url_name'\"); 
                            header('Location: https://$url');
                            ?>";
                        fwrite($myfile, $txt);
                        fclose($myfile);
                    }

                    echo "<hr>";
                    echo 'Özelleştirilmiş Kısa Link = <a href="'.$dosya_ismi.'">'.$shortened_url.'</a>';


                    echo "<hr>";
                    $mail = $_SESSION["mail"];

                    echo '<li><a> Girilen Link= '.$url.'</a></li>';
                    if($sona_erme != "")
                    {
                        echo "Sona Erme Tarihi:".date("Y-m-d", $sona_erme);;
                    }
                    $sona_erme = date("Y-m-d", $sona_erme);
                    $todays_date = date("Y-m-d");

                    $query = "INSERT INTO url (main_url, short_url, expire_date, create_date, auth_mail) VALUES ('$url', '$shortened_url', '$sona_erme', '$todays_date', '$mail')";
                    mysqli_query($baglanti, $query);

                }

                else
                    echo "Mevcutta böyle bir özel link var. Lütfen farklı bir özel link oluşturun";
            }

        }

        else{
            echo '<script> alert("Girdiğiniz Link Geçersiz! Lütfen geçerli bir link giriniz!");</script>';
        }
    }
    ?>
</div>

</head>
<body>

</body>
</html>