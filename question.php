<!DOCTYPE html>
<html>
<head>
	<title>Question</title>
	<link rel="stylesheet" type="text/css" href="./style/question-box.css">
	
</head>
<body>
	<div class="question-box">
<?php 
	session_start();
	$_SESSION['questionId'] = $_GET['id'];
	require "database/config.php";
	if($_SESSION['login'] == false) {
		echo "<script>
				window.location.href='login.php';
			  </script>";
    			exit;
	}
		// print_r($_SESSION);
	$_SESSION['login'] = true;
	// $quer = "SELECT * FROM problems";
	$sql = mysqli_query($con,"SELECT * FROM problems where id='".$_GET['id']."'");
	($row = mysqli_fetch_assoc($sql)) ;
		// 0 = problem statement
		// 1 = input format, 2 = output format, 3 = examp input , 4 example output 
		$ques = unserialize(base64_decode($row['question']));
		$expectedOutput = $row['expectedOutput'];
		$customInput = $row['generatedInput'];

 ?>
 		<h1><?php echo $row['name']; ?></h1>
		<div class="question-box-problem">
			<blockquote>Welcome! This is a tutorial problem to help you solve a problem on AshCode.</blockquote>
			<h2>Problem Statement</h2>
			<p><?php  echo($ques[0]) ?></p>
		</div>

		<hr/>
		<div class="question-box-input">
			<blockquote>This section tells you the format in which your program should receive the input.</blockquote>
			<h2>Input</h2>
			<p><?php echo $ques[1] ?></p>
		</div>

		<hr/>
		<div class="question-box-output">
			<blockquote>This section tells us the format in which our program should give the output
			</blockquote>
			<h2>Output</h2>
			<p><?php echo $ques[2] ?></p>
		</div>

		<hr/>
		<div class="question-box-example">
			<h2>Example</h2>
			<blockquote>In this section example of input and output are given in the expected format.</blockquote>
			<pre><h3>Input
<?php print_r( $ques[3] )?>
			</h3></pre>
			<pre><h3>Output
<?php print_r( $ques[4] )?>
			</h3></pre>
		</div>

	</div>
	
	<div class="code-panel"> 
		<?php $tempYash = "this is me yash"; ?>
		<?php  require("code-panel.php") ?>
	</div>
</body>
</html>