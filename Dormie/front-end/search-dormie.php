<?php

require_once 'index-db.php';

$output = '';

if(isset($_POST['searchVal'])) {
    $searchDormie = $_POST['searchVal'];
    $searchDormie = preg_replace("#[^0-9a-z]#i","",$searchDormie);

    $query = mysqli_query($db, "SELECT * FROM users WHERE city LIKE '%$searchDormie%'") or die("Could not search! ");
    $count = mysqli_num_rows($query);
    if($count == 0) {
        $output = "There are no matching results.";
    } else {
        while($row = mysqli_fetch_array($query)) {
            $date = strtotime($row["target_movein"]);
            echo "<a href='landing-page-dormie.php?id={$row['username']}'><div class='dormie-card'>
            <div>
                <img src='images/default-profile-pic.png' alt='Profile picture' >
            </div>
            <div class='dormie-name'>
                <p>" . $row["full_name"] . ", " . $row["age"] . "</p>
            </div>
            <div class='dormie-loc'>
                <p>" . $row["city"] . " | " . date("F j, Y", $date) . "</p>
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
echo ($output);
?>