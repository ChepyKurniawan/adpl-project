<?php
session_start();

include 'dbconnect.php';
	date_default_timezone_set("Asia/Bangkok");
	$timenow = date("j-F-Y-h:i:s A");

	if(isset($_GET['m'])){
			if($_GET['m'] == "g"){
				echo "Username atau Password salah!";
			}else if($_GET['m'] == "l"){
				echo "Anda berhasil keluar dari sistem";
			}else if($_GET['m'] == "bl"){
				echo "Anda harus Login";
			}
	}


	if(isset($_POST['subm']))
	{
	$uname = mysqli_real_escape_string($conn,$_POST['username']);
	$upass = mysqli_real_escape_string($conn,$_POST['password']);
	$queryuser = mysqli_query($conn,"SELECT * FROM login WHERE username='$uname'");
	$cariuser = mysqli_fetch_assoc($queryuser);

 /*
	$login = mysqli_query($conn,"select * from login where username='$uname' and password='$upass';");
	$cek = mysqli_num_rows($login);

		if($cek > 0){
			$data = mysqli_fetch_assoc($login);

				$_SESSION['id'] = $data['id'];
				$_SESSION['log'] = "Logged";
				header('location:index.php');
		}
		else {
				  header("location:login.php?m=g");
		}
*/
		
		
		if( password_verify($upass, $cariuser['password']) ) {
			$_SESSION['id'] = $cariuser['staffid'];
			$_SESSION['username'] = $cariuser['username'];
			$_SESSION['log'] = "Logged";
			$_SESSION['time'] = $timenow;
			header('location:index.php');
		} else {
			header("location:login.php");
		}		
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-b-160 p-t-50">
				<form method="post" class="login100-form validate-form">
					<span class="login100-form-title p-b-43">
						 Irwan Plasindo
					</span>
					
					<div class="wrap-input100 rs1 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="username">
						<span class="label-input100">Username</span>
					</div>
					
					
					<div class="wrap-input100 rs2 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password">
						<span class="label-input100">Password</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="subm" type="submit">
							Masuk
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>

</body>
</html>