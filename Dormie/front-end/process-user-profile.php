<?php
require_once 'index-db.php';
global $db;
session_start();
$user_id = $_SESSION["user_id"];
$query = "SELECT * FROM user WHERE user_id = {$_SESSION["user_id"]}" ;
$result = mysqli_query($db, $query);

if(isset($_SESSION["user_id"])) {
	
	// USER UPDATES, CHECK IF EACH INPUT IS NOT EMPTY.. if it's not add it to the update array

	$updates = [];
	if (!empty($_POST['first_name'])) {
		$updates[] = "first_name='" . $_POST['first_name'] . "'";
	}
	if (!empty($_POST['last_name'])) {
		$updates[] = "last_name='" . $_POST['last_name'] . "'";
	}
	if (!empty($_POST['middle_name'])) {
		$updates[] = "middle_name='" . $_POST['middle_name'] . "'";
	} else {
		$updates[] = "middle_name='NULL'";
	}
	if (!empty($_POST['username'])) {
		$updates[] = "username='" . $_POST['username'] . "'";
	}
	if (!empty($_POST['email'])) {
		$updates[] = "email='" . $_POST['email'] . "'";
	}
	if (!empty($_POST['password'])) {
		$updates[] = "password='" . $_POST['password'] . "'";
	}
	
	// When all empty check is done. add it to this update query to update everything
	if (!empty($updates)) {
		$user_sql = "UPDATE user SET " . implode(",", $updates) . " WHERE user_id={$_SESSION['user_id']}";
	} else {
		$user_sql = "";
	}
	
	// PROFILE UPDATES, CHECK IF EACH INPUT IS NOT EMPTY.. if it's not add it to the update array
	$prof_updates = [];
	if (!empty($_POST['address'])) {
		$prof_updates[] = "address='" . $_POST['address'] . "'";
	}
	if (!empty($_POST['zip_code'])) {
		$prof_updates[] = "zip_code='" . $_POST['zip_code'] . "'";
	}
	if (!empty($_POST['department'])) {
		$prof_updates[] = "department='" . $_POST['department'] . "'";
	}
	if (!empty($_POST['degree'])) {
		$prof_updates[] = "degree='" . $_POST['degree'] . "'";
	}
	if (!empty($_POST['batch_year'])) {
		$prof_updates[] = "batch_year='" . $_POST['batch_year'] . "'";
	}
	if (!empty($_POST['about'])) {
		$prof_updates[] = "about='" . $_POST['about'] . "'";
	}
	if (!empty($_POST['city'])) {
		$prof_updates[] = "city='" . $_POST['city'] . "'";
	}
	
	// When all empty check is done. add it to this update query to update everything
	if (!empty($prof_updates)) {
		$prof_sql = "UPDATE profile SET " . implode(",", $prof_updates) . " WHERE user_id={$_SESSION['user_id']}";
	} else {
		$prof_sql = "";
	}
	
	if (!empty($user_sql) || !empty($prof_sql)) {
		if ($db->query($user_sql) === TRUE && $db->query($prof_sql) === TRUE) {
			header("Location: user-profile-page.php");
			exit;
		}
	}
	
  /*$result = $db->query($sql);
  // Reload the user's information from the database after the changes are saved
  $sql = "SELECT * FROM user u, profile p WHERE u.user_id = {$_SESSION["user_id"]} AND u.user_id = p.user_id";
  $result = $db->query($sql);
  $user = $result->fetch_assoc();*/
}
