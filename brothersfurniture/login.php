<?php
	error_reporting(0);
	session_start();
	require_once("db.php");

	if(isset($_POST['submit'])){
		$name = $_POST['uname'];
		$pass = md5($_POST['pass']);

		$query = "select * from user where uname='{$name}' and password='{$pass}'";
		$result = mysqli_query($db_con, $query);
		if(mysqli_num_rows($result) == 1){
			$_SESSION['name'] = $name;
			if($name == "admin"){
				$_SESSION['type']="admin";
			}
			header('Location: manage.php');
		}
		else{
			$err = "Invalid username or password";
		}
	}
?>




<!DOCTYPE html>

<html>
	<head>
		<title>Login</title>

		<link rel="stylesheet" type="text/css" href="style_login.css">
	</head>





	<body>


		<div class="whole">
			<header>
				<a class="head_anchor" href="index.html">
					<h1>brothers furniture</h1>
				</a>
			</header>
			

			<div class="navigation">
				<ul>
					<a href="index.html" class="first_nav">	<li>HOME</li>		</a>
					<a href="products.php">					<li>PRODUCTS</li>	</a>
					<a href="showrooms.php">				<li>SHOWROOMS</li>	</a>
					<a href="login.php" class="last_nav">	<li>LOG IN</li>		</a>
				</ul>
			</div>

			<div class="content">
				<form action="login.php" method="post">
					<?php echo $err; ?>
					<br /><br />
					<label>User name:</label>
					<input type="text" name="uname" id="uname">
					<br />
					<br />
					<label>Password:</label>
					<input type="password" name="pass" id="pass">
					<br />
					<br />
					<input type="submit" value="Login" name="submit">
				</form>
			</div>

			
		</div>


	</body>
</html>