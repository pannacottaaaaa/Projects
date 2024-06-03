<?php
    require_once 'index-db.php';
	session_start();

	if(!isset($_SESSION['user_id'])) {
		header("Location: login-reg.php");
		exit();
	}

	function getMyDorms(){
        global $db;
        $query = "SELECT * FROM listing WHERE user_id = {$_SESSION["user_id"]}" ;
        $result = mysqli_query($db, $query);

        while( $record = mysqli_fetch_assoc( $result ) )
        {
				// gets the first photo of the listing
				$photo_query = "SELECT * FROM photo WHERE listing_id = {$record['listing_id']} ORDER BY photo_id ASC LIMIT 1";
				$photo_result = mysqli_query($db, $photo_query);

				$photo_record = mysqli_fetch_assoc($photo_result);

				$date = strtotime($record["movein_start"]);
				// change href to edit-listing
				echo "<a href='room-landing.php?id={$record['listing_id']}'>   
				<div class='dorm-card'>
				<div class='dorm-pic'>
					<img src='images/" . $photo_record["photo_path"] . "' alt='Dorm picture' >
				</div>
				<div class='dorm-name'>
					<p>" . $record["listing_title"] . "</p>
				</div>
				<div class='dorm-loc'>
					<i class='bi bi-pin-map-fill'></i>" . $record["city"] ."
				</div>
				<div class='dorm-bedroom-movein'>
					<span>". $record["bedrooms"] ."-Bedroom | " . date("F j, Y", $date) ."</span>
				</div>";
				//echo "<button class='dorm-edit'>WiFi</button>";
				$id = $record['listing_id'];
				$tagquery = "SELECT * FROM listing_amenities WHERE listing_id = $id";
				$tagresult = mysqli_fetch_assoc(mysqli_query($db, $tagquery));
				$tagcount = 0;
				echo "<div class='dorm-tags'>";
				while ($tagcount < 3) {
					if ($tagresult['wifi'] == true) {
						echo "<button class='dorm-tag'>WiFi</button>";
						$tagcount += 1;
					}
					if ($tagresult['television'] == true) {
						echo "<button class='dorm-tag'>TV</button>";
						$tagcount += 1;
					}
					if ($tagresult['air_condition'] == true) {
						echo "<button class='dorm-tag'>AC</button>";
						$tagcount += 1;
					}	
					if ($tagresult['closet_drawers'] == true) {
						if ($tagcount > 2) {
							break;
						}
						echo "<button class='dorm-tag'>Storage</button>";
						$tagcount += 2;
					}	
					if ($tagresult['desk_workspace'] == true) {
						if ($tagcount > 2) {
							break;
						}
						echo "<button class='dorm-tag'>Desk</button>";
						$tagcount += 1;
					}
					if ($tagresult['kitchen_appliances_utensils'] == true) {
						if ($tagcount > 2) {
							break;
						}
						echo "<button class='dorm-tag'>Kitchen</button>";
						$tagcount += 1;
					}
					if ($tagresult['smoke_detector'] == true) {
						if ($tagcount > 2) {
							break;
						}
						echo "<button class='dorm-tag'>Smoke Detector</button>";
						$tagcount += 2;
					}
					if ($tagresult['fire_extinguisher'] == true) {
						if ($tagcount > 2) {
							break;
						}
						echo "<button class='dorm-tag'>Fire Extinguisher</button>";
						$tagcount += 2;
					}
					if ($tagresult['first_aid_kit'] == true) {
						if ($tagcount > 2) {
							break;
						}
						echo "<button class='dorm-tag'>First Aid</button>";
						$tagcount += 2;
					}
					if ($tagcount < 3) {
						break;
					}
				}
				if ($tagcount>=2){
					echo "<button class='dorm-tag-more'>See More</button></div>";
				}

				echo "<div class='dorm-budget'>₱". $record['rent_fee']."/month</div>
				<div class='dorm-slot'>Finding ". $record['capacity'].""; 
				if ($record['capacity'] > 1) {
					echo " Dormies</div>
					</div>
					</a>";
				} else {
					echo " Dormie</div>
					</div>
					</a>";
				}
        }
    }

	function searchDormLoc() {
		global $db;
		$searchDorm = $_POST['search'];
		$searchDorm = preg_replace("#[^0-9a-z]#i", "", $searchDorm);

		$query = mysqli_query($db, "SELECT * FROM listing WHERE (city LIKE '%$searchDorm%' 
		or street LIKE '%$searchDorm%'
		or zip_code LIKE '%$searchDorm%'
		or region LIKE '%$searchDorm%') 
		AND WHERE user_id = {$_SESSION['user_id']}") or die("Could not search! ");
		$count = mysqli_num_rows($query);

		if($count == 0) {
            echo "There are no matching results.";
        } else {
			while($record = mysqli_fetch_array($query)) {
					$date = strtotime($record["movein_start"]);
					echo "<a href='room-landing.php?id={$record['listing_id']}'>
					<div class='dorm-card'>
					<div class='dorm-pic'>
						<img src='images/" . $record["photos"] . "' alt='Dorm picture' >
					</div>
					<div class='dorm-name'>
						<p>" . $record["listing_title"] . "</p>
					</div>
					<div class='dorm-loc'>
						<i class='bi bi-pin-map-fill'></i>" . $record["city"] ."
					</div>
					<div class='dorm-bedroom-movein'>
						<span>". $record["bedrooms"] ."-Bedroom | " . date("F j, Y", $date) ."</span>
					</div>";
	
					$id = $record['listing_id'];
					$tagquery = "SELECT * FROM listing_amenities WHERE listing_id = '$id'";
					$tagresult = mysqli_fetch_assoc(mysqli_query($db, $tagquery));
					$tagcount = 0;
					echo "<div class='dorm-tags'>";
					while ($tagcount < 3) {
						if ($tagresult['wifi'] == true) {
							echo "<button class='dorm-tag'>zFi</button>";
							$tagcount += 1;
						}
						if ($tagresult['television'] == true) {
							echo "<button class='dorm-tag'>TV</button>";
							$tagcount += 1;
						}
						if ($tagresult['air_condition'] == true) {
							echo "<button class='dorm-tag'>AC</button>";
							$tagcount += 1;
						}	
						if ($tagresult['closet_drawers'] == true) {
							if ($tagcount > 2) {
								break;
							}
							echo "<button class='dorm-tag'>Storage</button>";
							$tagcount += 2;
						}	
						if ($tagresult['desk_workspace'] == true) {
							if ($tagcount > 2) {
								break;
							}
							echo "<button class='dorm-tag'>Desk</button>";
							$tagcount += 1;
						}
						if ($tagresult['kitchen_appliances_utensils'] == true) {
							if ($tagcount > 2) {
								break;
							}
							echo "<button class='dorm-tag'>Kitchen</button>";
							$tagcount += 1;
						}
						if ($tagresult['smoke_detector'] == true) {
							if ($tagcount > 2) {
								break;
							}
							echo "<button class='dorm-tag'>Smoke Detector</button>";
							$tagcount += 2;
						}
						if ($tagresult['fire_extinguisher'] == true) {
							if ($tagcount > 2) {
								break;
							}
							echo "<button class='dorm-tag'>Fire Extinguisher</button>";
							$tagcount += 2;
						}
						if ($tagresult['first_aid_kit'] == true) {
							if ($tagcount > 2) {
								break;
							}
							echo "<button class='dorm-tag'>First Aid</button>";
							$tagcount += 2;
						}
						if ($tagcount < 3) {
							break;
						}
					}
					if ($tagcount>=2){
						echo "<button class='dorm-tag-more'>See More</button></div>";
					}
	
					echo "<div class='dorm-budget'>₱". $record['rent_fee']."/month</div>
					<div class='dorm-slot'>Finding ". $record['capacity'].""; 
					if ($record['capacity'] > 1) {
						echo " Dormies</div>
						</div>
						</a>";
					} else {
						echo " Dormie</div>
						</div>
						</a>";
					}
			}
		}
	}
	
	function filterDorms() {
		global $db;
        $query = "SELECT * FROM listing WHERE user_id = {$_SESSION["user_id"]}";
        $result = mysqli_query($db, $query);
        $searchListing = '';
        $searchBedrooms = '';
        $searchBudget = '';
        $searchAmenities = '';
        $searchDate = '';

        if(isset($_POST['listing'])) {
            $searchListing = $_POST['listing'];
            $searchListing = preg_replace("#[^0-9a-z]#i","",$searchListing);
            $subquery = $query;
            
            $query = "SELECT * FROM ($subquery) as a WHERE listing_type = '$searchListing'";
            $result = mysqli_query($db, $query);
        }
        else  {
            $searchListing = NULL;
        }

        if(isset($_POST['bedrooms'])) {
            $searchBedrooms = $_POST['bedrooms'];
            $searchBedrooms = preg_replace("#[^0-9]#i","",$searchBedrooms);
            $subquery = $query;

			if ($searchBedrooms > 3) {
				$query = "SELECT * FROM ($subquery) AS b WHERE bedrooms >= $searchBedrooms";
			} else {
				$query = "SELECT * FROM ($subquery) AS b WHERE bedrooms = $searchBedrooms";
			}
            $result = mysqli_query($db, $query);
        }
        else  {
            $searchBedrooms = NULL;
        }
		
        if(isset($_POST['budget'])) {
            $searchBudget = $_POST['budget'];
            $searchBudget = preg_replace("#[^0-9]#i","",$searchBudget);
            $subquery = $query;

            $query = "SELECT * FROM ($subquery) AS b WHERE rent_fee < $searchBudget";
            $result = mysqli_query($db, $query);
        }
        else  {
            $searchBudget = NULL;
        }

        if(isset($_POST['date'])) {
            $searchDate = $_POST['date'];
            $searchDate = preg_replace("#[^0-9]#i","",$searchDate);
            $subquery = $query;

            if ($searchDate) {    
                $query = "SELECT * FROM ($subquery) AS b WHERE movein_start BETWEEN DATE_SUB('$searchDate', INTERVAL 35 DAY) AND DATE_ADD('$searchDate', INTERVAL 35 DAY)";
                $result = mysqli_query($db, $query);
            }
        }
        else  {
            $searchDate = NULL;
        }
		
		if(isset($_POST['wifi'])) {
			$searchWifi = $_POST['wifi'];
			$searchWifi = preg_replace("#[^0-9a-z]#i","",$searchWifi);
			$subquery = $query;

			$amenquery = "SELECT listing_id FROM listing_amenities WHERE wifi = 1";
			$query = "SELECT * FROM ($subquery) AS b WHERE listing_id IN ($amenquery)";
			$result = mysqli_query($db, $query);
		}
		else  {
			$searchWifi = NULL;
		}
		
		if(isset($_POST['air_condition'])) {
			$searchAC = $_POST['air_condition'];
			$searchAC = preg_replace("#[^0-9a-z]#i","",$searchAC);
			$subquery = $query;

			$amenquery = "SELECT listing_id FROM listing_amenities WHERE air_condition = 1";
			$query = "SELECT * FROM ($subquery) AS b WHERE listing_id IN ($amenquery)";
			$result = mysqli_query($db, $query);
		}
		else  {
			$searchAC = NULL;
		}
		
		if(isset($_POST['television'])) {
			$searchTV = $_POST['television'];
			$searchTV = preg_replace("#[^0-9a-z]#i","",$searchTV);
			$subquery = $query;

			$amenquery = "SELECT listing_id FROM listing_amenities WHERE television = 1";
			$query = "SELECT * FROM ($subquery) AS b WHERE listing_id IN ($amenquery)";
			$result = mysqli_query($db, $query);
		}
		else  {
			$searchTV = NULL;
		}
		
		if(isset($_POST['closet_drawers'])) {
			$searchStorage = $_POST['closet_drawers'];
			$searchStorage = preg_replace("#[^0-9a-z]#i","",$searchStorage);
			$subquery = $query;

			$amenquery = "SELECT listing_id FROM listing_amenities WHERE closet_drawers = 1";
			$query = "SELECT * FROM ($subquery) AS b WHERE listing_id IN ($amenquery)";
			$result = mysqli_query($db, $query);
		}
		else  {
			$searchStorage = NULL;
		}
		
		if(isset($_POST['desk_workspace'])) {
			$searchDesk = $_POST['desk_workspace'];
			$searchDesk = preg_replace("#[^0-9a-z]#i","",$searchDesk);
			$subquery = $query;

			$amenquery = "SELECT listing_id FROM listing_amenities WHERE desk_workspace = 1";
			$query = "SELECT * FROM ($subquery) AS b WHERE listing_id IN ($amenquery)";
			$result = mysqli_query($db, $query);
		}
		else  {
			$searchDesk = NULL;
		}
		
		if(isset($_POST['kitchen_appliances_utensils'])) {
			$searchKitchen = $_POST['kitchen_appliances_utensils'];
			$searchKitchen = preg_replace("#[^0-9a-z]#i","",$searchKitchen);
			$subquery = $query;

			$amenquery = "SELECT listing_id FROM listing_amenities WHERE kitchen_appliances_utensils = 1";
			$query = "SELECT * FROM ($subquery) AS b WHERE listing_id IN ($amenquery)";
			$result = mysqli_query($db, $query);
		}
		else  {
			$searchKitchen = NULL;
		}
		
		if(isset($_POST['smoke_detector'])) {
			$searchSmoke = $_POST['smoke_detector'];
			$searchSmoke = preg_replace("#[^0-9a-z]#i","",$searchSmoke);
			$subquery = $query;

			$amenquery = "SELECT listing_id FROM listing_amenities WHERE smoke_detector = 1";
			$query = "SELECT * FROM ($subquery) AS b WHERE listing_id IN ($amenquery)";
			$result = mysqli_query($db, $query);
		}
		else  {
			$searchSmoke = NULL;
		}
		
		if(isset($_POST['fire_extinguisher'])) {
			$searchFire = $_POST['fire_extinguisher'];
			$searchFire = preg_replace("#[^0-9a-z]#i","",$searchFire);
			$subquery = $query;

			$amenquery = "SELECT listing_id FROM listing_amenities WHERE fire_extinguisher = 1";
			$query = "SELECT * FROM ($subquery) AS b WHERE listing_id IN ($amenquery)";
			$result = mysqli_query($db, $query);
		}
		else  {
			$searchFire = NULL;
		}
		
		if(isset($_POST['first_aid_kit'])) {
			$searchFirst = $_POST['first_aid_kit'];
			$searchFirst = preg_replace("#[^0-9a-z]#i","",$searchFirst);
			$subquery = $query;

			$amenquery = "SELECT listing_id FROM listing_amenities WHERE first_aid_kit = 1";
			$query = "SELECT * FROM ($subquery) AS b WHERE listing_id IN ($amenquery)";
			$result = mysqli_query($db, $query);
		}
		else  {
			$searchFirst = NULL;
		}

        $count = mysqli_num_rows($result);
        if($count == 0) {
            echo "There are no matching results.";
        } else {
			while($record = mysqli_fetch_assoc($result)) {
					$date = strtotime($record["movein_start"]);
					echo "<a href='room-landing.php?id={$record['listing_id']}'>
					<div class='dorm-card'>
					<div class='dorm-pic'>
						<img src='images/" . $record["photos"] . "' alt='Dorm picture' >
					</div>
					<div class='dorm-name'>
						<p>" . $record["listing_title"] . "</p>
					</div>
					<div class='dorm-loc'>
						<i class='bi bi-pin-map-fill'></i>" . $record["city"] ."
					</div>
					<div class='dorm-bedroom-movein'>
						<span>". $record["bedrooms"] ."-Bedroom | " . date("F j, Y", $date) ."</span>
					</div>";
	
					$id = $record['listing_id'];

					$tagquery = "SELECT * FROM listing_amenities WHERE listing_id = '$id'";
					$tagresult = mysqli_fetch_assoc(mysqli_query($db, $tagquery));
					$tagcount = 0;
					echo "<div class='dorm-tags'>";
					while ($tagcount < 3) {
						if ($tagresult['wifi'] == true) {
							echo "<button class='dorm-tag'>WiFi</button>";
							$tagcount += 1;
						}
						if ($tagresult['television'] == true) {
							echo "<button class='dorm-tag'>TV</button>";
							$tagcount += 1;
						}
						if ($tagresult['air_condition'] == true) {
							echo "<button class='dorm-tag'>AC</button>";
							$tagcount += 1;
						}	
						if ($tagresult['closet_drawers'] == true) {
							if ($tagcount > 2) {
								break;
							}
							echo "<button class='dorm-tag'>Storage</button>";
							$tagcount += 2;
						}	
						if ($tagresult['desk_workspace'] == true) {
							if ($tagcount > 2) {
								break;
							}
							echo "<button class='dorm-tag'>Desk</button>";
							$tagcount += 1;
						}
						if ($tagresult['kitchen_appliances_utensils'] == true) {
							if ($tagcount > 2) {
								break;
							}
							echo "<button class='dorm-tag'>Kitchen</button>";
							$tagcount += 1;
						}
						if ($tagresult['smoke_detector'] == true) {
							if ($tagcount > 2) {
								break;
							}
							echo "<button class='dorm-tag'>Smoke Detector</button>";
							$tagcount += 2;
						}
						if ($tagresult['fire_extinguisher'] == true) {
							if ($tagcount > 2) {
								break;
							}
							echo "<button class='dorm-tag'>Fire Extinguisher</button>";
							$tagcount += 2;
						}
						if ($tagresult['first_aid_kit'] == true) {
							if ($tagcount > 2) {
								break;
							}
							echo "<button class='dorm-tag'>First Aid</button>";
							$tagcount += 2;
						}
						if ($tagcount < 3) {
							break;
						}
					}
					if ($tagcount>=2){
						echo "<button class='dorm-tag-more'>See More</button></div>";
					}
	
					echo "<div class='dorm-budget'>₱". $record['rent_fee']."/month</div>
					<div class='dorm-slot'>Finding ". $record['capacity'].""; 
					if ($record['capacity'] > 1) {
						echo " Dormies</div>
						</div>
						</a>";
					} else {
						echo " Dormie</div>
						</div>
						</a>";
					}
			}
		}
	}

