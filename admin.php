
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
        <li><a href="admin_userlist.php">Kullanıcılar</a></li>
        <li><a href="admin.php"><?php     session_start(); echo $_SESSION["mail"] ?></a></li>
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


Kullanıcı Mailine Göre Listele:<form method="get"><select id="auth_mail_list" name="auth_mail_list">
        <?php
        include "vt.php";

        // Connect to the database
        $conn = mysqli_connect('localhost', 'root', '413508', 'urlshortener');

        // Check for errors
        if (mysqli_connect_errno()) {
            die('Failed to connect to MySQL: ' . mysqli_connect_error());
        }

        // Select all rows from the 'url' table
        $result = mysqli_query($conn, 'SELECT DISTINCT auth_mail FROM url');

        // Loop through the result set
        while ($row = mysqli_fetch_array($result)) {
            // Extract the 'auth_mail' value from each row
            $auth_mail = $row['auth_mail'];

            // Output the 'auth_mail' value as an option in the select element
            echo '<option value="' . $auth_mail . '">' . $auth_mail . '</option>';
        }

        // Free the result set
        mysqli_free_result($result);

        // Close the connection
        mysqli_close($conn);
        ?>
    </select><input type="submit" formmethod="post" value="Listele"></form>
<?php

if($_POST)
{
    $auth_mail_list = $_POST['auth_mail_list'];
    $query = "SELECT * FROM url WHERE auth_mail = '$auth_mail_list'";
    $result = mysqli_query($baglanti, $query);


// HTML tablosu oluştur
    echo "<table id='customers'>";
    echo "<tr>
            <th>Oluşturan Kişi</th>
            <th>Link</th>
            <th>Kısaltılmış Link</th>
            <th>Oluşturulma Tarihi</th>
            <th>Son Kullanma Tarihi</th>
            <th>Tıklanma Sayısı</th>
            <th>İşlem</th>
            
      </tr>";


    if ($result = $baglanti->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $authmail_1 = $row["auth_mail"];
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
                  <td>'.$authmail_1.'</td> 
                  <td>'.$main_urll.'</td> 
                  <td>'.$shortened_url.'</td>
                  <td>'.$create.'</td> 
                  <td>'.$expire.'</td> 
                  <td>'.$counter_url.'</td>
                  <td>
                  <form method="post" action="delete.php">
                  <input type="hidden" name="id" value="' . $shortened_url . '">
                  <form method="post" action="delete.php">
                  <input type="hidden" name="id" value="' . $shortened_url . '">
                  <input type="submit" value="Sil">
                  </form>                  </form>
                  </td>
              </tr>';

        }
    }
// Connect to the database
    $mysqli = new mysqli("localhost", "root", "413508", "urlshortener");

// Check for errors
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }


    ?>


    <?php

    if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "6666") {



    }
    else{
        header("location: adminlogin.php");

    }



}
else
{
    $query = "SELECT * FROM url";
    $result = mysqli_query($baglanti, $query);


// HTML tablosu oluştur
    echo "<table id='customers'>";
    echo "<tr>
            <th>Oluşturan Kişi</th>
            <th>Link</th>
            <th>Kısaltılmış Link</th>
            <th>Oluşturulma Tarihi</th>
            <th>Son Kullanma Tarihi</th>
            <th>Tıklanma Sayısı</th>
            <th>İşlem</th>
            
      </tr>";


    if ($result = $baglanti->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $authmail_1 = $row["auth_mail"];
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
                  <td>'.$authmail_1.'</td> 
                  <td>'.$main_urll.'</td> 
                  <td>'.$shortened_url.'</td>
                  <td>'.$create.'</td> 
                  <td>'.$expire.'</td> 
                  <td>'.$counter_url.'</td>
                  <td>
                  <form method="post" action="delete.php">
                  <input type="hidden" name="id" value="' . $shortened_url . '">
                  <form method="post" action="delete.php">
                  <input type="hidden" name="id" value="' . $shortened_url . '">
                  <input type="submit" value="Sil">
                  </form>                  </form>
                  </td>
              </tr>';

        }
}
// Connect to the database
$mysqli = new mysqli("localhost", "root", "413508", "urlshortener");

// Check for errors
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


?>


<?php

if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "6666") {



}
else{
    header("location: adminlogin.php");

}




}
$baglanti->close();
echo "</table>";

?>



