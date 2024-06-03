<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Contact Us | Dormie</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="styles/contact-style.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
      margin-bottom: 2.5%;
    }

    #maingrid > #sidebar {
      grid-area: side;
    }

    #maingrid > footer {
      grid-area: foot;
    }

    body {
      font-family: Poppins;
      min-height: 100vh;
      margin: 0;
    }


    .head {
    text-align: left;
    color: #000000;
    padding: 15px;
    }
  </style>
</head>
<body>
  <div id="maingrid">
		<header><?php include_once ("nav.php") ?></header>

    <div id="content">
      <section class="footer_get_touch_outer">
        <div class="container">
          <div class="footer_get_touch_inner grid-70-30">
            <div class="colmun-70 get_form">
              <div class="get_form_inner">
                <div class="get_form_inner_text">
                  <h3>Contact Us</h3>
                </div>
                <form action="https://formsubmit.co/dormie2023@gmail.com" method="POST" enctype="multipart/form-data">
                  <div class="grid-50-50">
                    <input type="text" name="first_name" placeholder="First Name">
                    <input type="text" name="last_name" placeholder="Last Name">
                    <input type="email" name="email" placeholder="Email">
                    <input type="tel" name="phone" placeholder="Phone">
                  </div>
                  <div class="grid-full">
                    <textarea placeholder="Send us a message" cols="30" rows="10" name="message"></textarea>
                    <input type="submit" value="Submit">
                  </div>
                </form>
              </div>
            </div>
            <div class="colmun-30 get_say_form">
              <h5>Get in touch!</h5>
              <ul class="get_say_info_sec">
                <li>
                  <i class="fa fa-envelope"></i>
                  <a href="mailto:dormiefasolatido@gmail.com">dormiefasolatido@gmail.com</a>
                </li>
                <li>
                  <i class="fa fa-facebook"></i>
                  <a href="https://www.facebook.com/profile.php?id=100090001957355">Dormie</a>
                </li>
                <li>
                  <i class="fa fa-instagram"></i>
                  <a href="https://www.instagram.com/dormiefasolatido/">@official.dormie</a> 
                </li>
              </ul>          
          <p style="color: white;">We will do our best to reply to <br>your concerns and take actions immediately. - Developers</p>
            </div>        
          </div>
        </div>
      </section>
    </div>

		<footer><div id="footer-placeholder"></div></footer>
  </div>
</body>
</html>