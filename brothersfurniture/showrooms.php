<?php
	require_once("db.php");
	$query = "select * from showroom";
	$result = mysqli_query($db_con, $query);
?>




<!DOCTYPE html>

<html>
	<head>
		<title>showrooms</title>

		<link rel="stylesheet" type="text/css" href="style_showrooms.css">
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
				<table>
					<tr>
						<th>Showroom Id</th>
						<th>District</th>
						<th>Location</th>
						<th>Contact No.</th>
					</tr>

					<?php
						while ($row = mysqli_fetch_assoc($result)) {
								?>
								<tr>
									<td><?php echo $row["s_id"]; ?></td>
									<td><?php echo $row["district"]; ?></td>
									<td><?php echo $row["location"]; ?></td>
									<td><?php echo "0". $row["contact_no"]; ?></td>
								</tr>
					
					<?php } ?>


				</table>
			</div>

			
		</div>


	</body>
</html>


<?php
	mysqli_close($db_con);
?>