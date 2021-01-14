<?php
require 'functions.php';
//koneksi ke MySQL
$link=mysqli_connect('localhost','tentangk_edel','siewlede12345','tentangk_edel');
//jika tombol login diklik
// if(isset($_POST['login'])) {
//     $user=$_POST['username'];
//     $pass=$_POST['password'];
// //memeriksa apakah username dan password yang dimasukkan ada di
// //tabel login
//     $q=mysqli_query($link,"SELECT user FROM login WHERE user='$user'
//     AND pass=('$pass')");
// //memeriksa hasil dari query, keluarannya adalah integer 0
// // apabila tidak ditemukan data
//     $j=mysqli_num_rows($q);
//     //jika tidak ditemukan data maka muncul peringatan
//     if(empty($j)) {
//     echo "<div class='alert alert-danger'>Cek username dan password anda</div>";
// } else {
// //jika data ditemukan maka inisialisasi session dimulai
//     session_start();
//     $_SESSION['username']=$user;
// //diarahkan ke halaman login secara otomatis
//     header('location:kandang.php');
//     }
// }
session_start();
//ada session ga, user udh login ato belum
// if (!isset($_SESSION["login"])) {
//     header("Location: index.php");
//     exit;
// }

if(isset($_POST["login"])){
    //menangkap data uname dan passw
    $username = $_POST["username"];
    $password = $_POST["password"];

    //mengecek ada uname atau ga di database
    $result = mysqli_query($link, "SELECT * FROM login WHERE user = '$username' && id_grup='Peternak'" );
    $result1 = mysqli_query($link, "SELECT * FROM login WHERE user = '$username' && id_grup='Pembeli'" );
    //cek unamenya
    if (mysqli_num_rows($result)=== 1 ){ //mengetahui ada brp baris yg dikembalikan dari query result, =1 brati ada
        //cek passw
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["pass"])){
            header("Location: kandang.php");
            exit;
        }
    } else if (mysqli_num_rows($result1)=== 1){
		//cek passw
        $row = mysqli_fetch_assoc($result1);
        if (password_verify($password, $row["pass"])){
            header("Location: shop.php");
            exit;
        }
	
	}


    $error=true;


}




?>

<!DOCTYPE html>
<html>
<head>
	<title>SISFO</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="step" src="img/step.png">
	<div class="container">
		<div class="img">
			<img src="img/transaction.svg">
		</div>
		<div class="login-content">
			<form action="" method="post">
				<h2 class="title">Sisfo Peternakan Ayam <div class="i"><i class="fab fa-the-red-yeti"></i></div></h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>tentangkitea/beli</h5>
           		   		<input type="text" class="input" name="username">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>123/beli</h5>
           		    	<input type="password" class="input" name="password">
            	   </div>
            	</div>
            	<a href="register.php">Don't have an account?</a>
            	<input type="submit" class="btn" value="Login" name="login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>