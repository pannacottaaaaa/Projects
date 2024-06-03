<?php
require_once('index-db.php');

session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Home | Dormie</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    
    <!-- home page's css file-->
    <link rel='stylesheet' type='text/css' media='screen' href='styles/index_style.css'>
    
    <!-- to connect nav bar and footer -->
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script>
    $(function(){
    $("#nav-placeholder").load("nav.php");
    $("#footer-placeholder").load("footer.html");
    });
    </script>

    <!-- Google Fonts stylesheets -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
    <!-- Icons -->
    <script src="https://kit.fontawesome.com/ab364ae083.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
    <div id="main-grid">
        <div id="header">
            <!--Navigation bar-->
            <?php include_once ("nav.php") ?>
            <!--end of Navigation bar-->
        </div>

        <div id="content">
            <div class="main">

                <!-- DORMIE INTRO TEXT SECTION-->
            
                    <div class="upper_text">
                        <h1>Rent rooms and find a Dormie<br> in our verified community</h1>
                        <h2 id="how-it-works"><a href="about.php#how-dormie-works">How Dormie Works</a></h2>
                    </div>
                    
                    <!--
                    <div class="search_section">
                        <p id="search_label">Find and rent your perfect dorms</p>
                        <br>
                        <input id="search_bar" type="text" placeholder="Browse Dorms">
                        <a href="#"><button id="search_btn"><i class="fa fa-search"></i></button></a>
                        <br>
                    </div>
                    -->
            
                <!-- DORMIE STATISTICS SECTION-->
            
                    <div class="stats_section">
                        <table>
                            <tr>
                                <th>50+</th>
                                <th>100+</th>
                                <th>200+</th>
                            </tr>
                            <tr id="description">
                                <td>Dorms</td>
                                <td>Project Finished</td>
                                <td>Happy Customers</td>
                            </tr>
                        </table>
                    </div>
            
                <!-- FEATURED DORMS SECTION-->
            
                    <h3 class="title_txt">Featured Dorms</h3>
            
                    <div class="featured_dorms" id="ftd_dorms">
                        <div class="dorm-container">
            
                        <!-- 1ST FEATURED DORM -->
                            <div class="dorm"><a href="room-landing.php?id=1">
                                <img src="images/a-main.jpg" alt="sample photo">
            
                                <div class="desc">
                                    <h3><a href="#">Fully Furnished Dorm, Makati</a></h3>
                                    
                                    <div class="amenities">
                                        <span>2 Bedrooms | February 15, 2023</span>
                                    </div>
                                    
                                    <div class="tags">
                                        <button class="dorm_tag">WiFi</button>
                                        <button class="dorm_tag">AC</button>
                                        <button class="dorm_tag">TV</button>
                                        <button id="dorm_tag_more" class="dorm_tag">See More</button>
                                    </div>
            
                                    <h4 id="dorm_price">₱25000/month</h4>
                                </div>
                            </a>
                            </div>
                        
                        <!-- 2ND FEATURED DORM -->
                            <div class="dorm"><a href="room-landing.php?id=2">
                                <img src="images/b-main.jpg" alt="sample photo">
            
                                <div class="desc">
                                    <h3><a href="#">Cozy and Affordable Dorm, Makati</a></h3>
                                    
                                    <div class="amenities">
                                        <span>3 Bedrooms | January 31, 2023</span>
                                    </div>
                                    
                                    <div class="tags">
                                        <button class="dorm_tag">Storage</button>
                                        <button class="dorm_tag">Kitchen</button>
                                        <button id="dorm_tag_more" class="dorm_tag">See More</button>
                                    </div>
            
                                    <h4 id="dorm_price">₱3,000/month</h4>
                                </div>
                            </a>
                            </div>
            
                        <!-- 3RD FEATURED DORM -->
                            <div class="dorm"><a href="room-landing.php?id=3">
                                <img src="images/c-main.jpg" alt="sample photo">
            
                                <div class="desc">
                                    <h3><a href="#">Spacious Dormitory, Makati</a></h3>
                                    
                                    <div class="amenities">
                                        <span>2 Bedrooms | February 3, 2023</span>
                                    </div>
                                    
                                    <div class="tags">
                                        <button class="dorm_tag">WiFi</button>
                                        <button class="dorm_tag">AC</button>
                                        <button class="dorm_tag">TV</button>
                                        <button id="dorm_tag_more" class="dorm_tag">See More</button>
                                    </div>
            
                                    <h4 id="dorm_price">₱15,000/month</h4>
                                </div>
                            </a>
                            </div>
            
                        </div>
                    </div>
            
                <!-- AVAILABLE DORMIES SECTION-->
                    <h3 class="title_txt">Available Dormies</h3>
                    <div class="available_dormies" id="avl_dormie">
                        <div class="dormie-container">
            
                            <!-- 1ST AVAILABLE DORMIE -->
                                <div class="dormie"><a href="landing-page-dormie.php?id=JakeTheSimulator">
                                    <img src="images/jake_sim.png" alt="sample photo">
                
                                    <div class="desc">
                                        <!-- DORMIE NAME, AGE -->
                                        <h3><a href="landing-page-dormie.php?id=JakeTheSimulator">Jake Sim, 19</a></h3>
                                        
                                        <!-- LOCATION, MOVE-IN DATE -->
                                        <div class="loc_movein">
                                            <span>Quezon City, June 17</span>
                                        </div>
                
                                        <!-- SEX, SCHOOL DEPARTMENT -->
                                        <div class="sex_dept">
                                            <span>Male | School of Information Technology</span>
                                        </div>
            
                                        <h4 id="dormie_budget">Budget: ₱5,000/month</h4>
                                    </div>
                                </a>
                                </div>
                            
                            <!-- 2ND AVAILABLE DORMIE -->
                            <div class="dormie"><a href="landing-page-dormie.php?id=LivvyMayflower">
                                <img src="images/olivia_may.png" alt="sample photo">
            
                                <div class="desc">
                                    <!-- DORMIE NAME, AGE -->
                                    <h3><a href="#">Olivia May, 20</a></h3>
                                    
                                    <!-- LOCATION, MOVE-IN DATE -->
                                    <div class="loc_movein">
                                        <span>Quezon City, February 10</span>
                                    </div>
            
                                    <!-- SEX, SCHOOL DEPARTMENT -->
                                    <div class="sex_dept">
                                        <span>Female | School of Media Studies</span>
                                    </div>
            
                                    <h4 id="dormie_budget">Budget: ₱2,500/month</h4>
                                </div>
                            </a>
                            </div>
                
                            <!-- 3RD AVAILABLE DORMIE -->
                            <div class="dormie"><a href="landing-page-dormie.php?id=KaedeKazu">
                                <img src="images/kaedehara-kazuha.png" alt="sample photo">
            
                                <div class="desc">
                                    <!-- DORMIE NAME, AGE -->
                                    <h3><a href="#">Kaedehara Kazuha, 18</a></h3>
                                    
                                    <!-- LOCATION, MOVE-IN DATE -->
                                    <div class="loc_movein">
                                        <span>Parañaque City, July 24</span>
                                    </div>
            
                                    <!-- SEX, SCHOOL DEPARTMENT -->
                                    <div class="sex_dept">
                                        <span>Male | School of Information Technology</span>
                                    </div>
            
                                    <h4 id="dormie_budget">Budget: ₱3,000/month</h4>
                                </div>
                            </a>
                            </div>
                        </div>
                    </div>
                
                <!-- DORMIE FEATURES SECTION-->
                    <h3 class="title_txt" id="features">Dormie Fa So La Ti Do</h3>
                    <p class="subtext">
                        The key to finding dorms for rent and a Dormie<br>
                        safely is transparency and trust. Let us help you!
                    </p>
            
                    <div class="dormie_features" id="dormie_feat">
                        <div class="features-container">
                            <div class="feature" id="feat_1">
                                <img src="images/find_dormie.png" alt="sample photo">
            
                                <div class="desc">
                                    <!-- DORMIE FEATURE -->
                                    <h3>Find a Dormie</h5>
            
                                    <!-- FEATURE DESCRIPTION -->
                                    <p>Create a profile, describe yourself, and<br> 
                                        customize your dorm preferences, as <br>
                                        well as what kind of roommates you<br>
                                        are looking for.</p>
            
                                    <h4 id="learn_more"><a href="about.php#how-dormie-works">
                                        Learn More
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a></h4>
                                </div>
                            </div>
            
                            <div class="feature" id="feat_2">
                                <img src="images/safe_renting.png" alt="sample photo">
            
                                <div class="desc">
                                    <!-- DORMIE FEATURE -->
                                    <h3>Safe Renting</h5>
            
                                    <!-- FEATURE DESCRIPTION -->
                                    <p>Your personal information (i.e. student<br>
                                        number, school department, etc.) is<br>
                                        kept private, and only those who need<br>
                                        to know are given access.</p>
            
                                    <h4 id="learn_more"><a href="about.php#how-dormie-works">
                                        Learn More
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a></h4>
                                </div>
                            </div>
            
                            <div class="feature" id="feat_3">
                                <img src="images/background_check.png" alt="sample photo">
            
                                <div class="desc">
                                    <!-- DORMIE FEATURE -->
                                    <h3>Background Check</h5>
            
                                    <!-- FEATURE DESCRIPTION -->
                                    <p>Request credit, criminal<br>
                                        background, and eviction report<br>
                                        if someone has a violent or<br> 
                                        harmful behavior history.</p>
            
                                    <h4 id="learn_more"><a href="about.php#how-dormie-works">
                                        Learn More
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <!-- DORMIE TESTIMONIALS SECTION-->
                    <h3 class="title_txt" id="user_testimonials">Testimonials</h3>
                    <p class="subtext" id="st_testim">
                        We work with several leading dorm landlords<br>
                        to ensure that Dormie brings Mapúan students together
                    </p>
                    <div class="testimonials" id="dormie_testim">
                        <!-- LAYER 1 TESTIMONIALS-->
                        <div class="testimonials-container">
                            <div class="testim">
                                <div class="review">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer placerat<br>
                                        nisl sit amet magna imperdiet, ac efficitur arcu tristique. In hac habitasse<br>
                                        platea dictumst. Pellentesque turpis lacus, dapibus vel tellus sed, pulvinar<br>
                                        tincidunt ante. Nunc tincidunt urna massa, non imperdiet nisl suscipit quis.
                                    </p>
                                </div>
            
                                <div class="user_label">
                                    <img id="user_pic" src="images/user.png" alt="user profile picture">
                                    <h3>Jane Doe</h3>
                                    <span>Dormie User</span>
                                </div>
                            </div>
            
                            <div class="testim">
                                <div class="review">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer placerat<br>
                                        nisl sit amet magna imperdiet, ac efficitur arcu tristique. In hac habitasse<br>
                                        platea dictumst. Pellentesque turpis lacus, dapibus vel tellus sed, pulvinar<br>
                                        tincidunt ante. Nunc tincidunt urna massa, non imperdiet nisl suscipit quis.
                                    </p>
                                </div>
            
                                <div class="user_label">
                                    <img id="user_pic" src="images/user.png" alt="user profile picture">
                                    <h3>Jane Doe</h3>
                                    <span>Dormie User</span>
                                </div>
                            </div>
                        </div>
            
                        <!-- LAYER 2 TESTIMONIALS-->
                        <div class="testimonials-container">
                            <div class="testim">
                                <div class="review">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer placerat<br>
                                        nisl sit amet magna imperdiet, ac efficitur arcu tristique. In hac habitasse<br>
                                        platea dictumst. Pellentesque turpis lacus, dapibus vel tellus sed, pulvinar<br>
                                        tincidunt ante. Nunc tincidunt urna massa, non imperdiet nisl suscipit quis.
                                    </p>
                                </div>
            
                                <div class="user_label">
                                    <img id="user_pic" src="images/user.png" alt="user profile picture">
                                    <h3>Jane Doe</h3>
                                    <span>Dormie User</span>
                                </div>
                            </div>
            
                            <div class="testim">
                                <div class="review">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer placerat<br>
                                        nisl sit amet magna imperdiet, ac efficitur arcu tristique. In hac habitasse<br>
                                        platea dictumst. Pellentesque turpis lacus, dapibus vel tellus sed, pulvinar<br>
                                        tincidunt ante. Nunc tincidunt urna massa, non imperdiet nisl suscipit quis.
                                    </p>
                                </div>
            
                                <div class="user_label">
                                    <img id="user_pic" src="images/user.png" alt="user profile picture">
                                    <h3>Jane Doe</h3>
                                    <span>Dormie User</span>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

        <div id="footer">
            <!--Footer-->
            <div id="footer-placeholder"></div>
            <!--end of Footer-->
        </div>
    </div>
</body>
</html>
