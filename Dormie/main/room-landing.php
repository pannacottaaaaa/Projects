<?php
	require_once 'index-db.php';
	session_start();
		
	if(!isset($_SESSION['user_id'])) {
		header("Location: login-reg.php");
		exit();
	}	
		
	if(isset($_GET['id'])) {
		$connect = mysqli_connect('localhost', 'dormie', 'password', 'dormie', '3307');

		$listing_id = mysqli_real_escape_string($connect, $_GET['id']);

		$query = "SELECT * FROM listing WHERE listing_id=$listing_id";
		$result = mysqli_query($connect, $query) or die("Bad Query: $query");
		$row = mysqli_fetch_array($result);

		$user_id = $row['user_id'];
		$listing_id = $row['listing_id'];
		#$uquery = "SELECT u.first_name, u.last_name, u.last_name, u.email, u.contact_number, p.profile_picture FROM users WHERE user_id = $user_id";
		$uquery = "SELECT * FROM user u, profile p WHERE u.user_id = $user_id";
		$uresult = mysqli_query($connect, $uquery) or die("Bad Query: $uquery");
		$urow = mysqli_fetch_array($uresult);

		$photo_query = "SELECT * FROM photo WHERE listing_id = $listing_id";
		$photo_result = mysqli_query($connect, $photo_query);
		$prow = mysqli_fetch_assoc($photo_result);
		
		$aquery = "SELECT * FROM listing_amenities WHERE listing_id = $listing_id";
		$aresult = mysqli_query($connect, $aquery);
		$arow = mysqli_fetch_assoc($aresult);
		
		$profile_query = "SELECT * FROM profile WHERE user_id = $user_id";
		$profile_result = mysqli_query($connect, $profile_query) or die("Bad Query: $profile_query");
		$profile_row = mysqli_fetch_array($profile_result);
		
		$lquery = "SELECT * FROM listing_reqs WHERE listing_id = $listing_id";
		$lresult = mysqli_query($connect, $lquery ) or die("Bad Query: $lquery ");
		$lrow= mysqli_fetch_array($lresult);
	}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Details Page | Dormie</title>
    <link rel="stylesheet" href="styles/room-landing-style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&family=Ubuntu&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/afea27c44a.js" crossorigin="anonymous"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
	

	
	
	<script>
		$(function(){
			$("#nav-placeholder").load("nav.php");
			$("#footer-placeholder").load("footer.html");
        });
		
	</script>
	<style>
		.mySlides {display: none}

		/* Slideshow container */
		.slideshow-container {
			max-width: 500px;
			position: relative;
			margin: auto;
		}
		
		.slideshow-container img {vertical-align: middle;}
		
		/* Next & previous buttons */
		.prev, .next {
			background-color:#9F86C0;
			cursor: pointer;
			position: absolute;
			top: 50%;
			width: auto;
			padding: 16px;
			margin-top: -22px;
			color: white;
			font-weight: bold;
			font-size: 18px;
			transition: 0.6s ease;
			border-radius: 0 3px 3px 0;
			user-select: none;
		}

		/* Position the "next button" to the right */
		.next {
			right: 0;
			border-radius: 3px 0 0 3px;
		}

		/* On hover, add a black background color with a little bit see-through */
		.prev:hover, .next:hover {
			background-color: rgba(0,0,0,0.8);
		}

		/* The dots/bullets/indicators */
		.dot {
			cursor: pointer;
			height: 15px;
			width: 15px;
			margin: 0 2px;
			background-color: #bbb;
			border-radius: 50%;
			display: inline-block;
			transition: background-color 0.6s ease;
		}

		.active, .dot:hover {
			background-color: #717171;
		}

		/* Fading animation */
		.fade {
			animation-name: fade;
			animation-duration: 1.5s;
		}

		@keyframes fade {
			from {opacity: .4} 
			to {opacity: 1}
		}

		/* On smaller screens, decrease text size */
		@media only screen and (max-width: 300px) {
			.prev, .next,.text {font-size: 11px}
		}
		  .verified {
			background-color: green;
			color: white;
			padding: 5px;
			border-radius: 5px;
		  }
		  
		  .unverified {
			background-color: gray;
			color: white;
			padding: 5px;
			border-radius: 5px;
		  }
	</style>
