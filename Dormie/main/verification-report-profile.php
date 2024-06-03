<?php
// Connect to the database
$connect = mysqli_connect('localhost', 'dormie', 'password', 'dormie', '3307');
session_start();

if (isset($_GET['id'])) {
  $user_id = mysqli_real_escape_string($connect, $_GET['id']);
  $query = "SELECT * FROM user WHERE user_id = $user_id";
  $result = mysqli_query($connect, $query) or die("Bad Query: $query");
  $row = mysqli_fetch_array($result);

  $user_id = $row['user_id'];
  $uquery = "SELECT * FROM user WHERE user_id = $user_id";
  $uresult = mysqli_query($connect, $uquery) or die("Bad Query: $uquery");
  $urow = mysqli_fetch_array($uresult);
}
?>

<!-- html -->

<!DOCTYPE html>
<html lang="english">

<head>
  <title>Verification Profile Report</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <meta property="twitter:card" content="summary_large_image" />

  <style data-tag="reset-style-sheet">
    html {
      line-height: 1.15;
    }

    body {
      margin: 0;
    }

    * {
      box-sizing: border-box;
      border-width: 0;
      border-style: solid;
    }

    p,
    li,
    ul,
    pre,
    div,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    figure,
    blockquote,
    figcaption {
      margin: 0;
      padding: 0;
    }

    button {
      background-color: transparent;
    }

    button,
    input,
    optgroup,
    select,
    textarea {
      font-family: inherit;
      font-size: 100%;
      line-height: 1.15;
      margin: 0;
    }

    button,
    select {
      text-transform: none;
    }

    button,
    [type="button"],
    [type="reset"],
    [type="submit"] {
      -webkit-appearance: button;
    }

    button::-moz-focus-inner,
    [type="button"]::-moz-focus-inner,
    [type="reset"]::-moz-focus-inner,
    [type="submit"]::-moz-focus-inner {
      border-style: none;
      padding: 0;
    }

    button:-moz-focus,
    [type="button"]:-moz-focus,
    [type="reset"]:-moz-focus,
    [type="submit"]:-moz-focus {
      outline: 1px dotted ButtonText;
    }

    a {
      color: inherit;
      text-decoration: inherit;
    }

    input {
      padding: 2px 4px;
    }

    img {
      display: block;
    }

    html {
      scroll-behavior: smooth
    }

    .black-box {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.98);
      z-index: 1;
    }

    .white-box {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      padding: 40px;
      z-index: 2;
      border: 2px solid rgba(159, 134, 192, 1);
      width: 70%;
      max-width: 500px;
      text-align: center;
    }

    .white-box h3 {
      font-family: 'Poppins', sans-serif;
      font-weight: bold;
    }

    .white-box p {
      padding-top: 10px;
      font-family: 'Poppins', sans-serif;
      font-style: italic;
      color: rgba(159, 134, 192, 1);
      font-size: 15px;
    }

    .close-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      cursor: pointer;
      font-family: 'Poppins', sans-serif;
      font-weight: bold;
      color: rgba(159, 134, 192, 1);
    }

    .content {
      /* Add styles for your page content here */
      position: relative;
      z-index: 0;
    }
  </style>
  <style data-tag="default-style-sheet">
    html {
      font-family: Inter;
      font-size: 16px;
    }

    body {
      font-weight: 400;
      font-style: normal;
      text-decoration: none;
      text-transform: none;
      letter-spacing: normal;
      line-height: 1.15;
      color: var(--dl-color-gray-black);
      background-color: var(--dl-color-gray-white);

    }
  </style>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
    data-tag="font" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
    data-tag="font" />
  <link rel="stylesheet" href="styles/anothervrpstyle.css" />
</head>

