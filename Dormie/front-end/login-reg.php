<?php
require_once 'index-db.php';
global $db;

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	if (isset($_POST['login_form'])) {
		$mysqli = require __DIR__ . "/index-db.php";

		$sql = sprintf("SELECT * FROM user
				WHERE email = '%s'",
				$db->real_escape_string($_POST["email"]));

		$result = $db->query($sql);

		$user = $result->fetch_assoc();
		
		if ($user && $_POST["password"] == $user["password"]) {
			// if there is a user who has that email
			echo "Passed user & validation";
			session_start();
	 
			$_SESSION["user_id"] = $user["user_id"];
			
			// redirect user to verification-requests.php page if they are an admin
			if($user["is_admin"] == 1) {
				header("Location: verification-requests.php");
				exit;
			} else {
				header("Location: index.php");
				exit;
			}
		} else {
			echo "Login failed! Check your username and password. Try again";
		}
		// if it reaches here, then it means that the user didn't pass either email or password check
		$is_invalid = true;
	} 
}

/*
    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        // Prepare the SQL query
        $query = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = mysqli_prepare($db, $query);

        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);

        // Execute the prepared statement
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        // Check if the user exists
        if (mysqli_num_rows($result) > 0) {
            // Log the user in
            session_start();
            $_SESSION['username'] = $username;
            echo "Success!";
            //header("Location: profile.php");
        } else {
        // Show an error message
        echo "Invalid username or password";
        }
    }
*/
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
                <div id="btn" style="left:0px"></div>
                <button type="button" class="toggle-btn" onclick="window.location.href='login-reg.php'">Log In</button>
                <button type="button" class="toggle-btn" onclick="window.location.href='register.php'">Register</button>
            </div>
            <!-- login form - this is the one shown by default -->
            <form action="" method="post" id="login" class="input-group" style="left:50px">
                <input type="email" class="input-field" name="email" placeholder="Email"
                value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" required>
                <input type="password" class="input-field" name="password" placeholder="Password" required>
                <input type="checkbox" class="check-box"><span>Remember Password</span>
                <input type="submit" class="submit-btn" name="login_form" value="Log In">
            </form>
            <!-- reg form - this is the one shown by toggling reg -->
            <form action="" method="post" id="register" class="input-group" style="left:450px">
                <input type="text" class="input-field" name="rusername" placeholder="Username" required>
                <input type="email" class="input-field" name="remail" placeholder="Email" required>
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
