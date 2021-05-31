<!DOCTYPE html>
<html>
<head>
	<title>Add Data</title>
	<link rel="stylesheet" type="text/css" href="addQuestion.css">
</head>
<body>
	<section>
		<form action ="manipulation.php" method="post">
			<div class="y-inp">
				<label for="problem_name">Name :</label>
				<input required type="text" name="problem_name" id="problem_name" placeholder="Enter Title of problem" 
				name="problem_name">
			</div>
			<div class="y-inp">
				<label for="problem_description">Problem Description :</label>
				<textarea  placeholder="Enter problem statement here" name="problem_description"></textarea>
			</div>
			<div class="y-inp">
				<label for="input_format">Input format :</label>
				<input required type="text" name="input_format" id="input_format" placeholder="The first line contains an integer T, the total number of testcases. Then follow T lines, each line contains an integer N.">
			</div>
			<div class="y-inp">
				<label for="output_format">Output Format</label>
				<input required type="text" name="output_format" id="output_format" placeholder="Enter OutputFormat of problem">
			</div>
			<h4>Example input output</h4>
			<div class="y-inp" class="whitespace">
				<label for="example_input">Example Input</label>
				<textarea  placeholder="Example Input" name="example_input"></textarea>
			</div>
			<div class="y-inp" class="whitespace">
				<label for="example_output">Example output</label>
				<textarea  placeholder="Example  output" name="example_output"></textarea>
			</div>
			<div class="y-inp" class="whitespace">
				<label for="expected_input">expected Input</label>
				<textarea  placeholder="expected Input" name="expected_input"></textarea>
			</div>
			<div class="y-inp" class="whitespace">
				<label for="expected_output">expected output</label>
				<textarea  placeholder="expected output" name="expected_output"></textarea>
			</div>
			<div class="y-inp">
				<label for="level">Select Difficulty</label>
				<select id="level" name="level">
					<option value="noob">noob</option>
					<option value="easy">easy</option>
					<option value="medium">medium</option>
					<option value="hard">hard</option>

				</select>
			</div>
			<div class="y-inp">
				<label for="points">Select Score</label>
				<select id="points" name="points">
					<option>5</option>
					<option>10</option>
					<option>15</option>
					<option>25</option>

				</select>
			</div>
			<input required type="submit" name="submit" value="Submit">
		</form>
	</section>
</body>
</html>