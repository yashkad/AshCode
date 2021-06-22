<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style/loading.css">
	<style type="text/css">
		a{
			text-decoration: none;
		}
		.navbar {
			display: flex;
			align-items: center;
			text-transform: capitalize;
			justify-content: space-around;
			width: 100%;
			height: 3em;
			/*background: #6c7effd1;*/
			color: white;
			font-size: 1.5em;
			/*background: #396afc;  
			background: -webkit-linear-gradient(to left, #2948ff, #396afc); 
			background: linear-gradient(to left, #2948ff, #396afc);*/
			background: #4caf50;
/*background: linear-gradient(to left, #dd004a, #396afc);*/
			/*border-top: 5px dotted white;*/
			border-bottom: 5px solid lightgreen;
			position: fixed;
			top: 0;
			/*margin-bottom: 10em;*/
		}
		.edit-btn {
			font-size: 15px;
			    background: linear-gradient(to right,#20b7fa,#ca00ffad);
			border-radius: 2em;
    		padding: 0.5em 1rem;
		}
		.login-btn {
			background: mediumvioletred;
    		padding: 0.5em 1rem;
		}
		.hv:hover {
			box-shadow: 5px 5px 25px 10px lightgreen;
		}
		.title{
			color: white;
		}
		/* loading  */
		
	</style>
</head>
<body>
	<nav class="navbar">
		<div>
			<!-- <a href="#"> 👦🏻 <span>Solved : 1 Score : 10</span></a> -->
			<p>👦🏻<?php echo $_SESSION['email']; ?><h5>				
			</h5></p>
		</div>
		<div class="title" id="home">CodingLab.io</div>
		<div>
			<span  class="btn edit-btn hv" id="ideBtn">Online IDE</span>
			<a href="login.php" class="btn login-btn hv" >Logout</a>
		</div>
	</nav>
	<script type="text/javascript">
		let home = document.getElementById("home");
		home.addEventListener("click",()=>{
			// window.location.href = "login.php";
			console.log(window.location.pathname == "/index.php");
		});

		let ideBtn = document.getElementById("ideBtn");
		ideBtn.addEventListener("click",()=>{
			console.log(window.location.href);
			// document.body.innerHTML='<center><h1>Loading..</h1></center>';

			document.body.innerHTML = "<link rel='stylesheet' type='text/css' href='style/loading.css'><div class='lds-roller center'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>";
			setTimeout(()=>{
			window.location.href="editor.php";
			},500)
		});
	</script>
</body>
</html>