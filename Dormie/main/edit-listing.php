<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!--
	NOTE: 
		- To avoid clashes with the CSS, each form in this page has a separate 'submit' button.
		- Replace the values for ALL $currentListing occurences as the listing_id of the signed in user 
		- Image display are made manual D:
-->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Message Inbox">
  <meta name="keywords" content="HTML,CSS">
  <meta name="author" content="Dormie">
  <title>Edit Listing | Dormie</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>

  <!-- LIBRARIES -->
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<link rel="stylesheet" href="styles/create_listing_style.css">
	<link rel="stylesheet" href="file-uploading.css">
	<link rel="stylesheet" href="file-uploading-js.js">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



	<!-- FOR NAV AND FOOTER -->
	<script>
		$(function(){
		$("#nav-placeholder").load("nav.html");
		$("#footer-placeholder").load("footer.html");
		});
	</script>

  <style>
	body {
		font-family: 'Poppins';
	}

	/* NOTE: PUT THIS IN A (main?) STYLESHEET */
	/* MAIN GRID (header - content - footer) --start-- */
	#maingrid {
		display: grid;
		width: 100%;
		grid-template-areas: "header header"
							"cont cont"
							"foot foot";
		grid-template-columns: 1fr 1fr;
		grid-template-rows: auto;
	}

	#maingrid > header {
		grid-area: header;
		margin-bottom: 5%;
		position: sticky;
		top: 0;
		z-index: 1;
	}

	#maingrid > #content {
		grid-area: cont;
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		font-family: Poppins;
	}

	#maingrid > #sidebar {
		grid-area: side;
	}

	#maingrid > footer {
		grid-area: foot;
	}
	/* --end--*/

	/* -- image uploads -- */
	div.gallery {
	border: 1px solid #ccc;
	display: inline-block;
  	width: 20%;
  	padding: 5px;
  	box-sizing: border-box;
	background-color: #ffffff;
	}

	div.gallery:hover {
	border: 1px solid #777;
	}

	div.gallery img {
	width: 100%;
	height: auto;
	}

	div.desc {
	padding: 15px;
	text-align: center;
	}

	@media only screen and (max-width: 700px) {
	.responsive {
		width: 49.99999%;
		margin: 6px 0;
	}
	}

	@media only screen and (max-width: 500px) {
	.responsive {
		width: 100%;
	}
	}

	.clearfix:after {
	content: "";
	display: table;
	clear: both;
	}

	/* -- image upload end -- */
  </style>
</head>

