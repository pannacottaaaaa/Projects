<?php
require_once 'index-db.php';
global $db;
session_start();

if(isset($_SESSION["user_id"])) {
	$sql = "SELECT * FROM user u, profile p WHERE u.user_id = {$_SESSION["user_id"]} AND u.user_id = p.user_id";
	$result = $db->query($sql);
	$user = $result->fetch_assoc();
	$record = mysqli_fetch_assoc( $result );
} else {
	if(!isset($_SESSION['user_id'])) {
		header("Location: login-reg.php");
		exit();
	}
}

$user_id = $_SESSION["user_id"];
$query = "SELECT * FROM user WHERE user_id = {$_SESSION["user_id"]}" ;
$resulta = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Your Profile | Dormie</title>
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!-- FOR NAV AND FOOTER -->
<script>
	$(function(){
	$("#nav-placeholder").load("nav.html");
	$("#footer-placeholder").load("footer.html");
	});
</script>

<script src="components/header.js" type="text/javascript" defer></script>
<script src="components/footer.js" type="text/javascript" defer></script>


<style>
	/* MAIN GRID TO ORGANIZE HEADER - CONTENT - FOOTER */
	#maingrid {
		display: grid;
		width: 100%;
		grid-template-areas: "head head"
							"cont cont"
							"foot foot";
		grid-template-columns: 1fr 1fr;
		grid-template-rows: auto;
	}

	#maingrid > header {
		grid-area: head;
		position: sticky;
		top: 0;
		z-index: 1;
	}

	#maingrid > #content {
		grid-area: cont;
      	margin-bottom: 2.5%;
	}

	#maingrid > #sidebar {
		grid-area: side;
	}

	#maingrid > footer {
		grid-area: foot;
	}
	/* --end--*/

	body {
		font-family: Poppins;
		min-height: 100vh;
		margin: 0;
	}


	.head {
	text-align: left;
	color: #000000;
	padding: 15px;
	}

	.logout:hover {
		text-decoration: none;
	}
	
</style>
</head>

