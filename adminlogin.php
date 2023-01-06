<!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_login_form'dan örnek log-in sayfası alınmıştır. -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Girişi</title>

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
        <li><a href="index.php">Admin</a></li>
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


<center><h2>Admin Girişi</h2></center>

<form method="post">


    <div class="container">

        <label for="uname"><b>Kullanıcı Adı:</b></label>
        <input type="text" placeholder="Kullanıcı adını girin" name="uname" id="uname" >

        <label for="psw"><b>Parola</b></label>
        <input type="password" placeholder="Parola girin" name="psw" id="psw">
        <button type="submit">Giriş Yap</button>

    </div>

    <div class="container" style="background-color:#f1f1f1">
    </div>
</form>


<?php



if($_POST)
{
    include 'vt.php';

// Start the session
    session_start();

    $mail = $_REQUEST['uname'];
    $password = $_REQUEST['psw'];
    $password = md5($password);

    $query = "SELECT * FROM admin WHERE admin_mail='$mail' AND admin_pass='$password'";
    $result = mysqli_query($baglanti, $query);
    if (mysqli_num_rows($result) > 0) {

        $_SESSION["Oturum"] = "6666"; //oturum oluşturma
        $_SESSION["mail"] = "$mail";

        header("location: admin.php");
    }
    else{
        echo "Yanlış Parola";
    }
}

?>

</body>
</html>
