<?php 
	session_start();
	// print_r($_SESSION);
	$_SESSION['login'] = false;
	require "database/config.php";
	if(isset($_POST["submit"])) {
		$email = $_POST["email"];
		$password = $_POST["password"];
		if($email != "" && $password != "") {
			$quer = "SELECT * FROM `userstable` where email = '$email' AND password = '$password'";
			$sql = mysqli_query($con , $quer);
			
			if(mysqli_num_rows($sql) == 1) {
				$row = mysqli_fetch_assoc($sql);

				$_SESSION['login'] = true;
				$_SESSION['userName'] = $row['username'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['score'] = $row['score'];
				$_SESSION['solved'] = unserialize(base64_decode($row['solved']));
				$_SESSION['userId'] = $row['id'];

				echo "<center>Proceding to index.php</center>";
				
				 echo "
				 <script>
				 	setTimeout(function() {
				 		window.location.href='index.php';
				 		},1000);
				 </script>";
    			exit;

    			
			}
		}
	}	
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<title>User Login</title>
	<link rel="stylesheet" type="text/css" href="style/login-style.css">
</head>
<body>
	<div class="login-box">
	  <h2>Login</h2>
	  <form id="myform" method="POST">
	    <div class="user-box">
	      <input type="email" name="email" required="">
	      <label>Email</label>
	    </div>
	    <div class="user-box">
	      <input type="password" name="password" required="">
	      <label>Password</label>
	    </div>

	    <input type="submit" name="submit" value="🔐Login" class="btn">
	   <!--  <a href="#" onclick="document.getElementById('myform').submit()">
	      <span></span>
	      <span></span>
	      <span></span>
	      <span></span>
	      🔐Login
	    </a> -->
	    <a href="register.php">🧾Register</a>
	  </form>
</div>
</body>
</html>