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

if (isset($_POST['save_changes'])) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $sql = "UPDATE user u, profile p SET u.first_name='$first_name', u.last_name='$last_name', WHERE u.user_id={$_SESSION['user_id']}";
  $result = $db->query($sql);
  // Reload the user's information from the database after the changes are saved
  $sql = "SELECT * FROM user u, profile p WHERE u.user_id = {$_SESSION["user_id"]} AND u.user_id = p.user_id";
  $result = $db->query($sql);
  $user = $result->fetch_assoc();
}
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
				<h1>Profile</h1>
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
												$imageData = $user['profile_picture'];
												echo "<img class='round' src='data:image/png;base64,".base64_encode($imageData)."'  width='140px' height='140px' alt='user' />";
												?>
											</span>
										</div>
									</div>
									</div>
									<div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
									<div class="text-center text-sm-left mb-2 mb-sm-0">
										<h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo $user['first_name'] ?> <?php echo $user['last_name'] ?></h4>
										<p class="mb-0">@<?php echo $user['username'] ?></p>
										<div class="mt-2">
										<!--
										<button class="btn btn-primary" type="button" style="background: #9F86C0; border: #9F86C0;">
											<i class="fa fa-fw fa-camera"></i>
											<span>Change Photo</span>
										</button> -->
										
										<form action="save_img.php" method="post" enctype="multipart/form-data">
											<input class="btn btn-primary" style="background: #9F86C0; border: #9F86C0;" type="file" id="myFile" name="filename">
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
									<form action="process-user-profile.php" method="post" class="form" novalidate="">
										<div class="row">
										<div class="col">
											<div class="row">
											<div class="col">
												<div class="form-group">
												<label>First Name</label>
												<input class="form-control" type="text" name="first_name" placeholder="First Name" value="<?php echo $user['first_name'] ?>" required>
												</div>
											</div>
											<div class="col">
												<div class="form-group">
												<label>Last Name</label>
												<input class="form-control" type="text" name="last_name" placeholder="Last Name" value="<?php echo $user['last_name'] ?>" required>
												</div>
											</div>
											</div>
											
											<div class="row">
											<div class="col">
												<div class="form-group">
												<label>Middle Name</label>
												<input class="form-control" type="text" name="middle_name" placeholder="Middle Name" value="<?php echo $user['middle_name'] ?>" required>
												</div>
											</div>
											<div class="col">
												<div class="form-group">
												<label>Username</label>
												<input class="form-control" type="text" name="username" placeholder="Username" value="<?php echo $user['username'] ?>" required>
												</div>
											</div>
											</div>

											<div class="row">
											<div class="col">
												<div class="form-group">
												<label>Address</label>
												<input class="form-control" type="text" name="address" placeholder="Address" value="<?php echo $user['address'] ?>" required>
												</div>
											</div>
											</div>
			
											<div class="row">
											<div class="col">
												<div class="form-group">
												<label>City</label>
												<input class="form-control" type="text" name="city" placeholder="City" value="<?php echo $user['city'] ?>" required>
												</div>
											</div>
											<div class="col">
												<div class="form-group">
												<label>ZIP Code</label>
												<input class="form-control" type="text" name="zip_code" placeholder="Zip Code" value="<?php echo $user['zip_code'] ?>" required>
												</div>
											</div>
											</div>
			
											<div class="row">
											<div class="col">
												<div class="form-group">
												<label>Email</label>
												<input class="form-control" type="text" name="email" placeholder="Email" value="<?php echo $user['email'] ?>" required >
												</div>
											</div>
											</div>
			
											<div class="row">
											<div class="col">
												<div class="form-group">
												<label>Department</label>
												<input class="form-control" type="text" name="department" placeholder="Department" value="<?php echo $user['department'] ?>" required>
												</div>
											</div>
											<div class="col">
												<div class="form-group">
												<label>Degree</label>
												<input class="form-control" type="text" name="degree" placeholder="Degree" value="<?php echo $user['degree'] ?>" required>
												</div>
											</div>
											</div>
			
											<div class="row">
											<div class="col">
												<div class="form-group">
												<label>Batch Year</label>
												<input class="form-control" type="text" name="batch_year" placeholder="Batch Year" value="<?php echo $user['batch_year'] ?>" required>
												</div>
											</div>
											</div>
			
											<div class="row">
											<div class="col mb-3">
												<div class="form-group">
												<label>About</label>
												<textarea class="form-control" rows="5" name="about" placeholder="Tell Dormie about yourself." value="<?php echo $user['about'] ?>"><?php echo $user['about'] ?></textarea>
												</div>
											</div>
											</div>
										</div>
										</div>
			
										<div class="row">
										<div class="col-12 col-sm-6 mb-3">
											<div class="mb-2"><b>Change Password</b></div>
											<div class="row">
											<div class="col">
												<div class="form-group">
												<label>Current Password</label>
												<input class="form-control" name="password" type="password" placeholder="••••••">
												</div>
											</div>
											</div>
											<div class="row">
											<div class="col">
												<div class="form-group">
												<label>New Password</label>
												<input class="form-control" type="password" placeholder="••••••">
												</div>
											</div>
											</div>
											<div class="row">
											<div class="col">
												<div class="form-group">
												<label>Confirm <span class="d-none d-xl-inline">Password</span></label>
												<input class="form-control" type="password" placeholder="••••••"></div>
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
</body>
</html>
