<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		a{
			text-decoration: none;
		}
		.navbar {
			display: flex;
			align-items: center;
			text-transform: capitalize;
			justify-content: space-around;
			width: auto;
			height: 3em;
			/*background: #6c7effd1;*/
			color: white;
			font-size: 1.5em;
			background: #396afc;  
			background: -webkit-linear-gradient(to left, #2948ff, #396afc); 
			background: linear-gradient(to left, #2948ff, #396afc);
/*background: linear-gradient(to left, #dd004a, #396afc);*/
			/*border-top: 5px dotted white;*/
			border-bottom: 5px solid lightgreen;
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
	</style>
</head>
<body>
	<nav class="navbar">
		<div>
			<!-- <a href="#"> 👦🏻 <span>Solved : 1 Score : 10</span></a> -->
			<p>👦🏻<?php echo $_SESSION['email']?><h5>				
			</h5></p>
		</div>
		<div class="title" id="home">CodingLab.io</div>
		<div>
			<a href="editor.php" class="btn edit-btn hv">Open Editor</a>
			<a href="login.php" class="btn login-btn hv" >Logout</a>
		</div>
	</nav>
	<script type="text/javascript">
		let home = document.getElementById("home");
		home.addEventListener("click",()=>{
			// window.location.href = "login.php";
			console.log(window.location.pathname == "/index.php");
		})
	</script>
</body>
</html>