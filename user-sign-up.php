<!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_login_form'dan örnek log-in sayfası alınmıştır. -->

<!DOCTYPE html>
<html>
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
        <li><a href="login.php">Giriş Yap</a></li>
    </ul>
</nav>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        form {border: 3px solid #f1f1f1;}

        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }


         body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
        .myLink {display: none}


        button {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
            .cancelbtn {
                width: 100%;
            }
        }
    </style>
</head>
<body>


<center><h2>Kayıt Ol</h2></center>


<div class="container">

    <form method="post">
        <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Ad" required name="uname_name" id="uname_name"></p>
        <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Soyad" required name="uname_surname" id="uname_surname"></p>

        <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Email" required name="uname" id="uname"></p>
        <p><input class="w3-input w3-padding-16 w3-border" type="password" placeholder="Parola" required name="psw" id="psw"></p>
        <p><button class="w3-button w3-black w3-padding-large" type="submit">Kayıt Ol</button></p>
    </form>

</div>

<?php



if($_POST)
{
    include 'vt.php';

    $mail = $_REQUEST['uname'];
    $password = $_REQUEST['psw'];
    $name = $_REQUEST['uname_name'];
    $s_name = $_REQUEST['uname_surname'];
    $password = md5($password);


    $query = "INSERT INTO user (user_name, user_s_name, user_mail, user_pass) VALUES ('$name','$s_name','$mail','$password')";


    if ($baglanti->query($query) === TRUE) {

        echo '<script> alert("Yeni Kayıt oluşturuldu");</script>';

    } else {
        echo "Error: " . $query . "<br>" . $baglanti->error;
    }
}

?>

</body>
</html>
