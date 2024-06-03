<?php
require_once 'index-db.php';
global $db;

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if (isset($_POST['register_form'])) {
		
		$reg_valid = false;
		$username = $_POST['rusername'];#u
		$email = $_POST['remail'];
		$password = $_POST['rpassword'];
		
		// Password Strength
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number = preg_match('@[0-9]@', $password);
		$specialChars = preg_match('@[^\w]@', $password);
		
		$username_query = "SELECT * FROM user WHERE username = '$username'";
		$email_query = "SELECT * FROM user WHERE email = '$email'";
		$user_result = mysqli_query($db, $username_query);
		$email_result = mysqli_query($db, $email_query);
		
		if (!$user_result || !$email_result) {
			die("Query failed: " . $mysqli->error);
		}
		
		// Check if username is < 6 and > 12
		if (strlen($username) <= 6 ) {
			echo "The username should have 6–12 characters long with any combination of letters, numbers, or symbols";
			
		} else {
			// Check if username and email is found in the db
			if ($user_result->num_rows >0 && $email_result->num_rows > 0) {
				echo "Username and Email are already used!";
			// Check if username is found
			} else if ($user_result->num_rows >0) {
				echo "Username already exists";
			// Check if email is found
			} else if ($email_result->num_rows >0) {
				echo "Email address has been taken by another user";
			} else {
				if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
					echo 'The password should be strong and have combination of uppercase letters, lowercase letters, numbers, and symbols.';
				} else {
					$latest_user_query = "SELECT MAX(user_id) as latest_user_id FROM user";
					$latest_user_result = mysqli_query($db, $latest_user_query);
					$latest_user_row = mysqli_fetch_assoc($latest_user_result);
					$new_user_id = $latest_user_row['latest_user_id'] + 1;
					$latest_profile_query = "SELECT MAX(profile_id) as latest_profile_id FROM profile";
					$latest_profile_result = mysqli_query($db, $latest_profile_query);
					$latest_profile_row = mysqli_fetch_assoc($latest_profile_result);
					$new_profile_id = $latest_profile_row['latest_profile_id'] + 1;
					$insert_query = "INSERT INTO user (user_id, username, email, password) VALUES ('$new_user_id', '$username', '$email', '$password')";
					$insert_profile_query = "INSERT INTO profile (profile_id, user_id, is_verified, date_created) VALUES ('$new_profile_id', '$new_user_id', '0', NOW())";
					if ($reg = mysqli_query($db, $insert_query) && mysqli_query($db, $insert_profile_query)) {
						echo "Registration successful";
						session_start();
						$_SESSION["user_id"] = $new_user_id;
						header("Location: user-profile-register.php");
						exit;
					} else {
						echo "Error: " . mysqli_error($db);
					}
				}
			}
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register or Log-in | Dormie</title>
    <link rel="stylesheet" href="styles/login-reg.css">

</head>
<body>
    <div class="hero">
        <div class="form-box">
            
            <!-- LOGO -->
            <img src="images/logo - name.png" id="logo" alt="Dormie Logo" height = "100" width = "100">

            <div class="button-box">
                <div id="btn" style="left:110px"></div>
                <button type="button" class="toggle-btn" onclick="window.location.href='login-reg.php'">Log In</button>
                <button type="button" class="toggle-btn" onclick="window.location.href='register.php'">Register</button>
            </div>
            <!-- login form - this is the one shown by default -->
            <form action="" method="post" id="login" class="input-group" style="left:-400px">
                <input type="email" class="input-field" name="email" placeholder="Email"
                value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" required>
                <input type="password" class="input-field" name="password" placeholder="Password" required>
                <input type="checkbox" class="check-box"><span>Remember Password</span>
                <input type="submit" class="submit-btn" name="login_form" value="Log In">
            </form>
            <!-- reg form - this is the one shown by toggling reg -->
            <form action="register.php" method="post" id="register" class="input-group" style="left:50px">
                <input type="text" class="input-field" name="rusername" placeholder="Username" required>
                <input type="email" class="input-field" name="remail" placeholder="Email"
                value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" required>
                <input type="password" class="input-field" name="rpassword" placeholder="Password" required>
                <input type="checkbox" class="check-box"><span>I agree to the Terms and Conditions.</span>
                <button type="submit" name="register_form" class="submit-btn">Register</button>
            </form>
        </div>
    </div>
    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");
        
        // displays register elements
        function register(){
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }
        
        // displays login elements
        function login(){
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0px";
        }
		
    </script>
</body>
</html>
