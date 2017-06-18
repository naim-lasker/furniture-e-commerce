<?php	
	error_reporting(0);
	session_start();

	if($_SESSION['type'] != "admin"){
		header('Location: logout.php');
	}


	if(!isset($_POST['submit'])){
		header('Location: manage.php');
	}
	$msg = "";

	if($_POST['submit'] == "Add Category"){
		$msg = add_category();
	}

	if($_POST['submit'] == "Delete Category"){		
		$msg = delete_category();
	}
	
	if($_POST['submit'] == "Add product"){
		$msg = add_product();
	}

	if($_POST['submit'] == "Change Price"){
		$msg = change_price();
	}

	if($_POST['submit'] == "Delete Product"){
		$msg = delete_product();
	}

	if($_POST['submit'] == "Add Showroom"){
		$msg = add_showroom();
	}

	if($_POST['submit'] == "Delete Showroom"){
		$msg = delete_showroom();
	}

	if($_POST['submit'] == "Change password"){
		$msg = change_pass();
	}
?>


<html>
	<head>
		<title>Execute</title>
		<style type="text/css">
			div{
				width: 960px;
				margin-top: 20px;
				margin: auto;
			}
			img{
				max-width: 500px;
				max-height: 400px;
			}
		</style>
	</head>
	<body>
		<div>
			<p><?php echo $msg; ?></p>
			<br />
			<a href="manage.php">Go back</a>
		</div>
	</body>
</html>



