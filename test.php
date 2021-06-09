<?php
	session_start();
	require "database/config.php";
	$id = $_POST['hiddenId'];
	$points = $_POST['hiddenPoints']*1-0;
	$userId = $_SESSION['userId'];
	echo $id." ".$points;
	$arr = (($_SESSION['solved']));
	if(!in_array($id, $arr)) {
		$_SESSION['score'] += $points;
		$quer = "UPDATE `userstable` SET `score` = score + $points WHERE `userstable`.`id` = '$userId';";
		$sql = mysqli_query($con,$quer) ;
		if(!$sql) {
			die("Invalid query ");
		}
		array_push($_SESSION['solved'], $id);
		$newSolved = base64_encode(serialize($_SESSION['solved']));
		$quer = "UPDATE `userstable` SET `solved` = '$newSolved' WHERE `userstable`.`id` = '$userId';";
		$sql = mysqli_query($con,$quer) ;
		if(!$sql) {
			die("Invalid query ");
		}
		header("Location:index.php");
	}

?>


