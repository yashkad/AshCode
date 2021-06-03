<?php 
	require "database/config.php";
	if(isset($_POST['submit'])) {
		$email =  $_POST['u_email'];
		$name = $_POST['u_name'];
		$pass1 = $_POST['u_pass1'];
		$pass2 = $_POST['u_pass2'];

		$arr = array(1);
    	$solved = base64_encode(serialize($arr));


		if(strcmp($pass1,$pass2) == 0 && $pass1!="" && $email != "" && $name != "")  {

			$quer = "SELECT * FROM `userstable` WHERE email = '$email'";
			$result = mysqli_query($con,$quer);

			if( mysqli_num_rows($result) > 0) {
				echo "email already registered";
			}
			else {
				$quer = "INSERT INTO `userstable` (`id`, `username`, `password`, `email`, `score`, `solved`) VALUES (NULL, '".$name."', '".$pass1."', '".$email."', '0', '.$solved.');";
				$sql = mysqli_query($con,$quer);
				if($sql) {
					echo "
	<script>alert('Account created');</script>";
					header("Location:login.php");
				};
			}
		}
		else {
			echo "Password do not match";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<title>User SignUp</title>
	<link rel="stylesheet" type="text/css" href="style/login-style.css">
</head>
<body>
	<div class="login-box">
	  <h2>Register</h2>
	  <form method="POST" id="myform">
	    <div class="user-box">
	      <input type="email" name="u_email" required/>
	      <label>Email</label>
	    </div>
	    <div class="user-box">
	      <input type="text" name="u_name" required/>
	      <label>Name</label>
	    </div>
	    <div class="user-box">
	      <input type="password" name="u_pass1" required/>
	      <label>Create Password</label>
	    </div>
	    <div class="user-box">
	      <input type="password" name="u_pass2" required/>
	      <label>Confirm Password</label>
	    </div>
<input type="submit" name="submit" class="btn" value="✅Register">
	   <!--  <a href="#" onclick="document.getElementById('myform').submit();" name="submit">
	      <span></span>
	      <span></span>
	      <span></span>
	      <span></span>
	      ✅Register
	    </a> -->
	    <a href="login.php">⏮back</a>
	  </form>
</div>
</body>
</html>