<?php
	error_reporting(0);
	session_start();

	if($_SESSION['type'] != "admin"){
		header('Location: logout.php');
	}

	require_once("db.php");
	$query_cat = "select * from category";
	$result_cat1 = mysqli_query($db_con, $query_cat);
	$result_cat2 = mysqli_query($db_con, $query_cat);
?>




<!DOCTYPE html>

<html>
	<head>
		<title>Manage</title>

		<link rel="stylesheet" type="text/css" href="style_manage.css">
	</head>


	<body>


		<div class="whole">
			<header>
				<h1>brothers furniture</h1>
			</header>

					

			<div class="content">

				<form action="logout.php">
					<input type="submit" value="Logout" id="logout_button">
				</form>


				<p class="intro">
					Manage the whole thing:
				</p>

				<br /><br /><br /><br /><hr /><hr />
				<form action="execute.php" method="post">					
					<label class="title">Add a Product category:</label>
					<br /><br />
					<label>Type Category name:</label>
					<input type="text" name="cat_name" id="cat_name">
					<input type="submit" value="Add Category" name="submit">
				</form>

				<br /><br /><br />

				<form action="execute.php" method="post">					
					<label class="title">Delete a Product category:</label>
					<br /><br />
					<label>Select Category:</label>
					<select name="del_p_category" id="del_p_category">

						<?php
							while ($row_cat = mysqli_fetch_assoc($result_cat1)) {
								$cat_id = $row_cat["c_id"];
								$category_name = $row_cat["c_name"];
								echo "<option value={$cat_id}>{$category_name}</option>";
							}
							mysqli_free_result($result_cat1);
						?>
					</select>
					<label>(The category must be empty before it will be deleted.)</label>
					<br />
					<input type="submit" value="Delete Category" name="submit">
				</form>

				<hr /><hr /><br /><br /><br /><br /><br /><br /><br /><br /><hr /><hr />

				<form action="execute.php" method="post" enctype="multipart/form-data">					
					<label class="title">Add a Product:</label>
					<br /><br />
					<label>Choose a picture:</label>
					<input type="file" name="image" id="image">
					<br />
					<label>Type Product Name:</label>
					<input type="text" name="add_p_name" id="add_p_name">
					<br />
					<label>Select a Category:</label>
					<select name="set_p_category" id="set_p_category">

						<?php
							while ($row_cat = mysqli_fetch_assoc($result_cat2)) {
								$cat_id = $row_cat["c_id"];
								$category_name = $row_cat["c_name"];
								echo "<option value={$cat_id}>{$category_name}</option>";
							}
							mysqli_free_result($result_cat2);
						?>
					</select>
					<br />
					<label>Set Price:</label>
					<input type="text" name="set_price" id="set_price">
					<br />
					<input type="submit" value="Add product" name="submit">
				</form>

				<br /><br /><br />

				<form action="execute.php" method="post">					
					<label class="title">Change Product Price:</label>
					<br /><br />
					<label>Type Product Id:</label>
					<input type="text" name="ch_price_pid" id="ch_price_pid">
					<br />
					<label>Type New Price:</label>
					<input type="text" name="ch_price" id="ch_price"><label>Tk.</label>
					<br />
					<input type="submit" value="Change Price" name="submit">
				</form>

				<br /><br /><br />

				<form action="execute.php" method="post">					
					<label class="title">Delete a Product:</label>
					<br /><br />
					<label>Type Product Id:</label>
					<input type="text" name="del_p_id" id="del_p_id">
					<input type="submit" value="Delete Product" name="submit">
				</form>

				<hr /><hr /><br /><br /><br /><br /><br /><br /><br /><br /><hr /><hr />

				<form action="execute.php" method="post">
					<label class="title">Add a showroom:</label>
					<br /><br />
					<label>District:</label>
					<input type="text" name="district" id="district">
					<br />
					<label>Location:</label>
					<textarea name="location" id="location" rows="6" cols="30"></textarea>
					<label>(max 180 characters)</label>
					<br />
					<label>Contact no. <span id="span_contact"> +880</span></label>
					<input type="text" name="contact" id="contact">
					<br />
					<input type="submit" value="Add Showroom" name="submit">
				</form>

				<br /><br /><br />

				<form action="execute.php" method="post">
					<label class="title">Delete a showroom:</label>
					<br /><br />
					<label>Put showroom Id:</label>
					<input type="text" name="del_show" id="del_show_id">
					<input type="submit" value="Delete Showroom" name="submit">
				</form>

				<hr /><hr /><br /><br /><br /><br /><br /><br /><br /><br /><hr /><hr />

				<form action="execute.php" method="post">					
					<label class="title">Change Password:</label>
					<br /><br />
					<label>Old Password:</label>
					<input type="password" name="old_pass" id="old_pass">
					<br />
					<label>New Password:</label>
					<input type="password" name="new_pass" id="new_pass">
					<label>(minimum 10 characters)</label>
					<br />
					<label>Confirm Password:</label>
					<input type="password" name="conf_pass" id="conf_pass">
					<br />
					<input type="submit" value="Change password" name="submit">
				</form>


			</div>

		</div>

	</body>
</html>
<?php mysqli_close($db_con); ?>