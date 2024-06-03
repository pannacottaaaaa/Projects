<?php
require_once 'index-db.php';
global $db;
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $latest_listing_query = "SELECT MAX(listing_id) as latest_listing_id FROM listing";
    $latest_listing_query_result = mysqli_query($db, $latest_listing_query);
    $new_listing_id = mysqli_fetch_assoc($latest_listing_query_result)['latest_listing_id'] + 1;

    $moveinStartString = $_POST['movein_start'];
    $moveinStartDateTime = new DateTime($moveinStartString);
    $moveinStart = $moveinStartDateTime->format('Y-m-d');

    $insert_query = "INSERT INTO listing (listing_id, user_id, is_published, is_verified, listing_title, rent_fee, capacity, bedrooms, listing_type, region, street, city, zip_code, description, phone_number, movein_start, bathrooms, date_created)
    VALUES ($new_listing_id, {$_SESSION["user_id"]}, 0, 0, '{$_POST["listing_title"]}', {$_POST["rent_fee"]}, {$_POST["capacity"]}, {$_POST["bedrooms"]}, '{$_POST["listing_type"]}', '{$_POST["region"]}', '{$_POST["street"]}', '{$_POST["city"]}', '{$_POST["zip_code"]}', '{$_POST["description"]}', '{$_POST["phone_number"]}', '$moveinStart', {$_POST["bathrooms"]}, NOW())";

    if (mysqli_query($db, $insert_query) === TRUE) {
        // Insertion successful
        //echo "Listing insertion successful.";
    } else {
        // Insertion failed
        echo "Listing insertion failed.";
    }

    $wifi = 0;
    $television = 0;
    $air_condition = 0;
    $closet_drawers = 0;
    $desk_workspace = 0;
    $washing_machine = 0;
    $kitchen_appliances_utensils = 0;
    $smoke_detector = 0;
    $fire_extinguisher = 0;
    $first_aid_kit = 0;
    
    if (isset($_POST['wifi'])) {
        $wifi = 1;
    }
    if (isset($_POST['television'])) {
        $television = 1;
    }
    if (isset($_POST['air_condition'])) {
        $air_condition = 1;
    }
    if (isset($_POST['closet_drawers'])) {
        $closet_drawers = 1;
    }
    if (isset($_POST['desk_workspace'])) {
        $desk_workspace = 1;
    }
    if (isset($_POST['washing_machine'])) {
        $washing_machine = 1;
    }
    if (isset($_POST['kitchen_appliances_utensils'])) {
        $kitchen_appliances_utensils = 1;
    }
    if (isset($_POST['smoke_detector'])) {
        $smoke_detector = 1;
    }
    if (isset($_POST['fire_extinguisher'])) {
        $fire_extinguisher = 1;
    }
    if (isset($_POST['first_aid_kit'])) {
        $first_aid_kit = 1;
    }

    $latest_listing_reqs_query = "SELECT MAX(listing_reqs_id) as latest_listing_reqs_id FROM listing_reqs";
    $latest_listing_reqs_query_result = mysqli_query($db, $latest_listing_reqs_query);
    $new_listing_reqs_id = mysqli_fetch_assoc($latest_listing_reqs_query_result)['latest_listing_reqs_id'] + 1;

    $listing_reqs_insert_query = "INSERT INTO listing_reqs (listing_reqs_id, listing_id, house_rules, reqs_govtid) VALUES ($new_listing_reqs_id, $new_listing_id, '{$_POST["house_rules"]}', 1)";
    if (mysqli_query($db, $listing_reqs_insert_query) === TRUE) {
        // Insertion successful
        //echo "Listing requirements insertion successful.";
    } else {
        // Insertion failed
        echo "Listing requirements insertion failed.";
    }

    $latest_listing_am_query = "SELECT MAX(amenities_id) as latest_listing_am_id FROM listing_amenities";
    $latest_listing_am_query_result = mysqli_query($db, $latest_listing_am_query);
    $new_listing_am_id = mysqli_fetch_assoc($latest_listing_am_query_result)['latest_listing_am_id'] + 1;

    $listing_am_insert_query = "INSERT INTO listing_amenities (listing_id, amenities_id, wifi, television, air_condition, closet_drawers, desk_workspace, washing_machine, kitchen_appliances_utensils, smoke_detector, fire_extinguisher, first_aid_kit)
    VALUES ($new_listing_id, $new_listing_am_id, $wifi, $television, $air_condition, $closet_drawers, $desk_workspace, $washing_machine, $kitchen_appliances_utensils, $smoke_detector, $fire_extinguisher, $first_aid_kit)";
    
    if (mysqli_query($db, $listing_am_insert_query) === TRUE) {
        // Insertion successful
        //echo "Amenities insertion successful.";
    } else {
        // Insertion failed
        echo "Amenities insertion failed.";
    }

    $files = $_FILES['files'];

    $fileCount = count($files['name']);

    for ($i = 0; $i < $fileCount; $i++) {
        $latest_photo_id_query = "SELECT MAX(photo_id) as latest_photo_id FROM photo";
        $latest_photo_id_query_result = mysqli_query($db, $latest_photo_id_query);
        $new_photo_id = mysqli_fetch_assoc($latest_photo_id_query_result)['latest_photo_id'] + 1;

        $fileName = $files['name'][$i];
        $fileTmpName = $files['tmp_name'][$i];
        $fileSize = $files['size'][$i];
        $fileError = $files['error'][$i];
        $fileType = $files['type'][$i];
            
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 10000000) {
                    // potential code for $fileNameNew to check if it saves the file name as is
                    $fileNameNew = reset($fileExt).".".$fileActualExt;
                    //$fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = 'images/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $pic_insert_query = "INSERT INTO photo (photo_id, listing_id, photo_path) VALUES ($new_photo_id, $new_listing_id, '$fileNameNew')";

                    // execute INSERT query here
                    if (mysqli_query($db, $pic_insert_query) === TRUE) {
                        // Insertion successful
                        //echo "Photo insertion successful!";
                    } else {
                        // Insertion failed
                        echo "Photo insertion failed.";
                    }
                    header("Location: manage-listing.php");
                } else {
                    echo "Your file is too big!";
                }
            } else {
                echo "There was an error uploading your file!";
            }
        } else {
            echo "This file type is not supported. Please upload a JPG, JPEG, or PNG file.";
        }
    }

    
  }

/*
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 10000000) {
                // potential code for $fileNameNew to check if it saves the file name as is
                $fileNameNew = reset($fileExt).".".$fileActualExt;
                //$fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'images/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                echo "it works!";
            } else {
                echo "Your file is too big!";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
  }
*/

?>
