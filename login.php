<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Warung ABC</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', Arial, sans-serif;
}


body{

    height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    background:
    linear-gradient(
        135deg,
        #1b5e20,
        #4caf50,
        #a5d6a7
    );

    overflow:hidden;

}



/* Background Effect */

body::before{

    content:"";

    position:absolute;

    width:400px;
    height:400px;

    background:rgba(255,255,255,.15);

    border-radius:50%;

    top:-100px;
    left:-100px;

}



body::after{

    content:"";

    position:absolute;

    width:350px;
    height:350px;

    background:rgba(255,255,255,.1);

    border-radius:50%;

    bottom:-100px;
    right:-80px;

}




/* LOGIN CARD */

.login-box{

    width:390px;

    padding:40px;

    background:
    rgba(255,255,255,.95);

    border-radius:25px;

    box-shadow:
    0 20px 40px rgba(0,0,0,.25);

    position:relative;

    z-index:1;

    animation:
    muncul .7s ease;

}



@keyframes muncul{

    from{

        opacity:0;

        transform:
        translateY(40px);

    }

    to{

        opacity:1;

        transform:
        translateY(0);

    }

}



/* TITLE */


.logo{

    text-align:center;

    font-size:55px;

    margin-bottom:10px;

}



h1{

    text-align:center;

    color:#1b5e20;

    font-size:26px;

    margin-bottom:30px;

}



.subtitle{

    text-align:center;

    color:#777;

    margin-top:-20px;

    margin-bottom:25px;

}




/* ERROR */


.error{

    background:#ffebee;

    color:#c62828;

    padding:12px;

    border-radius:10px;

    text-align:center;

    margin-bottom:20px;

    font-size:14px;

}



/* FORM */


label{

    color:#333;

    font-weight:600;

}



input[type="text"],
input[type="password"]{

    width:100%;

    padding:14px 15px;

    margin-top:8px;

    margin-bottom:18px;

    border:

    2px solid #ddd;

    border-radius:12px;

    font-size:15px;

    transition:.3s;

}



input[type="text"]:focus,
input[type="password"]:focus{

    border-color:#4caf50;

    outline:none;

    box-shadow:
    0 0 10px rgba(76,175,80,.4);

}




/* BUTTON */


input[type="submit"]{

    width:100%;

    padding:14px;

    border:none;

    border-radius:30px;

    background:

    linear-gradient(
        135deg,
        #2e7d32,
        #4caf50
    );

    color:white;

    font-size:17px;

    font-weight:bold;

    cursor:pointer;

    transition:.3s;

}



input[type="submit"]:hover{

    transform:
    translateY(-3px);

    box-shadow:
    0 10px 20px rgba(76,175,80,.4);

}





/* FOOTER */

.footer{

    text-align:center;

    margin-top:25px;

    color:#777;

    font-size:13px;

}




@media(max-width:450px){

    .login-box{

        width:90%;

        padding:30px;

    }

}


</style>

</head>


<body>


<div class="login-box">


<div class="logo">
    🏪
</div>


<h1>
Login Warung ABC
</h1>


<p class="subtitle">
Aplikasi Kasir Modern
</p>



<?php

session_start();

if(isset($_SESSION['pesan_error'])){

    echo '<div class="error">
    '.$_SESSION['pesan_error'].'
    </div>';

    unset($_SESSION['pesan_error']);

}

?>



<form action="proses_login.php" method="POST">


<label>
Username
</label>

<input 
type="text"
name="username"
placeholder="Masukkan username"
required>



<label>
Password
</label>

<input 
type="password"
name="password"
placeholder="Masukkan password"
required>



<input 
type="submit"
value="🔐 Login">



</form>



<div class="footer">

© <?php echo date("Y"); ?> Warung ABC

</div>



</div>


</body>
</html>