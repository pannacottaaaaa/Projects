<?php
session_start();

$result = filter_input(INPUT_POST, "result", FILTER_VALIDATE_INT);
$missing_req = filter_input(INPUT_POST, "missing_req", FILTER_VALIDATE_INT);
$invalid_req = filter_input(INPUT_POST, "invalid_req", FILTER_VALIDATE_INT);
$justification = $_POST["justification"];
$creation_date = filter_input(INPUT_POST, "creation_date", FILTER_SANITIZE_STRING);

$connect = mysqli_connect('localhost', 'dormie', 'password', 'dormie', '3307');

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// To Retrieve Action
if ($_POST['Action'] == 'create') {
    //retrieve data from the form
    $results = $_POST['result'];
    $justification = $_POST['justification'];
    $missing_req = isset($_POST['missing_req']) ? 1 : 0;
    $invalid_req = isset($_POST['invalid_req']) ? 1 : 0;
    $creation_date = date('Y-m-d H:i:s');
    $admin_id = $_SESSION['admin_id'];

    // retrieve the listing_id from the current page
    $listing_id = $_GET['listing_id'];

    // insert data into profile_verification_report table
    $sql = "INSERT INTO listing_verification_report (result, justification, missing_req, invalid_req, creation_date) 
                VALUES ('$results', '$justification', '$missing_req', '$invalid_req', '$creation_date')";

    if (mysqli_query($connect, $sql)) {
        // update the listing table if the results are approved
        if ($results == 'approved') {
            $sql = "UPDATE listing SET is_verified = '1' WHERE listing_id = '$listing_id'";
            mysqli_query($connect, $sql);
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
}
?>