<body>
	<div id="maingrid">
		<header><?php include_once ("nav.php") ?></header>

		<div id="content">
			<div class="head">
				<h1>Edit Listing</h1>
			</div>
		
			<div class="wrapper">
				<div class="title">
					Properties and Dormies
				</div>

				<!-- PROPERTIES AND DORMIES FORM HANDLER -->
				<?php
					// Include the connect.php file to establish a database connection
					include('connect.php');
					// Call the connect() function to establish a database connection
					$db = connect('localhost', 'dormiedb', 'dormie', 'password', 3306);

					if(isset($_POST['form_properties_and_dormies_submit'])){
						$listing_type = $_POST['listing_type'];
						$capacity = $_POST['capacity'];
						$bedrooms = $_POST['bedrooms'];
						$bathrooms = $_POST['bathrooms'];
						$rent_fee = $_POST['rent_fee'];

						// Replace 1 with selected listing to edit by signed in user $_SESSION['_']
						$currentListing = 1;
						$query = 
						"UPDATE listing 
						SET listing_type='$listing_type', capacity='$capacity', bedrooms='$bedrooms', bathrooms='$bathrooms', rent_fee='$rent_fee'
						WHERE listing_id = '$currentListing'";

						if($db->query($query) === TRUE) {
							// Generate JavaScript code for dialog box
							echo '<script type="text/javascript">';
							echo 'alert("Changes have been saved!");';
							echo '</script>';
						} else {
							// Generate JavaScript code for dialog box
							echo '<script type="text/javascript">';
							echo 'alert("Error updating record.");';
							echo '</script>';
						}
					}
				?>

				<form class="form" id="form_properties_and_dormies" action="#" method="POST">
				
				<?php 
					// Include the connect.php file to establish a database connection
					// include('connect.php');

					// Call the connect() function to establish a database connection
					$db = connect('localhost', 'dormiedb', 'dormie', 'password', 3306);

					// Replace 1 with selected listing to edit by signed in user $_SESSION['_']
					$currentListing = 1;
					$query = "SELECT * FROM listing WHERE listing_id = '$currentListing'";

					$gotResults = mysqli_query($db, $query);
					if($gotResults){
						if(mysqli_num_rows($gotResults) > 0) {
							while($row = mysqli_fetch_array($gotResults)){
								// print_r($row);
								?>
									<div class="inputfield">
										<label>What type of place are you listing?</label>
										<input type="text" name="listing_type" class="input" placeholder="ex: Shared Rooms or Private Rooms" 
										value="<?php echo $row['listing_type']; ?>" required>
									</div>
									<div class="inputfield">
										<label>How many Dormies can your place accomodate?</label>
										<input type="number" name="capacity" class="input" placeholder="Enter number of Dormies" 
										value="<?php echo $row['capacity']; ?>" required>
									</div>
									<div class="inputfield">
										<label>How many bedrooms can Dormies use?</label>
										<input type="text" name="bedrooms" class="input" placeholder="ex: 1 bedroom, 2 bedrooms, 3 bedrooms"
										value="<?php echo $row['bedrooms']; ?>" required>
									</div>
									<div class="inputfield">
										<label>How many bathrooms can your Dormies use?</label>
										<input type="number" name="bathrooms" class="input" placeholder="Enter number of bathrooms"
										value="<?php echo $row['bathrooms']; ?>" required>
									</div>
									<div class="inputfield">
										<label>How much would the monthly rent be?</label>
										<input type="number" name="rent_fee" class="input" placeholder="Enter monthly rent"
										value="<?php echo $row['rent_fee']; ?>" required>
									</div>
									<div class="inputfield">
										<input type="submit" name="form_properties_and_dormies_submit" value="Save Changes" class="btn">
									</div>
								<?php
							}
						}
					}
				?>	

					
				</form>
			</div><br>
			
			<!-- LOCATION FORM HANDLER -->
			<?php
					// Include the connect.php file to establish a database connection
					// include('connect.php');
					// Call the connect() function to establish a database connection
					$db = connect('localhost', 'dormiedb', 'dormie', 'password', 3306);

					if(isset($_POST['form_location_submit'])){
						$street = $_POST['street'];
						$city = $_POST['city'];
						$region = $_POST['region'];
						$zip_code = $_POST['zip_code'];

						// Replace 1 with selected listing to edit by signed in user $_SESSION['_']
						$currentListing = 1;
						$query = 
						"UPDATE listing 
						SET street='$street', city='$city', region='$region', zip_code='$zip_code'
						WHERE listing_id = '$currentListing'";

						if($db->query($query) === TRUE) {
							// Generate JavaScript code for dialog box
							echo '<script type="text/javascript">';
							echo 'alert("Changes have been saved!");';
							echo '</script>';
						} else {
							// Generate JavaScript code for dialog box
							echo '<script type="text/javascript">';
							echo 'alert("Error updating record.");';
							echo '</script>';
						}
					}
				?>
			
			<div class="wrapper">
				<div class="title">Location</div>
				
				<form class="form" id="form_location" action="#" method="POST">
				<?php 
					// Include the connect.php file to establish a database connection
					// include('connect.php');

					// Call the connect() function to establish a database connection
					$db = connect('localhost', 'dormiedb', 'dormie', 'password', 3306);

					// Replace 1 with selected listing to edit by signed in user $_SESSION['_']
					$currentListing = 1;
					$query = "SELECT * FROM listing WHERE listing_id = '$currentListing'";

					$gotResults = mysqli_query($db, $query);
					if($gotResults){
						if(mysqli_num_rows($gotResults) > 0) {
							while($row = mysqli_fetch_array($gotResults)){
								// print_r($row);
								?>
						<h4>Where's your place located?</h4>
						<div class="input-box address">
						<input type="text" name="street" placeholder="Enter street address"
						value="<?php echo $row['street']; ?>" required />
						<div class="column">
							<input type="text" name="city" placeholder="Enter your city"
							value="<?php echo $row['city']; ?>" required />
						</div>
						<div class="column">
							<input type="text" name="region" placeholder="Enter your region"
							value="<?php echo $row['region']; ?>" required />
							<input type="number" name="zip_code" placeholder="Enter postal code"
							value="<?php echo $row['zip_code']; ?>" required />
						</div>
					</div>
					<div class="inputfield">
						<input type="submit" name="form_location_submit" value="Save Changes" class="btn" style="margin-top:15px;">
					</div>
					<?php
							}
						}
					}
				?>	
				</form>
			</div><br>

			<!-- AMENITIES FORM HANDLER -->
			<?php
					// Include the connect.php file to establish a database connection
					// include('connect.php');
					// Call the connect() function to establish a database connection
					$db = connect('localhost', 'dormiedb', 'dormie', 'password', 3306);

					if(isset($_POST['form_amenities_submit'])){
						$wifi = isset($_POST['wifi']) ? 1 : 0;
						$air_condition = isset($_POST['air_condition']) ? 1 : 0;
						$desk_workspace = isset($_POST['desk_workspace']) ? 1 : 0;
						$kitchen_appliances_utensils = isset($_POST['kitchen_appliances_utensils']) ? 1 : 0;
						$fire_extinguisher = isset($_POST['fire_extinguisher']) ? 1 : 0;
						$television = isset($_POST['television']) ? 1 : 0;
						$closet_drawers = isset($_POST['closet_drawers']) ? 1 : 0;
						$washing_machine = isset($_POST['washing_machine']) ? 1 : 0;
						$smoke_detector = isset($_POST['smoke_detector']) ? 1 : 0;
						$first_aid_kit = isset($_POST['first_aid_kit']) ? 1 : 0;

						// Replace 1 with selected listing to edit by signed in user $_SESSION['_']
						$currentListing = 1;
						$query = 
						"UPDATE listing_amenities
						SET wifi='$wifi', air_condition='$air_condition', desk_workspace='$desk_workspace', 
						kitchen_appliances_utensils='$kitchen_appliances_utensils', fire_extinguisher='$fire_extinguisher', 
						television='$television', closet_drawers='$closet_drawers', washing_machine='$washing_machine', 
						smoke_detector='$smoke_detector', first_aid_kit='$first_aid_kit'
						WHERE listing_id = '$currentListing'";

						if($db->query($query) === TRUE) {
							// Generate JavaScript code for dialog box
							echo '<script type="text/javascript">';
							echo 'alert("Changes have been saved!");';
							echo '</script>';
						} else {
							// Generate JavaScript code for dialog box
							echo '<script type="text/javascript">';
							echo 'alert("Error updating record.");';
							echo '</script>';
						}
					}
				?>
		
			<!-- Amenities but not so sure how to align the checkboxes -->
			<div class="wrapper">
				<div class="title">Amenities</div>
				<form class="form" id="form_amenities" action="#" method="POST">

				<?php 
					// Call the connect() function to establish a database connection
					$db = connect('localhost', 'dormiedb', 'dormie', 'password', 3306);

					// Replace 1 with selected listing to edit by signed in user $_SESSION['_']
					$currentListing = 1;
					$query = "SELECT * FROM listing_amenities WHERE listing_id = '$currentListing'";

					$gotResults = mysqli_query($db, $query);
					if($gotResults){
						if(mysqli_num_rows($gotResults) > 0) {
							while($row = mysqli_fetch_array($gotResults)){
								// print_r($row);
								?>

					<h4>What amenities do you offer?</h4><br>
					<div class="rowx">
						<div class="columnx">
							<div class="page">
								<div class="page__section">
									<div class="page__toggle">
										<label class="toggle">
											<input class="toggle__input" name="wifi" type="checkbox" 
												<?php if($row['wifi']) echo "checked = 'checked'"; ?> >
											<span class="toggle__label">
												<span class="toggle__text">Wifi</span>
											</span>
										</label>
									</div>
								</div>
							</div>
							<div class="page">
								<div class="page__section">
									<div class="page__toggle">
										<label class="toggle">
											<input class="toggle__input" name="air_condition" type="checkbox" 
												<?php if($row['air_condition']) echo "checked = 'checked'"; ?> >
											<span class="toggle__label">
												<span class="toggle__text">Air Conditioning</span>
											</span>
										</label>
									</div>
								</div>
							</div>
							<div class="page">
								<div class="page__section">
									<div class="page__toggle">
										<label class="toggle">
											<input class="toggle__input" name="desk_workspace" type="checkbox" 
												<?php if($row['desk_workspace']) echo "checked = 'checked'"; ?> >
											<span class="toggle__label">
												<span class="toggle__text">Desk/Workspace</span>
											</span>
										</label>
									</div>
								</div>
							</div>
							<div class="page">
								<div class="page__section">
									<div class="page__toggle">
										<label class="toggle">
											<input class="toggle__input" name="kitchen_appliances_utensils" type="checkbox" 
												<?php if($row['kitchen_appliances_utensils']) echo "checked = 'checked'"; ?> >
											<span class="toggle__label">
												<span class="toggle__text">Kitchen Appliances & Utensils</span>
											</span>
										</label>
									</div>
								</div>
							</div>
							<div class="page">
								<div class="page__section">
									<div class="page__toggle">
										<label class="toggle">
											<input class="toggle__input" name="fire_extinguisher" type="checkbox" 
												<?php if($row['fire_extinguisher']) echo "checked = 'checked'"; ?> >
											<span class="toggle__label">
												<span class="toggle__text">Fire Extinguisher</span>
											</span>
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="columnx">
							<div class="page">
								<div class="page__section">
									<div class="page__toggle">
										<label class="toggle">
											<input class="toggle__input" name="television" type="checkbox" 
												<?php if($row['television']) echo "checked = 'checked'"; ?> >
											<span class="toggle__label">
												<span class="toggle__text">Television</span>
											</span>
										</label>
									</div>
								</div>
							</div>
							<div class="page">
								<div class="page__section">
									<div class="page__toggle">
										<label class="toggle">
											<input class="toggle__input" name="closet_drawers" type="checkbox" 
												<?php if($row['closet_drawers']) echo "checked = 'checked'"; ?> >
											<span class="toggle__label">
												<span class="toggle__text">Closet/Drawers</span>
											</span>
										</label>
									</div>
								</div>
							</div>
							<div class="page">
								<div class="page__section">
									<div class="page__toggle">
										<label class="toggle">
											<input class="toggle__input" name="washing_machine" type="checkbox" 
												<?php if($row['washing_machine']) echo "checked = 'checked'"; ?> >
											<span class="toggle__label">
												<span class="toggle__text">Washing Machine</span>
											</span>
										</label>
									</div>
								</div>
							</div>
							<div class="page">
								<div class="page__section">
									<div class="page__toggle">
										<label class="toggle">
											<input class="toggle__input" name="smoke_detector" type="checkbox" 
												<?php if($row['smoke_detector']) echo "checked = 'checked'"; ?> >
											<span class="toggle__label">
												<span class="toggle__text">Smoke Detector</span>
											</span>
										</label>
									</div>
								</div>
							</div>
							<div class="page">
								<div class="page__section">
									<div class="page__toggle">
										<label class="toggle">
											<input class="toggle__input" name="first_aid_kit" type="checkbox" 
												<?php if($row['first_aid_kit']) echo "checked = 'checked'"; ?> >
											<span class="toggle__label">
												<span class="toggle__text">First Aid Kit</span>
											</span>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="inputfield">
						<input type="submit" name="form_amenities_submit" value="Save Changes" class="btn" style="margin-top: -250px;">
					</div>
					<?php
							}
						}
					}
				?>	
				</form>
			</div>

			<!-- Upload -->
			<div class="wrapper">
				<div class="title">Photos</div>

				<div id="dropBox">
					<div class="gallery">
						<a target="_blank" href="images/a-main.jpg">
						<img src="images/a-main.jpg" width="600" height="400">
						</a>
						<div class="desc">a-main.jpg</div>
					</div>

					<div class="gallery">
						<a target="_blank" href="images/a1.jpg">
						<img src="images/a1.jpg" width="600" height="400">
						</a>
						<div class="desc">a1.jpg</div>
					</div>

					<div class="gallery">
						<a target="_blank" href="images/a2.jpg">
						<img src="images/a2.jpg" width="600" height="400">
						</a>
						<div class="desc">a2.jpg</div>
					</div>

					<div class="gallery">
						<a target="_blank" href="images/a3.jpg">
						<img src="images/a3.jpg" width="600" height="400">
						</a>
						<div class="desc">a3.jpg</div>
					</div>
				</div>
			</div>

			
			<br>
		
			<!-- DESCRIPTION FORM HANDLER -->
			<?php
					// Include the connect.php file to establish a database connection
					// include('connect.php');
					// Call the connect() function to establish a database connection
					$db = connect('localhost', 'dormiedb', 'dormie', 'password', 3306);

					if(isset($_POST['form_description_submit'])){
						$description = $_POST['description'];
						$listing_title = $_POST['listing_title'];
						$phone_number = $_POST['phone_number'];
						
						// Replace 1 with selected listing to edit by signed in user $_SESSION['_']
						$currentListing = 1;
						$query = 
						"UPDATE listing 
						SET description='$description', listing_title='$listing_title', phone_number='$phone_number'
						WHERE listing_id = '$currentListing'";

						if($db->query($query) === TRUE) {
							// Generate JavaScript code for dialog box
							echo '<script type="text/javascript">';
							echo 'alert("Changes have been saved!");';
							echo '</script>';
						} else {
							// Generate JavaScript code for dialog box
							echo '<script type="text/javascript">';
							echo 'alert("Error updating record.");';
							echo '</script>';
						}
					}
				?>

			<div class="wrapper">
				<div class="title">Description</div>
				<form class="form" id="form_description" action="#" method="POST">

				<?php 
					// Include the connect.php file to establish a database connection
					// include('connect.php');

					// Call the connect() function to establish a database connection
					$db = connect('localhost', 'dormiedb', 'dormie', 'password', 3306);

					// Replace 1 with selected listing to edit by signed in user $_SESSION['_']
					$currentListing = 1;
					$query = "SELECT * FROM listing WHERE listing_id = '$currentListing'";

					$gotResults = mysqli_query($db, $query);
					if($gotResults){
						if(mysqli_num_rows($gotResults) > 0) {
							while($row = mysqli_fetch_array($gotResults)){
								// print_r($row);
								?>

					<h4>Describe your place to guests</h4>
					<span>Mention the best features of your space, and what you love about the neighborhood.</span><br><br>
					<div class="inputfield">
						<label>Describe your place to guests</label>
						<textarea class="textarea" name="description" placeholder="Mention the best features of your space, and what you love about the neighborhood.">
							<?php 
							$trimmed_description = trim(preg_replace('/\s+/', ' ',$row['description']));
							$cleaned_description = trim($trimmed_description);
							echo $cleaned_description; ?>
						</textarea>
					</div>
					<div class="inputfield">
						<label>Create a title for your listing</label>
						<input type="text" class="input" name="listing_title" placeholder="Catch guest's attention with a listing title that highlights what makes your place special."
						value="<?php echo $row['listing_title']; ?>" required />
					</div>
					<div class="inputfield">
						<label>Add your mobile number</label>
						<input id="phonenum" type="tel" pattern="^\d{4}-\d{3}-\d{4}$" name="phone_number" placeholder="format: 09XX-XXX-XXXX. This number should be able to receive texts or calls."
						value="<?php echo $row['phone_number']; ?>" required />
					</div>
					<div class="inputfield">
						<input type="submit" name="form_description_submit" value="Save Changes" class="btn" style="">
					</div>
					<?php
							}
						}
					}
				?>	
				</form>
			</div><br>
		
			<!-- BOOKING SETTINGS FORM HANDLER -->
			<?php
					// Include the connect.php file to establish a database connection
					// include('connect.php');
					// Call the connect() function to establish a database connection
					$db = connect('localhost', 'dormiedb', 'dormie', 'password', 3306);

					if(isset($_POST['form_booking_settings_submit'])){
						$reqs_govtid = isset($_POST['reqs_govtid']) ? 1 : 0;
						$house_rules = $_POST['house_rules'];
						
						// Replace 1 with selected listing to edit by signed in user $_SESSION['_']
						$currentListing = 1;
						$query = 
						"UPDATE listing_reqs
						SET reqs_govtid='$reqs_govtid', house_rules='$house_rules'
						WHERE listing_id = '$currentListing'";

						if($db->query($query) === TRUE) {
							// Generate JavaScript code for dialog box
							echo '<script type="text/javascript">';
							echo 'alert("Changes have been saved!");';
							echo '</script>';
						} else {
							// Generate JavaScript code for dialog box
							echo '<script type="text/javascript">';
							echo 'alert("Error updating record.");';
							echo '</script>';
						}
					}
				?>

			<div class="wrapper">
				<div class="title">Booking settings</div>
				<form action="#" method="post" class="form" id="form_booking_settings">
				<?php 
					// Include the connect.php file to establish a database connection
					// include('connect.php');

					// Call the connect() function to establish a database connection
					$db = connect('localhost', 'dormiedb', 'dormie', 'password', 3306);

					$query = "SELECT * FROM listing_reqs WHERE listing_id = '$currentListing'";

					$gotResults = mysqli_query($db, $query);
					if($gotResults){
						if(mysqli_num_rows($gotResults) > 0) {
							while($row = mysqli_fetch_array($gotResults)){
								// print_r($row);
								?>	
				
				<h4>Review Dormie's guest requirements</h4>
					<span>Dormie has requirements that all Dormies must meet before they book.</span>
					<div class="columns">
						<div class="column">
							<h4> All Dormies must provide: </h4> <br><br>
							<ul>
							<li>Email address</li>
							<li>Confirmed phone number</li>
							<li>Payment information</li>
							</ul>
						</div>
						<div class="column">
							<h4>Before booking, each Dormie must:</h4> <br><br>
							<ul>
							<li>Agree to your House Rules</li>
							<li>Message you about their visit</li>
							<li>Confirm their move-in time</li>
							</ul>
						</div>
					</div><br>
					<hr><br>
					<h4>Add additional requirements:</h4>
					<div class="page">
						<div class="page__section">
							<div class="page__toggle">
								<label class="toggle">
									<input class="toggle__input" name="reqs_govtid" type="checkbox" 
												<?php if($row['reqs_govtid']) echo "checked = 'checked'"; ?> >
									<span class="toggle__label">
									<span class="toggle__text">Government-issued ID submitted to Dormie</span>
									</span>
								</label>
							</div>
						</div>
					</div><br>
					<h4>Set house rules for your Dormies</h4>
					<span>Dormies must agree to your house rules before they book.</span><br><br>
					<div class="inputfield">
						<textarea class="textarea" name="house_rules" placeholder="Ex: Suitable for pets, No drinking allowed, No parties...">
						<?php 
							$trimmed_house_rules = trim($row['house_rules']);
							$cleaned_house_rules = trim(preg_replace('/\s+/', ' ', $trimmed_house_rules));
							
							echo $cleaned_house_rules; ?>
						</textarea>
					</div> <br>
				
					<hr><br>
					<h4>You're ready to publish!</h4><br>
					<span>If you'd like to update your house rules,
					you can easily do all that after you hit publish.</span><br><br>
		
					<div class="inputfield terms">
						<label class="check">
							<input type="checkbox" required>
							<span class="checkmark"></span>
						</label>
						<p>Agreed to terms and conditions</p>
					</div> <br>
		
					<div class="inputfield">
						<input type="submit" name="form_booking_settings_submit" value="Save Changes" class="btn">
						<a href="manage-listing.php">
							<input type="button" value="Done Editing" class="btn2" style="width:150px;">
						</a>
					</div>

					<br>
					<?php
							}
						}
					}
				?>	
				</form>
			</div>
		</div>

		<footer><div id="footer-placeholder"></div></footer>
	</div>

	
</body>
</html>