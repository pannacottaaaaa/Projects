<?php
session_start();

$result = filter_input(INPUT_POST, "result", FILTER_VALIDATE_INT);
$missing_req = filter_input(INPUT_POST, "missing_req", FILTER_VALIDATE_INT);
$invalid_req = filter_input(INPUT_POST, "invalid_req", FILTER_VALIDATE_INT);
$justification = $_POST["justification"];
$creation_date = filter_input(INPUT_POST, "creation_date", FILTER_SANITIZE_STRING);

$connect = mysqli_connect('localhost', 'dormie', 'password', 'dormie', '3307');

// if (mysqli_connect_errno()) {
//     die("Connection error: " . mysqli_connect_error());
// }

// $sql = "INSERT INTO profile_verification_report (result, missing_req, invalid_req, justification, creation_date)
//         VALUES (?, ?, ?, ?, ?,)";

// $stmt = mysqli_stmt_init($connect);

// if (!mysqli_stmt_prepare($stmt, $sql)) {
//     die(mysqli_error($connect));
// }

// mysqli_stmt_bind_param($stmt, "siit",
//                        $result, 
//                        $missing_req, 
//                        $invalid_req, 
//                        $justification, 
//                        $creation_date);

// mysqli_stmt_execute($stmt);

// if (mysqli_stmt_affected_rows($stmt) > 0) {
//     echo "Record saved.";
// } else {
//     echo "Failed to save record.";
// }

// mysqli_stmt_close($stmt);
// mysqli_close($connect);

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
    $user_id = $_GET['user_id'];

    // insert data into profile_verification_report table
    $sql = "INSERT INTO profile_verification_report (result, justification, missing_req, invalid_req, creation_date) 
                VALUES ('$results', '$justification', '$missing_req', '$invalid_req', '$creation_date')";

    if (mysqli_query($connect, $sql)) {
        // update the listing table if the results are approved
        if ($results == 'approved') {
            $sql = "UPDATE user (is_verified) SET value = 1 WHERE user_id = '$user_id'";
            mysqli_query($connect, $sql);
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
    // if ($result == 1)
    // {
    //     $sql = "UPDATE profile SET is_verified = '1' WHERE user_id = '$user_id'";
    // }
    // else
    // {
    //     $sql = "UPDATE profile SET is_verified = '0' WHERE user_id = '$user_id'";
    // }
}
?>