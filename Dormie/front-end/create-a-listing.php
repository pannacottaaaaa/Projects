<?php
require_once 'index-db.php';
    global $db;
    //$connect = mysqli_connect('localhost', 'dormie', 'password', 'dormie', '3307');

    session_start();

    if(!isset($_SESSION["user_id"])) {
        $message = "You must be logged in to access this page!";
		echo '<script type="text/javascript">';
		echo 'alert("' . $message . '");
		window.location.href="login-reg.php";';
		echo '</script>';
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Message Inbox">
  <meta name="keywords" content="HTML,CSS">
  <meta name="author" content="Dormie">
  <title>Create a Listing | Dormie</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>

  <!-- LIBRARIES -->
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<link rel="stylesheet" href="styles/create_listing_style.css">
	<link rel="stylesheet" href="file-uploading.css">
	<link rel="stylesheet" href="file-uploading-js.js">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


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
		padding-left: 5%;
		padding-right: 5%;
		padding-bottom: 2.5%;
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
  </style>
</head>

<body>
	<div id="maingrid">
		<header><?php include_once ("nav.php") ?></header>

		<div id="content">
			<div class="head">
				<h1>Create a Listing</h1>
			</div>

			<form action="process-create-a-listing.php" method="post" enctype="multipart/form-data">
				<div class="wrapper">
					<div class="form">
						<div class="title">
							Properties and Dormies
						</div>

						<!-- tried merging these but one "inputfield" is equal to one row -->
						<div class="inputfield">
							<label>What type of place are you listing?</label>
							<input name="listing_type" list="listing_type" class="input" placeholder="Shared or Private" required>
							<datalist id="listing_type">
								<option value="Shared">
								<option value="Private">
							</datalist>
						</div>
						<div class="inputfield">
							<label>How many Dormies can your place accomodate?</label>
							<input type="number" name="capacity" class="input" placeholder="Enter number of Dormies" required min="1" max="30" step="1" title="Please enter number greater than 0.">
						</div>
						<div class="inputfield">
							<label>How many bedrooms can Dormies use?</label>
							<input type="text" name="bedrooms" class="input" placeholder="Enter number of bedrooms" required min="1">
						</div>
						<div class="inputfield">
							<label>How many bathrooms can your Dormies use?</label>
							<input type="number" name="bathrooms" class="input" placeholder="Enter number of bathrooms" required min="1">
						</div>
						<div class="inputfield">
							<label>How much would the monthly rent be?</label>
							<input type="number" name="rent_fee" class="input" placeholder="Enter monthly rent" required min="1">
						</div>
						<div class="inputfield">
							<label for="movein_start">When would your place be ready for moveins?</label>
							<input type="date" name="movein_start" class="input" required>
						</div>
					</div>
				</div><br>
				
				
				<div class="wrapper">
					<div class="title">Location</div>
						<div class="form">
							<h4>Where's your place located?</h4>
							<div class="input-box address">
							<input type="text" name="street" placeholder="Enter street address" required />
							<div class="column">
								<input type="text" name="city" placeholder="Enter your city" required />
							</div>
							<div class="column">
								<input type="text" name="region" placeholder="Enter your region" required />
								<input type="number" name="zip_code" placeholder="Enter zip code" required />
							</div>
						</div>
					</div>
				</div><br>
			
				<div class="wrapper">
					<div class="title">Amenities</div>
					<div class="form">
						<h4>What amenities do you offer?</h4><br>
						<div class="rowx">
							<div class="columnx">
								<div class="page">
									<div class="page__section">
										<div class="page__toggle">
											<label class="toggle">
												<input name="wifi" class="toggle__input" type="checkbox" value=1 checked>
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
												<input name="air_condition" class="toggle__input" type="checkbox" value=1 checked>
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
												<input name="desk_workspace" class="toggle__input" type="checkbox" value=1 checked>
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
												<input name="kitchen_appliances_utensils" class="toggle__input" type="checkbox" value=1 checked>
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
												<input name="fire_extinguisher" class="toggle__input" type="checkbox" value=1 checked>
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
												<input name="television" class="toggle__input" type="checkbox" value=1 checked>
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
												<input name="closet_drawers" class="toggle__input" type="checkbox" value=1 checked>
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
												<input name="washing_machine" class="toggle__input" type="checkbox" value=1 checked>
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
												<input name="smoke_detector" class="toggle__input" type="checkbox" value=1 checked>
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
												<input name="first_aid_kit" class="toggle__input" type="checkbox" value=1 checked>
												<span class="toggle__label">
													<span class="toggle__text">First Aid Kit</span>
												</span>
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				
				<!-- Upload Pictures -->
				<!-- i think this might be separated from the rest of the form? or adjusted so that it's part of the form
				<div class="wrapper">
					<div class="title">Photos</div>
					<div id="dropBox">
						<p>Drag & Drop Images Here</p><br>
						<form class="imgUploader">
							<input type="file" id="imgUpload" multiple accept="image/*" onchange="filesManager(this.files)">
							<label class="button" for="imgUpload">or Upload From Your Computer</label>
						</form>
						<div id="gallery"></div>
					</div>
				</div><br>
				-->

				<!-- Trying the adjusted version out here -->
				<div class="wrapper">
					<div class="title">Photos</div>
					<div id="dropBox">
						<input class="button" type="file" name="files[]" id="image-input" multiple>
					</div>
				</div><br>
			
				<div class="wrapper">
					<div class="title">Description</div>
					<div class="form">
						<h4>Describe your place to guests</h4>
						<span>Mention the best features of your space, and what you love about the neighborhood.</span><br><br>
						<div class="inputfield">
							<label>Describe your place to guests</label>
							<textarea name="description" class="textarea" placeholder="Mention the best features of your space, and what you love about the neighborhood."></textarea>
						</div>
						<div class="inputfield">
							<label>Create a title for your listing</label>
							<input name="listing_title" type="text" class="input" placeholder="Catch guest's attention with a listing title that highlights what makes your place special." required>
						</div>
						<div class="inputfield">
							<label>Add your mobile number</label>
							<input name="phone_number" id="phonenum" type="tel" pattern="^\d{11}$"  placeholder="format: 09XX-XXX-XXXX. This number should be able to receive texts or calls." required>
						</div>
					</div>
				</div><br>
			
				<div class="wrapper">
					<h4>Add additional requirements:</h4>
					<div class="page">
						<div class="page__section">
							<div class="page__toggle">
								<label class="toggle">
									<input class="toggle__input" type="checkbox" checked>
									<span class="toggle__label">
									<span class="toggle__text">Government-issued ID submitted to Dormie</span>
									</span>
								</label>
							</div>
						</div>
					</div><br>
					<<h4>Set house rules for your Dormies</h4>
					<span>Dormies must agree to your house rules before they book.</span><br><br>
					<div class="form">
						<div class="inputfield">
							<textarea name="house_rules" class="textarea" placeholder="Ex: Suitable for pets, No drinking allowed, No parties..."></textarea>
						</div> <br>
					</div>
					<hr><br>
					<h4>You're ready to publish!</h4><br>
					<span>If you'd like to update your house rules,
					you can easily do all that after you hit publish.</span><br><br>

					<div class="form">
						<div class="inputfield terms">
							<label class="check">
								<input type="checkbox">
								<span class="checkmark"></span>
							</label>
							<p>Agree to Terms and Conditions</p>
						</div> <br>
			
						<div class="inputfield">
							<input type="submit" value="submit" class="btn">
							<!--<input type="" value="Edit Listing" class="btn2">-->
						</div>
					</div>
				</div>
			</form>

		</div>

		<footer><div id="footer-placeholder"></div></footer>
	</div>
</body>
</html>
