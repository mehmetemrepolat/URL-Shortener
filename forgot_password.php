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
        <li><a href="user-sign-up.php">Kayıt Ol</a></li>
    </ul>
    <ul>
        <li><a href="index.php">Ana Sayfa</a></li>
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


<center><h2>Parolamı Unuttum</h2></center>

<form method="post">


    <div class="container">

        <label for="uname"><b>Kullanıcı Adı/Mail Giriniz:</b></label>
        <input type="text" placeholder="Kullanıcı Adı/Mail" name="uname" id="uname" >

        <label for="psw"><b>Yeni Parola</b></label>
        <input type="password" placeholder="Parola girin" name="psw" id="psw">
        <label for="psw"><b>Yeni Parola Tekrar</b></label>
        <input type="password" placeholder="Yeni Parolanızı Doğrulayın" name="psw_c" id="psw_c">
        <button type="submit">Parolamı değiştir.</button>

    </div>





    <div class="container" style="background-color:#f1f1f1">
    </div>





</form>


<?php



if($_POST)
{
    include 'vt.php';


    $mail = $_REQUEST['uname'];
    $password = $_REQUEST['psw'];
    $psw_c = $_REQUEST['psw_c'];


    if($password == $psw_c) //Girilen parolalar eş mi kontrol?
    {

        $psw_c = md5($psw_c);
        $queryUpdate = "UPDATE user SET user_pass ='".$psw_c."' WHERE user_mail ='".$mail."'";

        if (mysqli_query($baglanti, $queryUpdate)) {
            echo '<script>alert("Parolanız güncellenmiştir")</script>';
            header( "refresh:5;url=login.php" );


        } else {

            echo '<script>alert("Hata gerçekleştir. Lütfen daha sonra tekrar deneyin")</script>';
        }

    }
    else{

        echo '<script>alert("Girdiğiniz parolalar eşleşmiyor")</script>';

        //header("location: forgot_password.php");

    }



}

?>

</body>
</html>
