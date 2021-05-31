<?php 
	// include "config.php";

	// $name = ""


	// $arr1 = array(1,21,32,43,54,65,76);
	// $arr2[] = array("question"=>"Program is very simple, given two integers A and B, write a program to add these two numbers.","input" => "The first line contains an integer T, the total number of test cases. Then follow T lines, each line contains two Integers A and B." , "output"=> "For each test case, add A and B and display it in a new line." , "example"=> "Input 3 1 2 100 200 10 40 Output 3 300 50");
	
	// // print_r($arr2);
	// $a = serialize($arr1);
	// $b = serialize($arr2);
	// // print_r($b);
	
	// $customInput = nl2br("hello\nworld");
	// $sql = "INSERT INTO problems(question,expectedOutput,generatedInput) VALUES('".$a."' ,'".$b."', $customInput)";
	// // mysqli_query($con,$sql); 

	// // $sql = "SELECT * FROM problems";
	// $sql = mysqli_query($con,"SELECT * FROM problems");
	// while ($row = mysqli_fetch_assoc($sql)) {
	//  	$arrY1 = unserialize($row['question']);
	// 	$arrY2 = unserialize($row['expectedOutput']);
		   
	// 	   // Display
	// 	   echo "<pre>";
	// 	   print_r($arrY1);
	// 	   print_r($arrY2);
	// 	   echo "</pre>";
	//  } 
	//  // print_r(($arrY2));
// echo "hello w";
// if(isset($_POST['submit'])) {
// 	// print_r($_POST);
// 	print_r(nl2br($_POST['example_input']));
// 	echo "<pre>";
// 	print_r(($_POST['example_output']));
// 	echo "</pre>";
// 	print_r($_POST["level"]);
// 	print_r($_POST["points"]);
// }
// echo $_POST['problem_name'];

?>


<?php 
	require "config.php";
	if(isset($_POST["submit"])) {
		// echo "Submision Started";

		$name = $_POST['problem_name'];
		$difficulty = $_POST['level'];
		$points = $_POST["points"];
		$fullQuestion = array(
			$_POST["problem_description"], 
			$_POST['input_format'], 
			$_POST["output_format"], 
			nl2br($_POST["example_input"],false), 
			nl2br($_POST["example_output"],false), 
		);
		$expectedOutput =  nl2br($_POST["expected_output"],false);
		$generatedInput = nl2br($_POST["expected_input"],false);



		$question = base64_encode(serialize($fullQuestion));
		// print_r($question);
		// $question = json_encode($fullQuestion);

		$quer = "INSERT INTO `problems` (`name`, `difficulty`, `points`, `question`, `expectedOutput`, `generatedInput`) VALUES ('".$name."','".$difficulty."','".$points."','".$question."','".$expectedOutput."','".$generatedInput."')";
		$sqlRun = mysqli_query($con,$quer);
		if(!$sqlRun) {
			die("Invalid query ");
		}
	}

 ?>

 <body>
 	<?php $aaa = nl2br("hello\r\nworld this\r\nis me yash",false);?>

 	<textarea id="disp"><?php echo str_replace("<br>","",$fullQuestion[3]); ?></textarea>
 	 	
 </body>
 <script type="text/javascript">
 	let disp = document.getElementById("disp");
 </script>