?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Message Inbox">
  <meta name="keywords" content="HTML,CSS">
  <meta name="author" content="Dormie">
  <title>
    Manage Listing | Dormie
  </title>
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- libraries -->
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="styles/cols.css">
	<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  
  <!-- Scripts for Navbar and Footer Import -->
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script>
  $(function(){
  $("#nav-placeholder").load("nav.html");
  $("#footer-placeholder").load("footer.html");
  });
  </script>

	<!-- Script for Responsive Map -->
	<script>
		window.addEventListener('resize', adjustMapSize);
		function adjustMapSize() {
			let width = $(window).innerWidth();
			if (width < 599) {
				document.getElementById("gmap").style.width = "325";
			} else if (width < 799) {
				document.getElementById("gmap").style.width = "600";
			} else if (width < 999) {
				document.getElementById("gmap").style.width = "500";
			} else if (width < 1299) {
				document.getElementById("gmap").style.width = "1000";
			} else {
				document.getElementById("gmap").style.width = "1200";
			}
		}
	</script>

</head>

<body>
	<div id="maingrid">
		<div id="header">
			<nav><?php include_once ("nav.php") ?></nav>
		</div>
		
		<div id="content">
			<h1>Manage Listing</h1>

			<div class="dorm-grid">
                <form method="post" id="searchbar">
                    <input type="search" id="search" name="search" placeholder="Search Location">
                    <input type="submit" hidden />
                </form>

				<div class="filters">
					<form method="post">
						<div class="dropdown" id="date-dropdown">
							<button class="filter-btn"><i class="bi bi-calendar-event-fill"></i>   Move-in Date</button>
							<div class="dropdown-content">
								<p>Results will show +/- 35 days from the inputted date. The exact date can be found in the actual dorm listing. </p>
								<input type ="date" name="date">
							</div>
						</div>
						<div class="dropdown" id="budget-dropdown">
						<button class="filter-btn"><i class="bi bi-piggy-bank-fill"></i>   Max Budget</button>
								<div class="dropdown-content">
									<input type="radio" id="3k" name="budget" value="3,000">
									<label for="3k">₱3,000</label><br>
									<input type="radio" id="5k" name="budget" value="5,000">
									<label for="5k">₱5,000</label><br>
									<input type="radio" id="10k" name="budget" value="10,000">
									<label for="10k">₱10,000</label><br>
									<input type="radio" id="15k" name="budget" value="15,000">
									<label for="15k">₱15,000</label><br>
									<input type="radio" id="20k" name="budget" value="20,000">
									<label for="20k">₱20,000</label><br>
									<input type="radio" id="30k" name="budget" value="30,000">
									<label for="30k">₱30,000</label><br>
									<input type="radio" id="30k+" name="budget" value="100,000">
									<label for="30k+">Above ₱30,000</label><br>
								</div>
						</div>
						<div class="dropdown" id="listing-dropdown">
							<button class="filter-btn"><i class="bi bi-door-open-fill"></i>   Listing Type</button>
							<div class="dropdown-content">
								<input type="radio" id="shared" name="listing" value="shared">
								<label for="shared">Shared Room</label><br>
								<input type="radio" id="private" name="listing" value="private">
								<label for="private">Private Room</label><br>
							</div>
						</div>
						<div class="dropdown" id="gender-dropdown">
							<button class="filter-btn"><i class="bi bi-hash"></i>   Bedrooms</button>
							<div class="dropdown-content">
								<input type="radio" id="1" name="bedrooms" value="1">
								<label for="1">1</label><br>
								<input type="radio" id="2" name="bedrooms" value="2">
								<label for="2">2</label><br>
								<input type="radio" id="3" name="bedrooms" value="3">
								<label for="3">3</label><br>
								<input type="radio" id="4+" name="bedrooms" value="4+">
								<label for="4+">4 or more</label><br>
							</div>
						</div>
						<div class="dropdown" id="amenities-dropdown">
							<button class="filter-btn"><i class="bi bi-clipboard-check-fill"></i>   Amenities</button>
							<div class="dropdown-content">
									<input type="checkbox" id="air_condition" name="air_condition" value="air_condition">
									<label for="air_condition">Airconditioning</label><br>
									<input type="checkbox" id="wifi" name="wifi" value="wifi">
									<label for="wifi">WiFi</label><br>
									<input type="checkbox" id="television" name="television" value="television">
									<label for="television">TV</label><br>
									<input type="checkbox" id="closet_drawers" name="closet_drawers" value="closet_drawers">
									<label for="closet_drawers">Closet/Drawers</label><br>
									<input type="checkbox" id="desk_workspace" name="desk_workspace" value="desk_workspace">
									<label for="desk_workspace">Desk/Workspace</label><br>
									<input type="checkbox" id="washing_machine" name="washing_machine" value="washing_machine">
									<label for="washing_machine">Smoke Alarm</label><br>
									<input type="checkbox" id="kitcken_appliances_utensils" name="kitcken_appliances_utensils" value="kitcken_appliances_utensils">
									<label for="kitcken_appliances_utensils">Kitchen Appliances/Utensils</label><br>
									<input type="checkbox" id="smoke_detector" name="smoke_detector" value="smoke_detector">
									<label for="smoke_detector">Smoke Detector</label><br>
									<input type="checkbox" id="fire_extinguisher" name="fire_extinguisher" value="fire_extinguisher">
									<label for="fire_extinguisher">Fire Extinguisher</label><br>
									<input type="checkbox" id="first_aid_kit" name="first_aid_kit" value="first_aid_kit">
									<label for="first_aid_kit">First Aid Kit</label><br>
							</div>
							<!-- BACKUP
								
							<div class="dropdown-content">
									<input type="checkbox" id="ac" name="amenities" value="ac">
									<label for="ac">Airconditioning</label><br>
									<input type="checkbox" id="wifi" name="amenities" value="wifi">
									<label for="wifi">WiFi</label><br>
									<input type="checkbox" id="elevator" name="amenities" value="elevator">
									<label for="elevator">Elevator</label><br>
									<input type="checkbox" id="utilities" name="amenities" value="utilities">
									<label for="utilities">Utilities Inlcuded</label><br>
									<input type="checkbox" id="furnished" name="amenities" value="furnished">
									<label for="furnished">Furnished</label><br>
									<input type="checkbox" id="smokealarm" name="amenities" value="smokealarm">
									<label for="smokealarm">Smoke Alarm</label><br>
									<input type="checkbox" id="firstaid" name="amenities" value="firstaid">
									<label for="firstaid">First Aid Kit</label><br>
									<input type="checkbox" id="extinguisher" name="amenities" value="extinguisher">
									<label for="extinguisher">Fire Extinguisher</label><br>
							</div>
							-->
						</div>
                        <input type="submit" class="filter-btn" id="apply" name="apply" value ="Apply" onclick="submit();"></input>
                        <input type="submit" class="filter-btn" id="clear" name="clear" value ="Clear" onclick="submit();"></input>
					</form>
					<!-- <button class="filter-btn"><i class="bi bi-geo-alt-fill"></i>   Location</button> -->
					
				</div>
				<?php

                if(array_key_exists('search', $_POST)) {
                    searchDormLoc();
                } else if (array_key_exists('apply', $_POST)){
                    filterDorms();
                } else {
                    getMyDorms();
                }

                ?>
			</div>
		</div>
	
		<div id="footer">
			<div id="footer-placeholder"></div>
		</div>
	</div>
</body>
</html>