<body>
	<div id="maingrid">
		<header><?php include_once ("nav.php") ?></header>

		<div id="content">
			<div class="head">
				<center><h1>Create your Profile</h1></center>
			</div>
		
			<div class="container">
				<div class="row flex-lg-nowrap">
					<div class="col">
						<div class="row">
						<div class="col mb-3">
							<div class="card">
							<div class="card-body">
								<div class="e-profile">
								<div class="row">
									<div class="col-12 col-sm-auto mb-3">
									<div class="mx-auto" style="width: 140px;">
										<div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
											<span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">
												<?php
												#$imageData = $user['profile_picture'];
												#echo "<img class='round' src='data:image/png;base64,".base64_encode($imageData)."'  width='140px' height='140px' alt='user' />";
												?>
												<img class='round' src='images/error.jpg'  width='140px' height='140px' alt='user' />
											</span>
										</div>
									</div>
									</div>
									<div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
									<div class="text-center text-sm-left mb-2 mb-sm-0">
										<div class="mt-2">
										<!--
										<button class="btn btn-primary" type="button" style="background: #9F86C0; border: #9F86C0;">
											<i class="fa fa-fw fa-camera"></i>
											<span>Change Photo</span>
										</button> -->
										<h4>Upload a Profile Picture</h4>
										<form action="save_img.php" method="post" enctype="multipart/form-data">
											<input class="btn btn-primary" style="background: #9F86C0; border: #9F86C0;" type="file" id="myFile" name="filename" value="test">
											<input class="btn btn-primary" style="background: #9F86C0; border: #9F86C0;" type="submit" value="Upload File">
										</form>
										</div>
									</div>
									<div class="text-center text-sm-right">
										<?php
											$verified_query = "SELECT * FROM profile WHERE user_id = {$_SESSION["user_id"]}" ;
											$verified_result = mysqli_query($db, $verified_query);
											$verified_record = mysqli_fetch_assoc( $verified_result );
											$verified = $verified_record['is_verified'];
											if ($verified == TRUE) {
												echo "<span class='badge badge-success'>Verified</span>";
											} else {
												echo "<span class='badge badge-secondary'>Verified</span>";
											};
										?>
										<div class="text-muted"><small>Joined 09 Jan 2023</small></div>
									</div>
									</div>
								</div>
								<ul class="nav nav-tabs">
									<li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
								</ul>
								<div class="tab-content pt-3">
									<div class="tab-pane active">
									<form action="process-user-profile.php" method="post" class="form" novalidate="" id="myForm">
										<div class="row">
										<div class="col">
											<div class="row">
											<div class="col">
												<div class="form-group">
												<label>First Name</label>
												<input id="prof_form" class="form-control" type="text" name="first_name" placeholder="First Name" required>
												</div>
											</div>
											<div class="col">
												<div class="form-group">
												<label>Last Name</label>
												<input id="prof_form" class="form-control" type="text" name="last_name" placeholder="Last Name" required>
												</div>
											</div>
											</div>
											
											<div class="row">
											<div class="col">
												<div class="form-group">
												<label>Middle Name</label>
												<input id="prof_form" class="form-control" type="text" name="middle_name" placeholder="Middle Name" required>
												</div>
											</div>
											<div class="col">
												<div class="form-group">
												<label for="birthday">Birthday:</label>
												</br>
												<input type="date" id="birthday" name="birthday" pattern="\d{4}-\d{2}-\d{2}" required>
												</div>
											</div>
											</div>

											<div class="row">
											<div class="col">
												<div class="form-group">
												<label>Address</label>
												<input id="prof_form" class="form-control" type="text" name="address" placeholder="Address" required>
												</div>
											</div>
											</div>
			
											<div class="row">
											<div class="col">
												<div class="form-group">
												<label>City</label>
												<input id="prof_form" class="form-control" type="text" name="city" placeholder="City" required>
												</div>
											</div>
											<div class="col">
												<div class="form-group">
												<label>ZIP Code</label>
												<input id="prof_form" class="form-control" type="text" name="zip_code" placeholder="ZIP Code" required>
												</div>
											</div>
											</div>
			
			
											<div class="row">
											<div class="col">
												<div class="form-group">
												<label>Department</label>
												<input id="prof_form" class="form-control" type="text" name="department" placeholder="Department" required>
												</div>
											</div>
											<div class="col">
												<div class="form-group">
												<label>Degree</label>
												<input id="prof_form" class="form-control" type="text" name="degree" placeholder="Program" required>
												</div>
											</div>
											</div>
			
											<div class="row">
											<div class="col">
												<div class="form-group">
												<label>Batch Year</label>
												<input id="prof_form" class="form-control" type="text" name="batch_year" placeholder="Batch Year" required>
												</div>
											</div>
											</div>
			
											<div class="row">
											<div class="col mb-3">
												<div class="form-group">
												<label>About</label>
												<textarea class="form-control" rows="5" name="about" placeholder="Tell Dormie about yourself." ></textarea>
												</div>
											</div>
											</div>
										</div>
										</div>
		
										<div class="row">
										<div class="col d-flex justify-content-end">
											<button class="btn btn-primary" type="submit" style="background: #9F86C0; border: #9F86C0;">Save Changes</button>
										</div>
										</div>
									</form>
			
									</div>
								</div>
								</div>
							</div>
							</div>
						</div>
			
						<div class="col-12 col-md-3 mb-3">
							<div class="card-body">
								<div class="px-xl-3">
								<a class="logout" href="logout.php"><button class="btn btn-block btn-secondary" style="background: #9F86C0; border: #9F86C0;">
									<i class="fa fa-sign-out"></i>
									<span>Logout</span>
								</button></a>
								</div>
							</div>
							<div class="card">
							<div class="card-body">
								<h6 class="card-title font-weight-bold">Support</h6>
								<p class="card-text">Get fast, free help from our friendly assistants.</p>
								<a class="logout" href="contact.php"><button type="button" class="btn btn-primary" style="background: #9F86C0; border: #9F86C0;">Contact Us</button></a>
							</div>
							</div>
						</div>
						</div>
			
					</div>
				</div>
			</div>
		</div>

		<footer><div id="footer-placeholder"></div></footer>
	</div>
	
	<script>
	
		  document.getElementById("myForm").addEventListener("submit", function(event) {
			var inputs = document.getElementsByTagName("input");
			for (var i = 2; i < inputs.length; i++) {
			  if (inputs[i].value.trim() === "" && inputs[i].type !== "hidden") {
				alert("Please fill out all fields.");
				event.preventDefault();
				return;
			  }
			}
		  });
		</script>
</body>
</html>