</head>
<body>
	
	<div id="maingrid">
		<header id="header">
            <!--Navigation bar-->
            <?php include_once ("nav.php") ?>
            <!--end of Navigation bar-->
        </header>
		<div id="content">
			<div class="house-details">
				<div class="house-title">
					<h1><?php echo $row['listing_title'] ?></h1>
					<div>
					<?php
					  $verified_query = "SELECT * FROM profile WHERE user_id = {$_SESSION["user_id"]}" ;
					  $verified_result = mysqli_query($db, $verified_query);
					  $verified_record = mysqli_fetch_assoc( $verified_result );
					  $verified = $verified_record['is_verified'];
					  
					  if ($verified == TRUE) {
						echo "<span class='verified'>Verified</span>";
					  } else {
						echo "<span class='unverified'>Unverified</span>";
					  };
					?>
					</div>			
				</div>
				<div class="row">
					<div>
						<p><i class="fa-solid fa-location-dot"></i><?php echo " " . $row['city'] . ", " . $row['region'] ?></p>
					</div>
				</div>
				
				
				<div class="slideshow-container">
					<?php 
						while ($record = mysqli_fetch_assoc($photo_result)) {
							$pic = $record['photo_path'];
							echo "<button onclick='zoom()' class='mySlides fade'>
									<img src='images/{$pic}' style='width:100%'>
								</button>";
						};
						
						echo "
						<a class='prev' onclick='plusSlides(-1)'>&#10094;</a>
						<a class='next' onclick='plusSlides(1)'>&#10095;</a>

						<br>
						<div style='text-align:center'>";
						$i = 1;
						while ($record = mysqli_fetch_assoc($photo_result)) {
							echo "<span class='dot' onclick='currentSlide({$i})'></span> ";
							$i++;
						};
						echo "</div>";
					?>
				</div>
				
				<div class="small-details">
					<div class="profile"> 
						<?php 
							$username = $urow["username"];
							$profile_pic = $profile_row['profile_picture'];
							echo "<a href='landing-page-dormie.php?id={$username}' >
								<img  src='data:image/png;base64,".base64_encode($profile_pic)."'/>
							</a>";
						?>
						
					</div>
					<div class="hostname">
						<h2 >Entire unit hosted by 
							<?php
							echo $urow['first_name'];
							if($urow['middle_name'] != null) {
							  echo " " . $urow['middle_name'];
							}
							echo " " . $urow['last_name'];
							?>
						</h2>
					</div>
                    <?php
						$email = $urow['email'];
						if(!isset($_SESSION['user_id'])) {
							echo "<a class='contact' href='mailto:{$email}' style='display:none'>Contact Host</a>";
						} else {
							echo "<a class='contact' href='mailto:{$email}'>Contact Host</a>";
						}
					?>
					<div class="host">
						<ul>
							<li><i class="fa fa-users" aria-hidden="true"></i>  Accomodates <?php echo $row['capacity'] ?> Occupants</li> 
							<li><i class="fa fa-bed" aria-hidden="true"></i>  <?php echo $row['bedrooms'] ?> Bedrooms</li>
							<li><i class="fa fa-bath" aria-hidden="true"></i>  <?php echo $row['bathrooms'] ?> Bathrooms</li>
						</ul>
					</div>
					<div class="fee">
						<h4>₱ <?php echo $row['rent_fee'] ?> / month</h4>
					</div>
                </div>
				<hr class="line">
				<center><h2 style="grid-area:title;">Important Features</h2></center><br />
				<ul class="details-list">
					
					<div class="left" style="grid-area: left;">
                    <li><i class="fa-solid fa-house-chimney"></i>Private Room
                        <span>This dorm has private rooms and private bathrooms.</span>
                    </li>
                    <li><i class="fa-solid fa-calendar"></i>Move-In Date
						<?php
							$movein = strtotime($row['movein_start']);
							$movein_date = date('F j, Y', $movein);
							echo "<span>This location is ready for move-ins by {$movein_date}</span>"
						?>
                    </li>
                    <li><i class="fa-solid fa-location-dot"></i>Great Location
                        <?php
							if(!isset($_SESSION['user_id'])) {
								echo "<span><a href='login-reg.php'>Log-in to view all the details.<a/></span>";
							} else {
								$address = "{$row['street']}, {$row['city']}, {$row['region']} ({$row['zip_code']})";
								echo "<span>{$address}</span>";
							}
						?>
                    </li>
					</div>
					<div class="right" style="grid-area: right;">
                    <li><i class="fa-solid fa-heart amenities"></i>Many Amenities
						<ul>
							<?php 
							$wifi = $arow["wifi"]; 
							$television = $arow["television"];
							$aircon = $arow['air_condition'];
							$closet = $arow['closet_drawers'];
							$workspace = $arow['desk_workspace'];
							$wmachine = $arow['washing_machine'];
							$kitchenau = $arow['kitchen_appliances_utensils'];
							$smoke = $arow['smoke_detector'];
							$extinguisher = $arow['fire_extinguisher'];
							$firstaid = $arow['first_aid_kit'];

							/* NVM about this, too tired to handle this lol
							$amenities = array(
								"Wifi" => $wifi,
								"Television" => $television,
								"Air Condition" => $aircon,
								"Closet Drawers" => $closet,
								"Desk Workspace" => $workspace,
								"Washing Machine" => $wmachine,
								"Kitchen Appliances & Utensils" => $kitchenau,
								"Smoke Detector" => $smoke,
								"Extinguisher" => $extinguisher,
								"First Aid Kit" => $firstaid
							);*/
							
							if ($wifi == true) {
								echo '<li><i class="fa fa-wifi" aria-hidden="true"></i><span>Wifi</span></li>';
							} else {
								echo "<li style='display:none'></li>";
							}		

							if ($television == true) {
								echo '<li><i class="fa fa-television" aria-hidden="true"></i><span>Television</span></li>';
							} else {
								echo "<li style='display:none'></li>";
							}	
							
							if ($aircon == true) {
								echo '<li><i class="fa fa-snowflake-o" aria-hidden="true"></i><span>Air Conditioner</span></li>';
							} else {
								echo "<li style='display:none'></li>";
							}	
							
							if ($closet == true) {
								echo '<li><i class="fa fa-suitcase" aria-hidden="true"></i><span>Closet Drawers</span></li>';
							} else {
								echo "<li style='display:none'></li>";
							}	
							
							if ($workspace == true) {
								echo '<li><i class="fa fa-lightbulb-o" aria-hidden="true"></i><span>Desk Workspace</span></li>';
							} else {
								echo "<li style='display:none'></li>";
							}	
							
							if ($wmachine == true) {
								echo '<li><i class="fa fa-shopping-basket" aria-hidden="true"></i><span>Washing Machine</span></li>';
							} else {
								echo "<li style='display:none';></li>";
							}	
							
							if ($kitchenau == true) {
								echo '<li><i class="fa fa-spoon" aria-hidden="true"></i><span>Kitchen Appliances & Utensils</span></li>';
							} else {
								echo "<li style='display:none';></li>";
							}	
							
							if ($smoke == true) {
								echo '<li><i class="fa fa-fire" aria-hidden="true"></i><span>Smoke Detector</span></li>';
							} else {
								echo "<li style='display:none';></li>";
							}	
							
							if ($extinguisher == true) {
								echo '<li><i class="fa fa-fire-extinguisher" aria-hidden="true"></i><span>Fire Extinguisher</span></li>';
							} else {
								echo "<li style='display:none';></li>";
							}	
							
							if ($firstaid == true) {
								echo '<li><i class="fa fa-medkit" aria-hidden="true"></i><span>First Aid Kit</span></li>';
							} else {
								echo "<li style='display:none';></li>";
							}	
							?>
						</ul>
                    </li>
					</div>
                </ul>
				<hr class="line">
				<center><h2>Home Description</h2></center><br />
				<?php 
					$desc = $row['description'];
					echo "<p class='home-desc'>{$desc}</p>"
                ?>
				<center><h3>House Rules</h3></center><br />
				<?php 
					$hrules = $lrow['house_rules'];
					echo "<p class='home-desc'>{$hrules}</p>"
                ?>
				<hr class="line">
				<div class="map">
                    <h3>Location on Map</h3>
					<?php
						if(!isset($_SESSION['user_id'])) {
							echo "<span><a href='login-reg.php'>Log-in to view all the details.<a/></span>";
						} else {
							echo "<iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61788.47428794739!2d120.9981702607593!3d14.554590096842803!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c90264a0ed01%3A0x2b066ed57830cace!2sMakati%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1675000984144!5m2!1sen!2sph' width='600' height='450' style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe>";
							echo "<b>Makati, Metro Manila</b>";
						};
					?>
                </div>
			</div>
		</div>
		<footer id="footer">
            <!--Navigation bar-->
            <?php include_once ("footer.html") ?>
            <!--end of Navigation bar-->
        </footer>
	</div>
	

	<script>
		let slideIndex = 1;
		showSlides(slideIndex);

		function plusSlides(n) {
			showSlides(slideIndex += n);
		}

		function currentSlide(n) {
			showSlides(slideIndex = n);
		}

		function showSlides(n) {
			let i;
			let slides = document.getElementsByClassName("mySlides");
			let dots = document.getElementsByClassName("dot");
			if (n > slides.length) {slideIndex = 1}    
			if (n < 1) {slideIndex = slides.length}
			for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";  
			}
			for (i = 0; i < dots.length; i++) {
				dots[i].className = dots[i].className.replace(" active", "");
			}
			slides[slideIndex-1].style.display = "block";  
			dots[slideIndex-1].className += " active";
		}
		
		function zoom() {
		  var slide = event.target.closest('.mySlides');
		  slide.style.transform = 'scale(1.5)';
		  slide.style.position = 'relative';
		  slide.style.zIndex = '9999';
		  slide.style.border = '5px solid #9F86C0';

		  var timer = setTimeout(function() {
			slide.style.transform = 'scale(1)';
			slide.style.position = '';
			slide.style.zIndex = '';
			slide.style.border = '';
		  }, 5000);

		  slide.addEventListener('mouseout', function() {
			clearTimeout(timer);
			slide.style.transform = 'scale(1)';
			slide.style.position = '';
			slide.style.zIndex = '';
			slide.style.border = '';
		  });
		}
	</script>
</body>
</html> 