
<?php

	session_start();
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	$koneksi = new mysqli("localhost","root","","inventori");
	?>	

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistem Inventaris Barang</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom fonts for this template-->
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<style>
		body {
			background-color: rgb(34, 61, 108); /* For browsers that do not support gradients */
  			background-image: linear-gradient(to top, rgb(34, 61, 108), rgb(50, 61, 108));
			background-repeat:no-repeat;
			background-size:contain;  
			display:flex; 
			flex-direction:column; 
			justify-content:center;
  			min-height:100vh;
			padding: 0px 20px 0px 20px;
			overflow:hidden
	    }
		.login {
			display:flex;
			flex-direction: row;
			justify-content:space-around;
			border-radius:5px;
			padding:10px;
			box-shadow: white 0px 22px 70px 4px;
			background-color: rgb(34, 61, 106);
			animation: fade-in 1s ease-out;
			animation-iteration-count: 1;
		}
		.login-img{
			flex:1;
			border-radius:5px;
			position: relative;
			animation: fade-in-up 2s ease-out;
			animation-iteration-count: 1;
		}
		
		.login-form{
			flex:1;
			display:flex;
			flex-direction: column;
			justify-content:center;
			align-items:center;
			border:1px solid white;
			width:100%;
			margin-top:20px;
			margin-bottom:20px;
			padding:10px 0px 10px 0px;
			position: relative;
			animation: fade-in-down 2s ease-out;
			animation-iteration-count: 1;
		}

		@keyframes fade-in {
			from {opacity: 0}
			to {opacity:1}
		}

		@keyframes fade-in-down {
			from {top: -500px;}
			to {top: 0px;}
		}

		@keyframes fade-in-up {
			from {bottom: -500px;}
			to {bottom: 0px;}
		}

		@keyframes fade-in-right {
			from {left: -500px;}
			to {left: 0px;}
		}

		@keyframes fade-in-left {
			from {right: -500px;}
			to {right: 0px;}
		}

		.login-title{
			margin-bottom:5px
		}
		.login-subtitle{
			margin-bottom:30px
		}
		@media only screen and (max-width:1200px) {
			body {
				background-color:white;
				padding:10px;
	    	}
			.login {
				display:flex;
				flex-direction: column-reverse;
			}
			.login-form{
				border:0px;
				margin-top:30px;
			}
		}

		.copyright{
			text-align:right;
			color:white;
			font-size:13px;
			font-style:italic
		}

		hr{
			background-color:white;
			border:0.5px solid white;
			margin-top:20px
		}
		.form-control::placeholder {
			color:lightgrey;
		}

	</style>
</head>
<body>
	<div class="login">
		<image src="img/login-background.jpeg" class="login-img" >
		<div class="login-form text-center">
			<form role="form" action="" method="post" >
			<h4 class="text-white login-title"> Sistem Inventaris Barang</h4>
			<h6 class="text-white login-subtitle"> Isi form di bawah ini untuk login</h6>
			
				<div class="form-group">
					<div class="input-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text bg-light"><i class="fa fa-user"></i></span>
					</div>
						<input type="text" name="username"  class="form-control bg-transparent text-white" placeholder="Masukan Username" required autofocus />
					</div>
				</div>

				<div class="form-group">
					<div class="input-group input-group">
					<div class="input-group-prepend">
						<span class="input-group-text bg-white"><i class="fa fa-key"></i></span>
					</div>
						<input type="password" name="password"  class="form-control bg-transparent text-white " placeholder="Masukan Password" required  />
					</div>
				</div>
				
				<div class="form-group">
					<input type="submit" name="login" class="btn btn-block text-white border border-white" value="Login" />
					
				</div>
				<hr/>
				<span class="copyright" >
					&copy 2022 Imarah Printing & Advertising
				</span>
			</form>
		</div>
		
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>

	<?php
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$login = $_POST['login'];
	//$level = $_POST['level'];
	
	if ($login) {
		$sql = $koneksi->query("select * from users where username='$username' and password='$password'");
		$ketemu = $sql->num_rows;
		$data = $sql->fetch_assoc();
		
		if ($ketemu >=1) {
			session_start();
			$_SESSION['id'] =$data['id'];
			header("location:index.php?page=home");
		}
		else {
			echo '<center><div class="alert alert-danger">Upss...!!! Login gagal. Silakan Coba Kembali</div></center>';
		
		}
	}
	
?>
			