<?php
	function add_category(){

		$name = trim($_POST['cat_name']);
		$length = strlen($name);
		if($length <= 2){
			return "Too short name";
		}
		if($length > 25){
			return "Name is too long";
		}

		require_once("db.php");

		$query = "insert into category(c_name) values(". '"' .$name. '"'. ")";
		$result = mysqli_query($db_con, $query);

		if($result){
			$success_msg = "Category added successfully New Category Name: ";
			$success_msg .= $name;

			mysqli_close($db_con);
			return $success_msg;
		}		
	}





	function delete_category(){
		$c_id = $_POST['del_p_category'];

		require_once("db.php");
		$query = "select id from product where c_id={$c_id}";
		$result = mysqli_query($db_con, $query);
		$row = mysqli_fetch_assoc($result);

		if(isset($row['id'])){
			return "Some product(s) exist in this category.<br />So it cannot be deleted!";
		}		
		
		$query = "select c_name from category where c_id = {$c_id}";
		$result = mysqli_query($db_con, $query);
		$row = mysqli_fetch_assoc($result);
		$cname = $row['c_name'];

		$query = "delete from category where c_id = {$c_id}";
		$result = mysqli_query($db_con, $query);
		if($result){
			return "Category: {$cname} has been deleted successfully.";
		}
	}







	function add_product(){
		if(!isset($_FILES['image']['name']) || $_FILES['image']['name'] == ""){
			return "No picture selected";
		}

		$type = $_FILES['image']['type'];
		$pname = $_POST['add_p_name'];
		$cat_id = $_POST['set_p_category'];
		$price = 0;
		$price += $_POST['set_price'];

		if(substr_count($type, "image") == 0){
			return "The file you chose is not a picture!";
		}

		if($pname == ""){
			return "Product name is not selected";
		}

		if($pname > 29){
			return "Product name is too long. Maximum 29 character";
		}

		if($price == 0){
			return "Invalid price";
		}

		require_once("db.php");		
		$query = "insert into product (c_id, name, price) values('{$cat_id}', '{$pname}', $price)";
		$result = mysqli_query($db_con, $query);
		if($result){

			$query1 = "SELECT MAX(id) FROM product";
			$result1 = mysqli_query($db_con, $query1);
			$row = mysqli_fetch_assoc($result1);			
			$new_id = $row['MAX(id)'];

			$destination = "img/" . $new_id;
			move_uploaded_file($_FILES['image']['tmp_name'], $destination);

			$query2 = "select c_name from category where c_id = {$cat_id}";
			$result2 = mysqli_query($db_con, $query2);
			$row = mysqli_fetch_assoc($result2);
			$cname = $row['c_name'];

			$success_msg = "Product added successfully.<br />";
			$success_msg .= "New product id: {$new_id} <br />";
			$success_msg .= "Product name: {$pname} <br />";
			$success_msg .= "Category: {$cname} <br />";
			$success_msg .= "Price = {$price} <br />";
			$success_msg .= "Image:<br />";
			$success_msg .= "<img src='{$destination}'>";

			return $success_msg;
		}

	}




	function change_price(){

		$id = $_POST['ch_price_pid'];
		$new_p = 0;
		$new_p += $_POST['ch_price'];
		if($id == ""){
			return "Id has not set";
		}
		if($new_p < 1){
			return "Invalid price input";
		}

		require_once("db.php");
		$query = "select * from product where id={$id}";
		$result = mysqli_query($db_con, $query);

		$row = mysqli_fetch_assoc($result);
		if(!isset($row['id'])){
			mysqli_close($db_con);
			return "This product id does not exist";
		}
		$old_p = $row['price'];

		$query = "update product set price={$new_p} where id={$id}";
		$result = mysqli_query($db_con, $query);
		if($result){
			$ms = "Price updated successfully <br />";
			$ms .= "Old Price: {$old_p} <br />";
			$ms .= "New Price: {$new_p}";
			return $ms;
		}
	}




	

	function delete_product(){

		$id = $_POST['del_p_id'];     

		if($id == ""){
			return "Id has not set";
		}

		require_once("db.php");
		$query = "select * from product where id={$id}";
		$result = mysqli_query($db_con, $query);

		$row = mysqli_fetch_assoc($result);
		if(!isset($row['id'])){		
			return "This product id does not exist";			
		}

		$query = "delete from product where id={$id}";
		$result = mysqli_query($db_con, $query);
		if($result){			
			$img = "img/".$id;
			unlink($img);
		}
		mysqli_close($db_con);
		return "product id: {$id} deleted successfully";
	}





	function add_showroom(){
		$dis = $_POST['district'];
		$loc = trim($_POST['location']);
		$con_no = 0;
		$con_no += $_POST['contact'];


		if(strlen($dis) <= 2){
			return "District name is too short";
		}
		if(strlen($loc) <= 5){
			return "Address is too short";
		}
		if($con_no < 1000000000 || $con_no >= 2000000000){
			return "Invalid contact no.";
		}

		require_once("db.php");

		$query = "insert into showroom(district, location, contact_no) 
			values(". '"' .$dis. '"' . ', "' .$loc. '"'.", {$con_no})";
		$result = mysqli_query($db_con, $query);

		$success_msg = "";
		if($result){
			$success_msg .="Showroom added successfully<br />";

			$query1 = "SELECT MAX(s_id) FROM showroom";
			$result1 = mysqli_query($db_con, $query1);
			$row = mysqli_fetch_assoc($result1);			
			$new_id = $row['MAX(s_id)'];

			$success_msg .= "New showroom Id: {$new_id} <br />";
			$success_msg .= "District : {$dis} <br />";
			$success_msg .= "Location : {$loc} <br />";
			$success_msg .= "Contact no.: {$con_no}";

			return $success_msg;
		}
		
	}




	function delete_showroom(){
		$id = $_POST['del_show'];
		if($id == ""){
			return "Id has not set";			
		}

		require_once("db.php");
		$query = "select * from showroom where s_id={$id}";
		$result = mysqli_query($db_con, $query);

		$row = mysqli_fetch_assoc($result);
		if(!isset($row['s_id'])){
			mysqli_close($db_con);
			return "This showroom id does not exist";
		}
		$dis = $row['district'];
		$loc = $row['location'];
		$con_no = $row['contact_no'];

		$success_msg = "";
		$query = "delete from showroom where s_id={$id}";
		$result = mysqli_query($db_con, $query);
		if($result){
			$success_msg .= "The following showroom deleted successfully <br />";
			$success_msg .= "Id: {$id} <br />";
			$success_msg .= "District: {$dis} <br />";
			$success_msg .= "Location: {$loc} <br />";
			$success_msg .= "Contact no.: {$con_no}";
			return $success_msg;
		}
	}





	function change_pass(){
		$name = $_SESSION['name'];
		$old = $_POST['old_pass'];
		$new = $_POST['new_pass'];
		$conf = $_POST['conf_pass'];

		if($old == "")
			return "Old password field is empty!";

		if($new == "")
			return "New password field is empty!";

		if($conf == "")
			return "Confirm password field is empty!";

		require_once("db.php");
		$query = "select password from user where uname= "."'"."admin"."'";
		$result = mysqli_query($db_con, $query);
		$row = mysqli_fetch_assoc($result);
		$old_p = $row['password'];

		if(md5($old) != $old_p){
			return "password does not match";
		}

		if(strlen($new) < 10){
			return "Too short password!";
		}

		if($new != $conf){
			return "New password and Confirm password does not match!";
		}

		$new_p = md5($new);
		$query = "update user set password = "."'".$new_p."' where uname= "."'"."admin"."'";
		$result = mysqli_query($db_con, $query);
		if($result){
			return "Password changed successfully.";
		}
	}
?>