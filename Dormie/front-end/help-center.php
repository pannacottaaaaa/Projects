<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Help Center</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

	<link rel="stylesheet" href="styles/termsandpol.css">
</head>
<body>
    <div class="maingrid">
      <div id="header">
        <!--Navigation bar-->
        <?php include_once ("nav.php") ?>
        <!--end of Navigation bar-->
      </div>

      <div class="content">
            <!-- Place Code Here -->
        <div class="container">
            <h1>Welcome to the Dormie Help Center</h1><br>
            <p>At Dormie, we're committed to helping you find the perfect roommate and rental property. If you have any questions or concerns about using our platform, we're here to help. </p>
                
            <hr>
            <div class="innerContainer">
                <h2>Frequently Asked Questions</h2><br>
                <ul>
                    <li><h3>What is Dormie and how does it work?</h3></li>
                    <p>Dormie is a platform that helps people find compatible roommates and rental properties. It works by allowing users to create a profile, search for available dorms, and connect with potential roommates.</p>
                    <br>
                    <li><h3>What should I do if I suspect that a property listed on Dormie is fraudulent?</h3></li>
                    <p>If you suspect that a property listed on Dormie is fraudulent, report the listing immediately to Dormie support. They will investigate the listing and take appropriate action if necessary.</p>
                    <br> <!-- regarding this i am not so sure feel free to edit this one thanks! -->
                    
                    <li><h3>What are the benefits of getting verified on Dormie?</h3></li>
                    <p>Verified users have access to more search filters and can see more detailed information about listings, giving them an advantage in the rental market. Being verified also helps to build trust and confidence among the Dormie community, leading to more successful matches and interactions.</p>
                    <br>
                    <li><h3>How can I get verified on Dormie?</h3></li>
                    <p>If you want to become a verified Dormie, you can apply for a Dormie Boost status. To do this, you need to upload a valid government ID or university ID and either an NBI clearance or a Certificate of Good Moral Character from your respective university.</p>
                    <br>
                    <li><h3>How do I find a roommate on Dormie?</h3></li>
                    <p>To find a roommate on Dormie, you can browse through the profiles of other users who are looking for roommates. You can filter your search by location, budget, lifestyle preferences, and more.</p>
                    <br>
                    <li><h3>How can I find the best housing option for me?</h3></li>
                    <p>Dormie offers a variety of search filters to help you find the best housing option for your needs, such as location, price range, and amenities. Our platform will then show you a list of available properties that match your search criteria. You can further refine your search by using our filters.</p>
                    <br>
                    <li><h3>How do I message potential roommates on Dormie?</h3></li>
                    <p>To message potential roommates on Dormie, you can click on their profile from the "Find a Dormie" page, and you will be directed to the Dormie landing screen. From there, you can learn more about the potential roommate and get in touch with them by clicking on the "Message" button that will direct you to your email application.</p>
                    <br>	
                    <li><h3>Can I trust the owners or landlords on Dormie?</h3></li>
                    <p>Dormie carefully screens all owners or landlords and verifies their information to ensure that they are trustworthy and provide safe and comfortable living conditions.</p>
                    <br>
                    <li><h3>Can I list my property for rent on Dormie as an individual landlord?</h3></li>
                    <p>Yes, Dormie takes the privacy and security of its users very seriously and uses industry-standard security measures to protect your personal information.</p>
                    <br>
                    <li><h3>Is my personal information safe with Dormie?</h3></li>
                    <p>Yes, Dormie takes the privacy and security of its users very seriously and uses industry-standard security measures to protect your personal information.</p>
                    <br>
                </ul>
            </div>
            
            <hr>
            <h2>Contact Us</h2><br>
            <p>If you have any questions or concerns about Dormie, please don't hesitate to contact us. You can reach us by email at <u>dormie2023@gmail.com</u>. Our customer support team is available 24/7 to assist you.</p>
            </div>
      </div>

      <div id="footer">
        <!--Footer-->
        <?php include_once ("footer.html") ?>
        <!--end of Footer-->
      </div>
    </div>
</body>
</html>