<?php 
	session_start();
	require "database/config.php";
	// print_r($_SESSION);
	if($_SESSION['login'] == false) {
		// echo "<script>
		// 		window.location.href='login.php';
		// 	  </script>";
  //   			exit;
		header("Location:login.php");
	}
	$quer = "SELECT * FROM problems";
	$sql = mysqli_query($con,"SELECT * FROM problems");
	$flag = 0;
	$qno = 1;
 ?>	

<!DOCTYPE html>
<html>
<head>
	<title>My Project</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="style-index.css">
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css"> -->
            
</head>
<body>	
	<?php include "header.php" ?>
	<div class="container">
		<div class="list-card" style="background: #677ce7;text-align: center; color:white;">
			<div class="list-card-top">
				<h2>User Name : <?php echo "<span>".$_SESSION['userName']."</span>"; ?></h2>
				<h3><?php echo "Solved : <span>".(count($_SESSION['solved'])-1)."</span>\t Score : <span>".$_SESSION['score']."</span>";?></h3>
			</div>
		</div>
			<?php while($row = mysqli_fetch_assoc($sql)) {  ?>
			<div class="list-card <?php if(in_array($row['id'], $_SESSION['solved'])) {echo "solved";$flag=1;} ?>">
				<div class="list-card-top">
					<h2><span><?php echo $qno++; ?></span> <?php echo $row['name']; ?>  </h2>
					<p><pre><?php echo $row['difficulty'].", Max Points ". $row['points']?></pre></p>
				</div>
				<?php if($flag == 1) echo "<span class='tick'>✅</span>"; $flag = 0; ?>
				<a href="question.php?id=<?php echo $row['id']?>" class="btn">Solve challange</a>
			</div>
		<?php } ?>
	</div>

	<footer>
		<p>Made with<span>❤</span>in India. Powered by 
		<a href="http://www.instagram.com" target="_blank">Yash.</a>
		 Copyright &copy; 2021.</p>
	</footer>
</body>
</html>