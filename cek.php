<!-- cek apakah sudah login -->
	<?php
	session_start();
	if(empty($_SESSION['username']) || $_SESSION['username'] == '' || !isset($_SESSION['username'])){
		header("location:login.php");
	};
	?>