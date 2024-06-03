<!--
    Nav bar, to be reused across all pages. Refer to Eonn's link to instructions via StackOverflow. :>
    - Rya
-->


<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Dormie Nav</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='styles/nav_style.css'>
    <script src="https://kit.fontawesome.com/b1cd6cf5af.js" crossorigin="anonymous"></script>
    <script src="components/nav-hamburger.js"></script>

    <!-- Google Fonts stylesheets -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // This event listener waits for the user to resize the window then calls hideNav
        window.addEventListener('resize', hideNav);

        // This function hides the nav bar buttons and moves the options to the sidebar
        function hideNav() {
            let width = $(window).innerWidth();
            if (width < 899) {
                document.getElementById("navSmallLinks").style.visibility = "visible";
                document.getElementById("navSmallLinks").style.height = "auto";
                document.getElementById("navSmallNoAcc").style.visibility = "visible";
                document.getElementById("navSmallNoAcc").style.height = "auto";
                document.getElementById("navSideAcc").style.height = "0";
                document.getElementById("navSignedIn").style.height = "0";
                document.getElementById("myLinks").style.visibility = "hidden";
                document.getElementById("myLinks").style.width = "0";
                document.getElementById("myBtnGrp").style.visibility = "hidden";
                document.getElementById("myBtnGrp").style.width = "0";
                document.getElementById("hamburger").style.alignSelf = "center";
                document.getElementById("hamburger").style.textAlign = "right";
                document.getElementById("hamburger").style.flexGrow = "3";
                
            } else {
                document.getElementById("navSmallLinks").style.visibility = "hidden";
                document.getElementById("navSmallLinks").style.height = "0";
                document.getElementById("navSmallNoAcc").style.visibility = "hidden";
                document.getElementById("navSmallNoAcc").style.height = "0";
                document.getElementById("navSideAcc").style.height = "0";
                document.getElementById("navSignedIn").style.height = "0";
                document.getElementById("myLinks").style.visibility = "visible";
                document.getElementById("myLinks").style.width = "inherit";
                document.getElementById("myBtnGrp").style.visibility = "visible";
                document.getElementById("myBtnGrp").style.width = "inherit";
                document.getElementById("header").style.justifyContent = "row";
            }
        }
        /* Set the width of the side navigation to 250px */
        function openNav() {
            let width = $(window).innerWidth();
            if (width < 1200) {
                document.getElementById("mySidenav").style.width = "100%";
            } else {
                document.getElementById("mySidenav").style.width = "250px";
            }
        }

        /* Set the width of the side navigation to 0 */
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }

    </script>
</head>
<body>
    <div id="header">
        <div class = "logo">
            <a href = "index.php">
                <img src = "images/logo - name.png" alt="Dormie Logo" width = 100px height = 100px>
            </a>
        </div>

        <nav id="myLinks">
            <ul class="nav__links">
                <li><a href="rooms-for-rent.php">Dorms for Rent</a></li>
                <li><a href="find-a-dormie.php">Find a Dormie</a></li>
            </ul>
        </nav>

        <div class ="btnGroup" id="myBtnGrp">
            <a href="create-a-listing.php"><button class="create_listing">Create a Listing</button></a>

            <?php if (isset($_SESSION["user_id"])): ?>
                <a href="logout.php"><button class="sign_up">Log Out</button></a>
            <?php else: ?>
                <a href="login-reg.php"><button class="log_in">Log In</button></a>
                <a href="register.php"><button class="sign_up">Sign Up</button></a>
            <?php endif; ?>
        </div>

        <i class="fa fa-bars" id="hamburger" onclick="openNav()""></i>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div id="navSmallLinks">
                <a href="rooms-for-rent.php">Dorms for Rent</a>
                <a href="find-a-dormie.php">Find a Dormie</a>
                <a href="create-a-listing.php">Create a Listing</a>
            </div>
            <div id="navSideAcc">
                <a href="#">Account</a>
                <a href="#">Dormie Profile</a>
            </div>
            <a href="user-profile-page.php">Profile</a>
            <a href="manage-listing.php">Your Listings</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <?php if (isset($_SESSION["user_id"])): 
                require_once 'index-db.php';
                global $db;
                $sql = "SELECT * FROM user u WHERE u.user_id = {$_SESSION["user_id"]}";
                $result = $db->query($sql);
                $user = $result->fetch_assoc();
                ?>
                <?php if ($user["is_admin"] == 1): ?>
                    <a href="verification-requests.php" style="visibility: visible">Verification Overview</a>
                <?php else: ?>
                    <a href="verification-requests.php" style="visibility: hidden; height: 0; margin: 0">Verification Overview</a>
                <?php endif; ?>
            <?php endif; ?>
            <div id="navSmallNoAcc">
                <?php if (isset($_SESSION["user_id"])): ?>
                    <a href="logout.php" style="visibility: visible">Log Out</a>
                <?php else: ?>
                    <a href="login-reg.php" style="visibility: visible">Log In</a>
                    <a href="register.php" style="visibility: visible">Sign Up</a>
                <?php endif; ?>
                <a href="login-reg.php">Log In</a>
                <a href="register.php">Register</a>
            </div>
            <div id="navSignedIn">
                <a href="logout.php">Log Out</a>
            </div>
        </div>
    </div>
</body>
</html>