<body>
  <!-- <div class="black-box"></div>
  <div class="white-box">
    <a href="index.php">
      <div class="close-btn">X</div>
      idk kung ano yung for admins
      Aside from checking if there is a logged in user, check if the user is an admin
      <?php
      if ($record["is_admin"] == 1) {
        // User is an admin
        echo "<h2>Welcome, admin!</h1>";
        // Add event listener to close button
        echo '<script>
    document.querySelector(".close-btn").addEventListener("click", function() {
      // Remove scroll lock
      document.body.style.overflow = "auto";
    });
  </script>';
      } else {
        // User is not an admin
        echo "<h2>You do not have admin privileges.<br>So please log-in as an Admin.</br></h2>";
        // Lock scrolling
        echo '<style>
    body {
      overflow: hidden;
    }
  </style>';
      }
      ?>
      <p>
        click the "x" button to proceed to log-in
      </p>
  </div> -->
  <div class="content">
    <div>
      <link href="styles/verificationrepo-tprofileversion.css" rel="stylesheet" />
      <div class="verificationrepo-tprofileversion-container">
        <div class="verificationrepo-tprofileversion-verificationrepo-tprofileversion">
          <div class="verificationrepo-tprofileversion-logged-in-navbarfor-admins">
            <img alt="Rectangle11051" src="images/rectangle11051-dg98.svg"
              class="verificationrepo-tprofileversion-rectangle1" />
            <img alt="logoname11051" src="images/logoname11051-hsb-200w.png"
              class="verificationrepo-tprofileversion-logoname1" />
            <span class="verificationrepo-tprofileversion-text">
              <span>Dorms for Rent</span>
            </span>
            <span class="verificationrepo-tprofileversion-text02">
              <span>Find a Dormie</span>
            </span>
            <div class="verificationrepo-tprofileversion-hamburger">
              <img alt="Line31051" src="images/line31051-t3xq.svg" class="verificationrepo-tprofileversion-line3" />
              <img alt="Line11051" src="images/line11051-8mme.svg" class="verificationrepo-tprofileversion-line1" />
              <img alt="Line21051" src="images/line21051-tfaf.svg" class="verificationrepo-tprofileversion-line2" />
            </div>
            <div class="verificationrepo-tprofileversion-sign-up-navbar-button">
              <span class="verificationrepo-tprofileversion-text04">
                <span>Log Out</span>
              </span>
            </div>
          </div>
          <div class="verificationrepo-tprofileversion-footer">
            <span class="verificationrepo-tprofileversion-text06">
              <span>Verified Dormie</span>
            </span>
            <span class="verificationrepo-tprofileversion-text08">
              <span>
                They are required to upload documents in PDF form to prove their
                reputable character (e.g. valid government I.D, NBI clearance,
                Certificate of Good Moral Conduct from their respective
                University) and be verified as a Dormie.
              </span>
            </span>
            <span class="verificationrepo-tprofileversion-text10">
              <span>All rights reserved by © Dormie 2022</span>
            </span>
            <img alt="Line51051" src="images/line51051-ivu.svg" class="verificationrepo-tprofileversion-line5" />
            <span class="verificationrepo-tprofileversion-text12">
              <span>Company</span>
            </span>
            <span class="verificationrepo-tprofileversion-text14">
              <span>How Dormie Works</span>
            </span>
            <span class="verificationrepo-tprofileversion-text16">
              <span>
                <span>About</span>
                <br />
                <span></span>
              </span>
            </span>
            <span class="verificationrepo-tprofileversion-text21">
              <span>Contact</span>
            </span>
            <span class="verificationrepo-tprofileversion-text23">
              <span>Contact Support</span>
            </span>
            <span class="verificationrepo-tprofileversion-text25">
              <span>Terms and Policies</span>
            </span>
          </div>
          <img alt="Rectangle15261051" src="images/rectangle15261051-j4lj-1500w.png"
            class="verificationrepo-tprofileversion-rectangle1526" />
          <img alt="Rectangle15191051" src="images/rectangle15191051-1zdb-1500w.png"
            class="verificationrepo-tprofileversion-rectangle1519" />
          <div class="verificationrepo-tprofileversion-backbutton">
            <span class="verificationrepo-tprofileversion-text27">
              <span>Back to List</span>
            </span>
            <button class="verificationrepo-tprofileversion-button button" onclick="redirectToVerificationRequests()">
              ←
            </button>
            <script>
              function redirectToVerificationRequests() {
                window.location.href = "verification-requests.php";
              }
            </script>
          </div>
          <div class="verificationrepo-tprofileversion-profile">
            <img alt="ScreenShot20230403at20811111" src="images/screenshot20230403at20811111-plq-200w.png"
              class="verificationrepo-tprofileversion-screen-shot20230403at2081" />
            <span class="verificationrepo-tprofileversion-text29">
              <span>
                <span>
                  <?php echo $urow['gender'] ?> <!-- Male --> ,
                  <?php echo $urow['age'] ?> <!-- 19 -->
                </span>
                <br />
                <span>
                  <?php echo $urow['degree'] ?> <!-- BS Computer Science -->
                </span>
                <br />
                <span>
                  <?php echo $row['username'] ?> <!-- @jdelacruz -->
                </span>
              </span>
            </span>
            <span class="verificationrepo-tprofileversion-text36">
              <span>
                <?php echo $row['first_name'] ?><!-- DELA CRUZ -->,
                <?php echo $row['last_name'] ?> <!-- JUAN -->
              </span>
            </span>
            <span class="verificationrepo-tprofileversion-text38">
              <span>Name</span>
            </span>
            <span class="verificationrepo-tprofileversion-text40">
              <span>
                <span>Gender &amp; Age</span>
                <br />
                <span>Course</span>
                <br />
                <span>Username</span>
              </span>
            </span>
          </div>
          <div class="verificationrepo-tprofileversion-linkto-google-form-data">
            <span class="verificationrepo-tprofileversion-text47">
              <span>Link to Google Form Data</span>
            </span>
            <form action="verification-report-profile-data.php" method="post">
              <div class="verificationrepo-tprofileversion-evaluation">
                <span class="verificationrepo-tprofileversion-text49">
                  <span>EVALUATION</span>
                </span>
                <span class="verificationrepo-tprofileversion-text51">
                  Invalid Requirement/s
                </span>
                <span class="verificationrepo-tprofileversion-text52">
                  <span>Missing Requirement/s</span>
                </span>
                <input type="checkbox" checked="true" class="verificationrepo-tprofileversion-checkbox" />
                <textarea placeholder="     Justification"
                  class="verificationrepo-tprofileversion-textarea textarea"></textarea>
                <input type="checkbox" checked="true" class="verificationrepo-tprofileversion-checkbox1" />
              </div>
              <div class="verificationrepo-tprofileversion-status">
                <span class="verificationrepo-tprofileversion-text54">
                  <span>STATUS</span>
                </span>
                <select id="results" name="results" class="verificationrepo-tprofileversion-select">
                  <option value="1" selected="">Approved</option>
                  <option value="0">Rejected</option>
                </select>
              </div>
              <div class="verificationrepo-tprofileversion-history">
                <span class="verificationrepo-tprofileversion-text56">
                  <span>HISTORY</span>
                </span>
                <span class="verificationrepo-tprofileversion-text58">
                  <span> Approved <span id="current-date"> </span></span>
                  <script>
                    var currentDate = new Date();
                    var options = { year: 'numeric', month: 'numeric', day: 'numeric' };
                    document.getElementById("current-date").innerHTML = currentDate.toLocaleDateString('en-US', options);
                  </script>
                  <br />
                  <span>by Admin345</span>
                </span>
                <button type="submit" value="Submit" class="verificationrepo-tprofileversion-button1 button">
                <a href = "find-a-dormie.php">
                    Submit
                  </a>
                </button>
              </div>
            </form>
          </div>
          <div class="verificationrepo-tprofileversion-personal-information">
            <div class="verificationrepo-tprofileversion-about-me">
              <img alt="wallpaper0411051" src="images/wallpaper0411051-92t-400h.png"
                class="verificationrepo-tprofileversion-wallpaper041" />
              <span class="verificationrepo-tprofileversion-text62">
                <span>ABOUT ME</span>
              </span>
              <span class="verificationrepo-tprofileversion-text64">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin
                vel risus accumsan, efficitur ipsum eu, eleifend mi. Donec
                placerat nisi eget nulla consectetur, sed posuere libero
                maximus. Aliquam et viverra magna. Suspendisse odio ipsum,
                mollis non neque ut, cursus efficitur augue. Cras consectetur
                lorem at odio fringilla, vel posuere turpis porttitor.
                Vestibulum condimentum, ante non euismod pretium, nisl nisi
                volutpat libero, eget auctor enim arcu eu nisl. Morbi id aliquet
                erat.
              </span>
            </div>
            <div class="verificationrepo-tprofileversion-student-information">
              <img alt="wallpaper0211051" src="images/wallpaper0211051-5w3-400h.png"
                class="verificationrepo-tprofileversion-wallpaper021" />
              <span class="verificationrepo-tprofileversion-text65">
                <span>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin
                  vel risus accumsan, efficitur ipsum eu, eleifend mi. Donec
                  placerat nisi eget nulla consectetur, sed posuere libero
                  maximus. Aliquam et viverra magna. Suspendisse odio ipsum,
                  mollis non neque ut, cursus efficitur augue. Cras consectetur
                  lorem at odio fringilla, vel posuere turpis porttitor.
                  Vestibulum condimentum, ante non euismod pretium, nisl nisi
                  volutpat libero, eget auctor enim arcu eu nisl. Morbi id
                  aliquet erat.
                </span>
              </span>
              <span class="verificationrepo-tprofileversion-text67">
                <span>STUDENT INFORMATION</span>
              </span>
            </div>
            <div class="verificationrepo-tprofileversion-moving-preferences">
              <img alt="wallpaper0311051" src="images/wallpaper0311051-tl2i-400h.png"
                class="verificationrepo-tprofileversion-wallpaper031" />
              <span class="verificationrepo-tprofileversion-text69">
                <span>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin
                  vel risus accumsan, efficitur ipsum eu, eleifend mi. Donec
                  placerat nisi eget nulla consectetur, sed posuere libero
                  maximus. Aliquam et viverra magna. Suspendisse odio ipsum,
                  mollis non neque ut, cursus efficitur augue. Cras consectetur
                  lorem at odio fringilla, vel posuere turpis porttitor.
                  Vestibulum condimentum, ante non euismod pretium, nisl nisi
                  volutpat libero, eget auctor enim arcu eu nisl. Morbi id
                  aliquet erat.
                </span>
              </span>
              <span class="verificationrepo-tprofileversion-text71">
                <span>MOVING PREFERENCES</span>
              </span>
            </div>
            <span class="verificationrepo-tprofileversion-text73">
              <span>Personal Information</span>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>