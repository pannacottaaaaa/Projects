<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="about-style.css">
    <title>About Us | Dormie</title>
    <!-- Font Awesome CDN-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <!-- Google Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="styles/about-style.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- FOR NAV AND FOOTER -->
    <script>
      $(function(){
      $("#nav-placeholder").load("nav.html");
      $("#footer-placeholder").load("footer.html");
      });
    </script>
    
    <script src="components/header.js" type="text/javascript" defer></script>
    <script src="components/footer.js" type="text/javascript" defer></script>

    <style>
      /* NOTE: PUT THIS IN A (main?) STYLESHEET */
      /* MAIN GRID (header - content - footer) --start-- */
      #maingrid {
        display: grid;
        width: 100%;
        grid-template-areas: "head head"
                  "cont cont"
                  "foot foot";
        grid-template-columns: 1fr 1fr;
        grid-template-rows: auto;
      }
    
      #maingrid > header {
        grid-area: head;
        position: sticky;
        top: 0;
        z-index: 1;
      }
    
      #maingrid > #content {
        grid-area: cont;
        margin-bottom: 5%;
      }
    
      #maingrid > #sidebar {
        grid-area: side;
      }
    
      #maingrid > footer {
        grid-area: foot;
      }
      /* --end--*/
    </style>
</head>
<body>

  <div id="maingrid">
    <header><?php include_once ("nav.php") ?></header>
  
    <div id="content">
      <div class="about-section">
        <h1>About Us</h1>
        <p style="color:white;">  If you don't have many friends, family, or connections, you can try finding good roommates and bed space near your university online.</p>
        <p style="color:white;">Therefore, Dormie website can assist Makati Campus, Mapua University students in finding the perfect roommate match.</p>
      </div>
      
      <div class="responsive-container-block container">
        <p class="text-blk team-head-text">
          Our Team&nbsp;
        </p>
        <div class="responsive-container-block">
      
          <div class="responsive-cell-block wk-desk-3 wk-ipadp-3 wk-tab-6 wk-mobile-12 card-container">
            <div class="card">
              <div class="team-image-wrapper">
                <img class="team-member-image" src="images/racquel.png">
              </div>
              <p class="text-blk name">
                Racquel Caranay
              </p>
              <p class="text-blk position">
                Developer
              </p>
              <p class="text-blk feature-text">
                Racquel is a 2nd year Computer Science college student at Mapua University who wants to improve and implement a unique game.
              </p>
            </div>
          </div>
        
          <div class="responsive-cell-block wk-desk-3 wk-ipadp-3 wk-tab-6 wk-mobile-12 card-container">
            <div class="card">
              <div class="team-image-wrapper">
                <img class="team-member-image" src="images/eonn.png">
              </div>
              <p class="text-blk name">
                Eonn Domingo
              </p>
              <p class="text-blk position">
                Developer
              </p>
              <p class="text-blk feature-text">
                 Eonn is a 2nd year Computer Science student at Mapúa University who loves to learn—from fishkeeping to coding and beyond.
              </p>
            </div>
          </div>
        
          <div class="responsive-cell-block wk-desk-3 wk-ipadp-3 wk-tab-6 wk-mobile-12 card-container">
            <div class="card">
              <div class="team-image-wrapper">
                <img class="team-member-image" src="images/rya.png">
              </div>
              <p class="text-blk name">
                Rya Gumiran
              </p>
              <p class="text-blk position">
                Developer
              </p>
              <p class="text-blk feature-text">
                Rya is a 2nd year Computer Science student at Mapúa University - Makati who is also passionate about art and music.
              </p>
            </div>
          </div>
        
          <div class="responsive-cell-block wk-desk-3 wk-ipadp-3 wk-tab-6 wk-mobile-12 card-container">
            <div class="card">
              <div class="team-image-wrapper">
                <img class="team-member-image" src="images/evan.png">
              </div>
              <p class="text-blk name">
                Evan Naad
              </p>
              <p class="text-blk position">
                Former Developer
              </p>
              <p class="text-blk feature-text">
                Evan is a second-year Computer Science student at Mapúa University who is well-known for her outgoing personality.
              </p>
            </div>
          </div>
		  
		  <div class="responsive-cell-block wk-desk-3 wk-ipadp-3 wk-tab-6 wk-mobile-12 card-container">
            <div class="card">
              <div class="team-image-wrapper">
                <img class="team-member-image" src="images/alen.png">
              </div>
              <p class="text-blk name">
                Alen Navarro
              </p>
              <p class="text-blk position">
                Developer
              </p>
              <p class="text-blk feature-text">
                Alen is a second-year Computer Science student at Mapúa University who do stuff.
              </p>
            </div>
          </div>
      
          <div class="responsive-cell-block wk-desk-3 wk-ipadp-3 wk-tab-6 wk-mobile-12 card-container">
            <div class="card">
              <div class="team-image-wrapper">
                <img class="team-member-image" src="images/tricia.png">
              </div>
              <p class="text-blk name">
                Tricia Radovan
              </p>
              <p class="text-blk position">
                Team Lead
              </p>
              <p class="text-blk feature-text">
                Tricia is a second-year Computer Science student at Mapúa University who is diligent and innovative with an inquiring mind.
              </p>
            </div>
          </div>
        </div>
      </div>
      
      <a id="how-dormie-works">
      <div class="about-section">
        <h1>How Dormie Works</h1>
        <p style="color:white;">Check out Dormie's features!</p>
      </div>
      </a>
      
          <section>
            <!--<div class="row">
              <h2 class="section-heading"></h2>
            </div> --> 
      
            <div class="row">
              <div class="column">
                <div class="card">
                  <div class="icon-wrapper">
                    <i class="fa fa-home" aria-hidden="true"></i>
                  </div>
                  <h3>Find a Dorm</h3>
                  <p>
                    Search listings within a specified radius from Mapua University and shortlist dorm options based on rent, amenities, and lifestyle preferences.
                  </p>
                </div>
              </div>
              <div class="column">
                <div class="card">
                  <div class="icon-wrapper">
                    <i class="fa fa-user" aria-hidden="true"></i>
                  </div>
                  <h3>Find a Dormie</h3>
                  <p>
                    Create a profile, describe yourself, and customize your dorm preferences, as well as what kind of roommates you are looking for. 
                  </p>
                </div>
              </div>
              <div class="column">
                <div class="card">
                  <div class="icon-wrapper">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                  </div>
                  <h3>Dormie Inquire via Email</h3>
                  <p>
                    Get to know the people you may live with or connect with fellow dormies and inquire through email.
                  </p>
                </div>
              </div>
              <div class="column">
                <div class="card">
                  <div class="icon-wrapper">
                    <i class="fa fa-key" aria-hidden="true"></i>
                  </div>
                  <h3>Safe Renting</h3>
                  <p>
                    Your personal information is kept private, and only those who need to know are given access.
                  </p>
                </div>
              </div>
              <div class="column">
                <div class="card">
                  <div class="icon-wrapper">
                    <i class="fa fa-file" aria-hidden="true"></i>
                  </div>
                  <h3>Online File Management</h3>
                  <p>
                    Securely share and store photos and videos of the room with your renters and owners.
                  </p>
                </div>
              </div>
              <div class="column">
                <div class="card">
                  <div class="icon-wrapper">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </div>
                  <h3>Roommate Background Check</h3>
                  <p>
                    Request credit, criminal background, and eviction report if someone has a violent or harmful behavior history.
                  </p>
                </div>
              </div>
            </div>
          </section>
    </div>

    <footer><div id="footer-placeholder"></div></footer>
  </div>
</body>
</html>
