<?php
    require_once 'index-db.php';
	session_start();
	if(!isset($_SESSION['user_id'])) {
		header("Location: login-reg.php");
		exit();
	}

    function getAllDormies(){
        global $db;
        $query = 'SELECT u.user_id, u.username, u.first_name, u.last_name, p.age, p.city, p.gender, p.department, p.profile_picture, p.contact_number, p.budget, p.target_movein, p.preferred_location FROM user u, profile p WHERE p.is_verified IS TRUE AND u.user_id = p.user_id';
        $result = mysqli_query($db, $query);
        while( $record = mysqli_fetch_assoc( $result ) )
        {
            $date = strtotime($record["target_movein"]);
            $imageData = $record['profile_picture'];
            echo "<a href='landing-page-dormie.php?id={$record['username']}'><div class='dormie-card'>
            <div>
                <img src='data:image/png;base64,".base64_encode($imageData)."' alt='Profile picture' />
            </div>
            <div class='dormie-name'>
                <p>" . $record["first_name"] . " " . $record["last_name"] .  ", " . $record["age"] . "</p>
            </div>
            <div class='dormie-loc'>
                <p>" . $record["preferred_location"] . " | " . date("F j, Y", $date) . "</p>
            </div>
            <div class='dormie-school'>
                <p>" . $record["gender"] . " | " . $record["department"] . "</p>
            </div>
            <div class='dormie-budget'>
                <p>Budget: ₱" . $record["budget"] . "/month</p>
            </div>
            </div>
            </a>";
        }
    }
    
    function searchDormieLoc(){
        global $db;
        $searchDormie = $_POST['search'];
        $searchDormie = preg_replace("#[^0-9a-z]#i","",$searchDormie);

        $query = mysqli_query($db, "SELECT u.user_id, u.username, u.first_name, u.last_name, p.age, p.city, p.gender, p.department, p.profile_picture, p.contact_number, p.budget, p.target_movein, p.preferred_location FROM profile p, user u WHERE p.is_verified IS TRUE AND (preferred_location LIKE '%$searchDormie%' or department LIKE '%$searchDormie%') AND u.user_id = p.user_id") or die("Could not search! ");
        $count = mysqli_num_rows($query);
        if($count == 0) {
            echo "There are no matching results.";
        } else {
            while($row = mysqli_fetch_array($query)) {
                $date = strtotime($row["target_movein"]);
                $imageData = $row['profile_picture'];
                echo "<a href='landing-page-dormie.php?id={$row['username']}'><div class='dormie-card'>
                <div>
                    <img src='data:image/png;base64,".base64_encode($imageData)."' alt='Profile picture' />
                </div>
                <div class='dormie-name'>
                    <p>" . $row["first_name"] . " " . $row["last_name"] . ", " . $row["age"] . "</p>
                </div>
                <div class='dormie-loc'>
                    <p>" . $row["preferred_location"] . " | " . date("F j, Y", $date) . "</p>
                </div>
                <div class='dormie-school'>
                    <p>" . $row["gender"] . " | " . $row["department"] . "</p>
                </div>
                <div class='dormie-budget'>
                    <p>Budget: ₱" . $row["budget"] . "/month</p>
                </div>
                </div>
                </a>";
            }
        }
    }

    function filterDormie(){
        global $db;
        $query = "SELECT u.user_id, u.username, u.first_name, u.last_name, p.age, p.city, p.gender, p.department, p.profile_picture, p.contact_number, p.budget, p.target_movein, p.preferred_location FROM user u, profile p WHERE u.user_id = p.user_id AND p.is_verified IS TRUE";
        $result = mysqli_query($db, $query);
        $searchAccount = '';
        $searchGender = '';
        $searchBudget = '';
        $searchAge = '';
        $searchDate = '';

        /* if(isset($_POST['account'])) {
            $searchAccount = $_POST['account'];
            $searchAccount = preg_replace("#[^0-9a-z]#i","",$searchAccount);
            $subquery = $query;
            
            if($searchAccount == "Verified") {
                $query = "SELECT * FROM ($subquery) as a WHERE is_verified = 1";
            } else {
                $query = "SELECT * FROM ($subquery) as a WHERE is_verified = 0";
            }
            $result = mysqli_query($db, $query);
        }
        else  {
            $searchAccount = NULL;
        } */
        
        if(isset($_POST['gender'])) {
            $searchGender = $_POST['gender'];
            $searchGender = preg_replace("#[^0-9a-z]#i","",$searchGender);
            $subquery = $query;

            $query = "SELECT * FROM ($subquery) AS b WHERE gender = '$searchGender'";
            $result = mysqli_query($db, $query);
        }
        else  {
            $searchGender = NULL;
        }
        
        if(isset($_POST['budget'])) {
            $searchBudget = $_POST['budget'];
            $searchBudget = preg_replace("#[^0-9]#i","",$searchBudget);
            $subquery = $query;

            $query = "SELECT * FROM ($subquery) AS b WHERE budget <= $searchBudget";
            $result = mysqli_query($db, $query);
        }
        else  {
            $searchBudget = NULL;
        }

        if(isset($_POST['age'])) {
            $searchAge = $_POST['age'];
            $searchAge = preg_replace("#[^0-9a-z]#i","",$searchAge);
            $subquery = $query;

            if($searchAge == "18to22") {
                $query = "SELECT * FROM ($subquery) AS c WHERE age >= 18 AND age <= 22";
                $result = mysqli_query($db, $query);
            } elseif ($searchAge == "23to25") {
                $query = "SELECT * FROM ($subquery) AS c WHERE age >= 23 AND age <= 25";
                $result = mysqli_query($db, $query);
            } elseif ($searchAge == "26to30") {
                $query = "SELECT * FROM ($subquery) AS c WHERE age >= 26 AND age <= 30";
                $result = mysqli_query($db, $query);
            } elseif ($searchAge == "above30") {
                $query = "SELECT * FROM ($subquery) AS c WHERE age > 30";
                $result = mysqli_query($db, $query);
            }
        }
        else  {
            $searchAge = NULL;
        }   

        if(isset($_POST['date'])) {
            $searchDate = $_POST['date'];
            $searchDate = preg_replace("#[^0-9]#i","",$searchDate);
            $subquery = $query;

            if ($searchDate) {    
                $query = "SELECT * FROM ($subquery) AS b WHERE target_movein BETWEEN DATE_SUB('$searchDate', INTERVAL 35 DAY) AND DATE_ADD('$searchDate', INTERVAL 35 DAY)";
                $result = mysqli_query($db, $query);
            }
        }
        else  {
            $searchDate = NULL;
        }

        $count = mysqli_num_rows($result);
        if($count == 0) {
            echo "There are no matching results.";
        } else {
            while($row = mysqli_fetch_array($result)) {
                $date = strtotime($row["target_movein"]);
                $imageData = $row['profile_picture'];
                echo "<a href='landing-page-dormie.php?id={$row['username']}'><div class='dormie-card'>
                <div>
                    <img src='data:image/png;base64,".base64_encode($imageData)."' alt='Profile picture' />
                </div>
                <div class='dormie-name'>
                    <p>" .$row["first_name"] . " " . $row["last_name"] . ", " . $row["age"] . "</p>
                </div>
                <div class='dormie-loc'>
                    <p>" . $row["preferred_location"] . " | " . date("F j, Y", $date) . "</p>
                </div>
                <div class='dormie-school'>
                    <p>" . $row["gender"] . " | " . $row["department"] . "</p>
                </div>
                <div class='dormie-budget'>
                    <p>Budget: ₱" . $row["budget"] . "/month</p>
                </div>
                </div>
                </a>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find a Dormie | Dormie</title>
    
    <link rel="stylesheet" href="styles/find-a-dormie.css">
    
    <!-- Google Fonts stylesheets -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>

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
    <div id="maingrid">
        <div id="header">
            <nav><?php include_once ("nav.php") ?></div></nav>
        </div>

        <div id="content">
            <div class="dormie-grid">
            <h1>Find a Dormie</h1>
                <form method="post" id="searchbar">
                    <input type="search" id="search" name="search" placeholder="Search Location or Department">
                    <input type="submit" hidden />
                </form>
                <div class="filters">
                    <form method="post" id="filters">
                        <!--
                        <div class="dropdown" id="acct-dropdown">
                            <button class="filter-btn"><i class="bi bi-check-circle-fill"></i>   Verified</button>
                            <div class="dropdown-content">
                                <input type="radio" id="verified" name="account" value="Verified">
                                <label for="verified">Verified</label><br>
                                <input type="radio" id="regular" name="account" value="Regular">
                                <label for="regular">Regular</label><br>
                            </div>
                        </div>
                        -->
                        <div class="dropdown" id="gender-dropdown">
                            <button class="filter-btn"><i class="bi bi-person-fill"></i>   Gender</button>
                            <div class="dropdown-content">
                                <input type="radio" id="secret" name="gender" value="Prefer not to say">
                                <label for="secret">Prefer not to say</label><br>
                                <input type="radio" id="nb" name="gender" value="Non-binary">
                                <label for="nb">Non-binary</label><br>
                                <input type="radio" id="female" name="gender" value="Female">
                                <label for="female">Female</label><br>
                                <input type="radio" id="male" name="gender" value="Male">
                                <label for="male">Male</label><br>
                            </div>
                        </div>
                        <!-- <button class="filter-btn"><i class="bi bi-geo-alt-fill"></i>   Location</button> -->
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
                        <div class="dropdown" id="date-dropdown">
                            <button class="filter-btn"><i class="bi bi-calendar-event-fill"></i>   Move-in Date</button>
                            <div class="dropdown-content">
                                <p>Results will show +/- 35 days from the inputted date. The exact date can be found in the Dormie's profile. </p>
                                    <input type ="date" name="date">
                            </div>
                        </div>
                        <div class="dropdown" id="age-dropdown">
                            <button class="filter-btn"><i class="bi bi-hash"></i>   Age</button>
                            <div class="dropdown-content">
                                    <input type="radio" id="youngest" name="age" value="18to22">
                                    <label for="youngest">18 to 22</label><br>
                                    <input type="radio" id="mid1" name="age" value="23to25">
                                    <label for="mid1">23 to 25</label><br>
                                    <input type="radio" id="mid2" name="age" value="26to30">
                                    <label for="mid2">26 to 30</label><br>
                                    <input type="radio" id="oldest" name="age" value="above30">
                                    <label for="oldest">Above 30</label><br>
                            </div>
                        </div>
                        <input type="submit" class="filter-btn" id="apply" name="apply" value ="Apply" onclick="submit();"></input>
                        <input type="submit" class="filter-btn" id="clear" name="clear" value ="Clear" onclick="submit();"></input>
                    </form>
                </div>

                <?php

                if(array_key_exists('search', $_POST)) {
                    searchDormieLoc();
                } else if (array_key_exists('apply', $_POST)){
                    filterDormie();
                } else {
                    getAllDormies();
                }

                ?>

                <!--
                <a href="landing-page-dormie.html">
                <div class="dormie-card">
                    <div>
                        <img src="images/default-profile-pic.png" alt="Profile picture" >
                    </div>
                    <div class="dormie-name">
                        <p>Hana Song, 19</p>
                    </div>
                    <div class="dormie-loc">
                        <p>Seoul, Immediate</p>
                    </div>
                    <div class="dormie-school">
                        <p>Female | School of Information Technology</p>
                    </div>
                    <div class="dormie-budget">
                        <p>Budget: ₱2,000/month</p>
                    </div>
                </div>
                </a>
                -->
            </div>
        </div>

        <div id="footer">
            <div id="footer-placeholder"></div>
        </div>
    </div>
    
</body>
</html>