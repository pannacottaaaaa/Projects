<?php
	require_once 'index-db.php';
	global $db;
	session_start();
	$user_id = $_SESSION["user_id"];
	$query = "SELECT * FROM user WHERE user_id = {$_SESSION["user_id"]}" ;
	$result = mysqli_query($db, $query);
	
	$target_file = "./images/" . basename($_FILES["filename"]["name"]);
	move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file); 
	
	#<input type="file" id="myFile" name="filename">
	#										<input type="submit" value="Upload File">

	#$target_file = "./images/" . basename($_FILES["filename"]["name"]);
	#move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file); 
?>

