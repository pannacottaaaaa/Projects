<?php
session_start();

# If the user is not logged in, redirect them to the login page
if(!isset($_SESSION['user_id'])) {
	header("Location: login-reg.php");
	exit;
}

# If the user accesses the landing page by clicking a profile, this statement will get the info of the profile they clicked
if(isset($_GET['id'])) {
	$connect = mysqli_connect('localhost', 'dormie', 'password', 'dormie', '3307');

	$username = mysqli_real_escape_string($connect, $_GET['id']);

	$query = "SELECT * FROM user u, profile p WHERE u.username='$username' AND p.is_verified IS TRUE AND u.user_id=p.user_id";
	$result = mysqli_query($connect, $query) or die("Bad Query: $query");
	$row = mysqli_fetch_array($result);
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dormie Details Page | Dormie</title>
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link rel="stylesheet" href="styles/dormie-landing-style.css">

<!-- Scripts for Navbar and Footer Import -->
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>
$(function(){
$("#nav-placeholder").load("nav.html");
$("#footer-placeholder").load("footer.html");
});
</script>
</head>
<body>
	<div id="header">
		<nav><?php include_once ("nav.php") ?></div></nav>
	</div>

	<div class="head">
	<h1>Check out your potential Dormie</h1>
	</div>

	<div class="row">
		<div class="column">
		<div class="card1">
			<div class="card-container">
				<?php
				$imageData = $row['profile_picture'];
				echo "<img class='round' src='data:image/png;base64,".base64_encode($imageData)."'  width='125' height='125' alt='user' />";
				?>
				<?php echo "<h3>" .$row['first_name']. " " .$row['last_name']. " </h3>" ?>
				<h6><?php echo $row['city'] ?></h6>
				<p style="color:#000"><?php echo $row['gender'] ?><br/><?php echo $row['age'] ?> years old</br><?php echo $row['degree'] ?></p>
				<div class="buttons">
					<a href="mailto:<?php echo $row['email'] ?>"><button class="primary">
						Message
					</button></a>
				</div>
			</div>
		</div>
		</div>

		<div class="column">
		<div class="card2">
				<h2 style="color:#9F86C0">About Me</h2>
				<p align="justify"><?php echo $row['about'] ?></p>
				
				<h2 style="color:#9F86C0">Student Information</h2>
					<li><b>Department: </b><?php echo $row['department'] ?></li>
					<li><b>Email: </b><?php echo $row['email'] ?></li>
					
				<h2 style="color:#9F86C0">Moving Preferences</h2>
				<p><li><b>Location:</b> 185-B 27th Avenue, East Rembo, Makati<br>
					<li><b>Contact Number: </b><?php echo $row['contact_number'] ?></li>
					<li><b>Budget: </b>₱<?php echo $row['budget'] ?> </li></p>
		</div>
		</div>
		
	</div>
	
	<div id="footer">
		<div id="footer-placeholder"></div>
	</div>
</body>
</html>
