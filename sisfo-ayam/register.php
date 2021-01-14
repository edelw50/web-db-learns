<?php 
$link=mysqli_connect('localhost','tentangk_edel','siewlede12345','tentangk_edel');
require 'functions.php';

//jika tombol register sudah ditekan 
if(isset ($_POST["register"])){
    if (registrasi ($_POST)>0){
        echo "<div class=alert alert-success alert-dismissible role=alert>
              <button type=button class=close data-dismiss=alert aria-label=Close><span aria-hidden=true>&times;</span></button>
              <strong>Selamat!</strong> Registrasi berhasil.
              </div>
        ";
    } else {
        echo mysqli_error ($link);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="css/style2.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	
	<div class="container">
        <img class="form" src="img/form.png">
		<div class="img">
            <img src="img/document.png">
		</div>
		<div class="login-content">
			<form action="" method="post">
                <h3 class="title">Daftar menjadi anggota</h3>
                <h1><div class="i"><i class="fab fa-the-red-yeti"></i></div></h1>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input" name="username">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" name="password">
            	   </div>
                </div>
                <div class="input-div opsi">
           		   <div class="i">
                      <i class="fas fa-mouse-pointer"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Peternak/Pembeli</h5>
           		   		<input type="text" class="input" name="opsi">
           		   </div>
                </div>
                <div class="input-div nama">
           		   <div class="i">
                       <i class="fas fa-font"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Nama lengkap</h5>
           		   		<input type="text" class="input" name="nama">
           		   </div>
                </div>
                <div class="input-div alamat">
           		   <div class="i">
           		   	    <i class="fas fa-home"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Alamat</h5>
           		   		<input type="text" class="input" name="alamat">
           		   </div>
                </div>
                <div class="input-div kota">
           		   <div class="i">
           		   		<i class="fas fa-city"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Kota</h5>
           		   		<input type="text" class="input" name="kota">
           		   </div>
           		</div>
                <div class="input-div tlp">
           		   <div class="i">
           		   		<i class="fas fa-phone"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>No.Telepon</h5>
           		   		<input type="text" class="input" name="telepon">
           		   </div>
                </div>
                <div class="input-div email">
           		   <div class="i">
           		   		<i class="fas fa-envelope-open-text"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Email</h5>
           		   		<input type="text" class="input" name="email">
           		   </div>
           		</div>

            	<a href="index.php">Login?</a>
            	<input type="submit" class="btn" value="Register" name="register">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>