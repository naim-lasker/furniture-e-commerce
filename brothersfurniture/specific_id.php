<?php
	require_once("db.php");
	$query = "select * from product where id={$_GET['id']}";
	$result = mysqli_query($db_con, $query);
?>



<!DOCTYPE html>

<html>
	<head>
		<title>Brothers Furniture</title>

		<link rel="stylesheet" type="text/css" href="style_specific_id.css">
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

			<?php if($row = mysqli_fetch_assoc($result)){ ?>
				<img src="img/<?php echo $row["id"] ?>">	
				<h2><?php echo $row["name"] ?></h2>
				<p>
					Product ID: <?php echo $row["id"] ?><br />
					Price: <?php echo $row["price"] ?> Tk.
				</p>
			<?php }
			else
				echo "This product does not exist or may be removed.";
			?>

			</div>

			
		</div>


	</body>
</html>
