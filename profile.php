
<head>
    <meta charset="UTF-8">
    <title>Kısalt Gel</title>

    <head>
        <meta charset="utf-8">
        <title>Responsive Navbar | CodingNepal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    </head>
<body>
<nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <label class="logo">KISALTIP GELİYORUM</label>

    <ul>
        <li><a href="index.php">Ana Sayfa</a></li>
        <li><a href="logout.php">Çıkış Yap</a></li>

    </ul>
</nav>


<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }
</style>


<center><h2> Linklerim </h2></center>
<?php

session_start();
if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "5672") {



}
else{
    header('location: index.php');

}

include "vt.php";
$auth_mail = $_SESSION["mail"];

$query = "SELECT * FROM url where auth_mail = '$auth_mail' and expire_date > CURDATE() ";
$result = mysqli_query($baglanti, $query);

// HTML tablosu oluştur
echo "<table id='customers'>";
echo "<tr>
            <th>Link</th>
            <th>Kısaltılmış Link</th>
            <th>Oluşturulma Tarihi</th>
            <th>Son Kullanma Tarihi</th>
            <th>Tıklanma Sayısı</th>
            <th>İşlem</th>
            
      </tr>";
if ($result = $baglanti->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $main_urll = $row["main_url"];
        $shortened_url = $row["short_url"];
        $create = $row["create_date"];
        $expire = $row["expire_date"];
        $counter_url = $row["counter_url"];


        $url_parts = explode('/', $shortened_url);
        $short_url = end($url_parts); //koca.php
        $short_url_parts = explode('.', $short_url); //list[0] = koca list[1] = .php
        $short_code = $short_url_parts[0];
        $file_name = $short_code.".php";


        $current_date = date('Y-m-d');






        echo '<tr> 
                  <td>'.$main_urll.'</td> 
                  <td>
                  <a href="'.$file_name.'">
                  
                  '.$shortened_url.'
                  
                  </a>
                  </td>
                  <td>'.$create.'</td> 
                  <td>'.$expire.'</td> 
                  <td>'.$counter_url.'</td>
                  <td>
                  <form method="post" action="delete.php">
                  <input type="hidden" name="id" value="' . $shortened_url . '">
                  <input type="submit" value="Sil">
                  </form>
                  </td>
              </tr>';

    }
}

        echo "</table>";

$baglanti -> close();
?>

<center><h2>Kullanım Süresi Dolan Linkler</h2></center>


<?php

$mysqli = new mysqli("localhost", "root", "413508", "urlshortener");


$query = "SELECT * FROM url where auth_mail = '$auth_mail' and expire_date < CURDATE() ";


// HTML tablosu oluştur
echo "<table id='customers'>";
echo "<tr>
            <th>Link</th>
            <th>Kısaltılmış Link</th>
            <th>Oluşturulma Tarihi</th>
            <th>Son Kullanma Tarihi</th>
            <th>Tıklanma Sayısı</th>
            <th>İşlem</th>
            
      </tr>";

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $main_urll = $row["main_url"];
        $shortened_url = $row["short_url"];
        $create = $row["create_date"];
        $expire = $row["expire_date"];
        $counter_url = $row["counter_url"];


        $url_parts = explode('/', $shortened_url);
        $short_url = end($url_parts);
        $short_url_parts = explode('.', $short_url);
        $short_code = $short_url_parts[0];
        $file_name = $short_code.".php";

        $current_date = date('Y-m-d');






        echo '<tr> 
                  <td>'.$main_urll.'</td> 
                  <td>
                  <a href="'.$main_urll.'">
                  
                  '.$shortened_url.'
                  
                  </a>
                  </td>
                  <td>'.$create.'</td> 
                  <td>'.$expire.'</td> 
                  <td>'.$counter_url.'</td>
                  <td>
                  <form method="post" action="delete.php">
                  <input type="hidden" name="id" value="' . $shortened_url . '">
                  <input type="submit" value="Sil">
                  </form>
                  </td>
              </tr>';

    }
}

echo "</table>";




?>