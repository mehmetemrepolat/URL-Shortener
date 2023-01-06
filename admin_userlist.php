
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


<?php
include "vt.php";


    $query = "SELECT * FROM user";
    $result = mysqli_query($baglanti, $query);


// HTML tablosu oluştur
    echo "<table id='customers'>";
    echo "<tr>
            <th>Ad</th>
            <th>Soy Ad</th>
            <th>Mail</th>
            <th>Sil</th>
           
      </tr>";


    if ($result = $baglanti->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $authmail_1 = $row["user_name"];
            $main_urll = $row["user_s_name"];
            $shortened_url = $row["user_mail"];




            echo '<tr> 
                  <td>'.$authmail_1.'</td> 
                  <td>'.$main_urll.'</td> 
                  <td>'.$shortened_url.'</td>
                  <td>
                  <form method="post" action="delete_user.php">
                  <input type="hidden" name="id1" value="' . $shortened_url . '">
                  <input type="submit" value="Sil">
                  </form>                  </form>
                  </td>
              </tr>';

        }
    }

    ?>


    <?php







$baglanti->close();
echo "</table>";

?>



