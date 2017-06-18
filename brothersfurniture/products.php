<?php
	require_once("db.php");
	$query_cat = "select * from category";
	$result_cat = mysqli_query($db_con, $query_cat);
?>




<!DOCTYPE html>

<html>
	<head>
		<title>Products</title>

		<link rel="stylesheet" type="text/css" href="style_products.css">
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
				<div class="side_navigation">
					<ul>
						
						<?php
							while ($row_cat = mysqli_fetch_assoc($result_cat)) {
								$cat_id = $row_cat["c_id"];
								$category_name = $row_cat["c_name"];								
								echo "<a href='products.php?cid={$cat_id}'>	<li>$category_name</li>	</a>";
							}
						?>

					</ul>
				</div>





				<?php

					if(!isset($_GET["cid"])){
						?>

					<div class="products_banner">
						<h2>
							Let's check out the future
						</h2>
					</div>					


				<?php } else{ 
						$query_pd = "select * from product where c_id={$_GET['cid']} order by id desc";
						$result_pd = mysqli_query($db_con, $query_pd);
					?>
					<div class="search_content">


					<?php
						$found = 0;
						while ($row_pd = mysqli_fetch_assoc($result_pd)) { $found = 1; ?>

						<div class="single_outside">
							<a href="specific_id.php?id=<?php echo $row_pd['id']; ?>">
								<div class="single">
									<img src="img/<?php echo $row_pd["id"]; ?>">
									<p>
										<?php echo $row_pd["name"]; ?><br />
										Product Id:<?php echo $row_pd["id"]; ?><br />
										<?php echo $row_pd["price"]; ?>Tk
									</p>
								</div>
							</a>
						</div>	

					<?php 
					}
					if($found == 0)
						echo "<br/><p>No products has been added or might be removed from this category.</p>";
					 ?>


					</div>
				<?php } ?>



				
			</div>
		</div>


	</body>
</html>


<?php
	mysqli_close($db_con);
?>