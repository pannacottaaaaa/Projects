<?php
// Connect to the database
session_start();
$connect = mysqli_connect('localhost', 'dormie', 'password', 'dormie', '3306');

if (isset($_GET['id'])) {
  $listing_id = mysqli_real_escape_string($connect, $_GET['id']);

  $query = "SELECT * FROM listing WHERE listing_id='$listing_id'";
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
  <title>Verification Listing Report</title>
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
  <link rel="stylesheet" href="styles/anothervrlstyle.css" />
</head>

<body>
    <div>
      <link href="styles/verificationrepo-tlistingversion.css" rel="stylesheet" />
      <div class="verificationrepo-tlistingversion-container">
        <div class="verificationrepo-tlistingversion-verificationrepo-tlistingversion">
          <div class="verificationrepo-tlistingversion-logged-in-navbarfor-admins">
            <img alt="Rectangle11222" src="images/rectangle11222-pvun.svg"
              class="verificationrepo-tlistingversion-rectangle1" />
            <img alt="logoname11222" src="images/logoname11222-28r-200w.png"
              class="verificationrepo-tlistingversion-logoname1" />
            <div class="verificationrepo-tlistingversion-text">
              <div>Dorms for Rent</div>
            </div>
            <div class="verificationrepo-tlistingversion-text02">
              <div>Find a Dormie</div>
            </div>
            <div class="verificationrepo-tlistingversion-hamburger">
              <img alt="Line31222" src="images/line31222-rksi.svg" class="verificationrepo-tlistingversion-line3" />
              <img alt="Line11222" src="images/line11222-y98.svg" class="verificationrepo-tlistingversion-line1" />
              <img alt="Line21222" src="images/line21222-ashh.svg" class="verificationrepo-tlistingversion-line2" />
            </div>
            <div class="verificationrepo-tlistingversion-sign-up-navbar-button">
              <div class="verificationrepo-tlistingversion-text04">
                <div>Log Out</div>
              </div>
            </div>
          </div>
          <div class="verificationrepo-tlistingversion-footer">
            <div class="verificationrepo-tlistingversion-text06">
              <div>Verified Dormie</div>
            </div>
            <div class="verificationrepo-tlistingversion-text08">
              <div>
                They are required to upload documents in PDF form to prove their
                reputable character (e.g. valid government I.D, NBI clearance,
                Certificate of Good Moral Conduct from their respective
                University) and be verified as a Dormie.
              </div>
            </div>
            <div class="verificationrepo-tlistingversion-text10">
              <div>All rights reserved by © Dormie 2022</div>
            </div>
            <img alt="Line51222" src="images/line51222-0kg.svg" class="verificationrepo-tlistingversion-line5" />
            <div class="verificationrepo-tlistingversion-text12">
              <div>Company</div>
            </div>
            <div class="verificationrepo-tlistingversion-text14">
              <div>How Dormie Works</div>
            </div>
            <div class="verificationrepo-tlistingversion-text16">
              <div>
                <div>About</div>
                <br />
                <div></div>
              </div>
            </div>
            <div class="verificationrepo-tlistingversion-text21">
              <div>Contact</div>
            </div>
            <div class="verificationrepo-tlistingversion-text23">
              <div>Contact Support</div>
            </div>
            <div class="verificationrepo-tlistingversion-text25">
              <div>Terms and Policies</div>
            </div>
          </div>
          <img alt="Rectangle15261222" src="images/rectangle15261222-072-1500w.png"
            class="verificationrepo-tlistingversion-rectangle1526" />
          <img alt="Rectangle15191222" src="images/rectangle15191222-zmrlp-1500w.png"
            class="verificationrepo-tlistingversion-rectangle1519" />
          <div class="verificationrepo-tlistingversion-linkto-google-form-data">
            <div class="verificationrepo-tlistingversion-text27">
              <div>Link to Google Form Data</div>
            </div>
            <!-- change action from verification-report-listing-data.php to verification-report-profile-data.php-->
            <form action="verification-report-listing-data.php" method="post">
              <div class="verificationrepo-tlistingversion-evaluation">
                <div class="verificationrepo-tlistingversion-text29">
                  <div>EVALUATION</div>
                </div>
                <div class="verificationrepo-tlistingversion-text31">
                  Invalid Requirement/s
                </div>
                <div class="verificationrepo-tlistingversion-text32">
                  <div>Missing Requirement/s</div>
                </div>
                <input id="invalid_req" name="invalid_req" type="checkbox" checked="1"
                  class="verificationrepo-tlistingversion-checkbox" />
                <textarea id="justification" name="justification" placeholder="     Justification"
                  class="verificationrepo-tlistingversion-textarea textarea"></textarea>
                <input id="missing_req" name="missing_req" type="checkbox" checked="1"
                  class="verificationrepo-tlistingversion-checkbox1" />
              </div>
              <div class="verificationrepo-tlistingversion-status">
                <div class="verificationrepo-tlistingversion-text34">
                  <div>STATUS</div>
                </div>
                <select id="results" name="results" class="verificationrepo-tlistingversion-select">
                  <option value="1" selected="">Approved</option>
                  <option value="0">Rejected</option>
                </select>
              </div>
              <div class="verificationrepo-tlistingversion-history">
                <div class="verificationrepo-tlistingversion-text36">
                  <div>HISTORY</div>
                </div>
                <div class="verificationrepo-tlistingversion-text38">
                  <span> Approved <span id="current-date" name="creation_date"> </span></span>
                  <script>
                    var currentDate = new Date();
                    var options = { year: 'numeric', month: 'numeric', day: 'numeric' };
                    document.getElementById("current-date").innerHTML = currentDate.toLocaleDateString('en-US', options);
                  </script>
                  <br />
                  <span>by Admin345</span>
                </div>
                <button type="submit" value="Submit" class="verificationrepo-tlistingversion-button button">
                  <a href = "rooms-for-rent.php">
                  Submit
                </a>
                </button>
              </div>
            </form>
          </div>
          <div class="verificationrepo-tlistingversion-backbutton">
            <div class="verificationrepo-tlistingversion-text42">
              <div>Back to List</div>
            </div>
            <button class="verificationrepo-tlistingversion-button1 button" onclick="redirectToVerificationRequests()">
              ←
            </button>
            <script>
              function redirectToVerificationRequests() {
                window.location.href = "verification-requests.php";
              }
            </script>
          </div>
          <div class="verificationrepo-tlistingversion-photos">
            <div class="verificationrepo-tlistingversion-text44">
              <div>
                <?php echo $row['listing_title'] ?>
              </div>
            </div>
            <div class="verificationrepo-tlistingversion-text46">
              <div>Name</div>
            </div>
            <div class="verificationrepo-tlistingversion-text48">
              <div>
                <?php echo $row['city'] ?> <!-- MAKATI CITY -->,
                <?php echo $row['region'] ?> <!-- METRO MANILA -->
              </div>
            </div>
            <div class="verificationrepo-tlistingversion-text50">
              <div>Location</div>
            </div>
            <img alt="MicrosoftTeamsimage211222" src="images/microsoftteamsimage211222-in5w-200h.png"
              class="verificationrepo-tlistingversion-microsoft-teamsimage21" />
            <img alt="MicrosoftTeamsimage111222" src="images/microsoftteamsimage111222-obil-400h.png"
              class="verificationrepo-tlistingversion-microsoft-teamsimage11" />
            <img alt="MicrosoftTeamsimage311222" src="images/microsoftteamsimage311222-qk4a-200h.png"
              class="verificationrepo-tlistingversion-microsoft-teamsimage31" />
            <img alt="MicrosoftTeamsimage411222" src="images/microsoftteamsimage411222-0uwa-200h.png"
              class="verificationrepo-tlistingversion-microsoft-teamsimage41" />
            <img alt="MicrosoftTeamsimage511222" src="images/microsoftteamsimage511222-4huj-200h.png"
              class="verificationrepo-tlistingversion-microsoft-teamsimage51" />
          </div>
          <div class="verificationrepo-tlistingversion-information">
            <div class="verificationrepo-tlistingversion-text52">
              <div>Map</div>
            </div>
            <div class="verificationrepo-tlistingversion-text54">
              <div>
                <?php echo $urow['first_name'] ?> 
                <?php echo $urow['last_name'] ?>
              </div>
            </div>
            <div class="verificationrepo-tlistingversion-text56">
              <div>hosted by</div>
            </div>
            <img alt="ScreenShot20230330at105711222" src="images/screenshot20230330at105711222-r3r8-1100w.png"
              class="verificationrepo-tlistingversion-screen-shot20230330at10571" />
            <img alt="image21222" src="images/image21222-qrk-300h.png"
              class="verificationrepo-tlistingversion-image2" />
            <div class="verificationrepo-tlistingversion-description1">
              <div class="verificationrepo-tlistingversion-text58">
                <div>This dorm has <!-- private -->
                  <?php echo $row['listing_type'] ?> rooms and <!-- private bedrooms-->
                  <?php echo $row['listing_type'] ?>.
                </div>
              </div>
              <div class="verificationrepo-tlistingversion-text60">
                <div>
                  <div>
                    WiFi, individual workspaces, kitchen appliances and
                    utensils, fire extinguisher, closets, smoke detector, and
                    first aid kits are offered by this location. Air conditioning
                    units are installed, but the electricity bill is to be
                    shouldered by all Dormies on top of the monthly rent.
                  </div>
                </div>
              </div>
              <div class="verificationrepo-tlistingversion-text65">
                <div>Near the Mapua Makati Campus</div>
              </div>
              <div class="verificationrepo-tlistingversion-text67">
                <div>
                  This location is ready for move-ins by
                  <?php echo $row['movein_start'] ?> <!-- February 03, 2023 -->
                </div>
              </div>
              <div class="verificationrepo-tlistingversion-text69">
                <div>PRIVATE ROOM</div>
              </div>
              <div class="verificationrepo-tlistingversion-text71">
                <div>GREAT LOCATION</div>
              </div>
              <div class="verificationrepo-tlistingversion-text73">
                <div>MANY AMENITIES</div>
              </div>
              <div class="verificationrepo-tlistingversion-text75">
                <div>MOVE-IN DATE</div>
              </div>
            </div>
            <div class="verificationrepo-tlistingversion-description3">
              <div class="verificationrepo-tlistingversion-text77">
                <div><!-- 4 people -->
                  <?php echo $row['capacity'] ?> People
                </div>
              </div>
              <div class="verificationrepo-tlistingversion-text79">
                <div><!-- 3 Beds-->
                  <?php echo $row['bedrooms'] ?> Bedrooms
                </div>
              </div>
              <div class="verificationrepo-tlistingversion-text81">
                <div><!-- 4 Bathrooms -->
                  <?php echo $row['bathrooms'] ?> Bathrooms
                </div>
              </div>
              <div class="verificationrepo-tlistingversion-text83">
                <div><!-- 25,000/month -->
                  <?php echo $row['rent_fee'] ?>/month
                </div>
              </div>
              <div class="verificationrepo-tlistingversion-text85">
                <div>OTHER INFORMATION:</div>
              </div>
            </div>
          </div>
          <div class="verificationrepo-tlistingversion-description2">
            <div class="verificationrepo-tlistingversion-text87">
              <div>
                <?php echo $row['description'] ?>
                <!-- This elegant house offers plenty of living space and is great
                for students who prefer private rooms and bathrooms. -->
              </div>
            </div>
            <div class="verificationrepo-tlistingversion-text89">
              <div>DESCRIPTION</div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>

</html>