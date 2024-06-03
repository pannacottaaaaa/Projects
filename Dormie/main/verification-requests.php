<!--
    This is the Verification Overview page.
    [x]This page should only be accessible to admins.
    [x]Non-admins must be redirected.

    [x]By default, it should show just the pending requests.

    Filters: 
        - Pending
        - Approved
        - Rejected
        - All
    Sort by:
        - Date
-->

<?php
    require_once 'index-db.php';
    global $db;
    //$connect = mysqli_connect('localhost', 'dormie', 'password', 'dormie', '3307');

    session_start();

    if(isset($_SESSION["user_id"])) {
        $sql = "SELECT * FROM user u WHERE u.user_id = {$_SESSION["user_id"]}";
        $result = mysqli_query($db, $sql);
        $user = mysqli_fetch_assoc( $result );
        
        if ($user['is_admin'] != 1) {
            $message = "Only admins can access this page!";
            echo '<script type="text/javascript">';
            echo 'alert("' . $message . '");
            window.location.href="login-reg.php";';
            echo '</script>';
        }
        
    }

    function getPendingListingReqsDesc() {
        global $db;
        $query = 'SELECT * FROM user u, listing l WHERE (u.user_id = l.user_id AND l.is_verified IS FALSE) ORDER BY l.date_created DESC';
        $result = mysqli_query($db, $query);

        while( $record = mysqli_fetch_assoc( $result ) )
        {
            if($record["is_verified"] == 0) {
                echo "<a href='verification-report-listing.php?id={$record['listing_id']}'>
                <div class='request-card'>
                    <div class='verification-icon'>
                        <img src='images/dormie-verification-listing-icon.png' alt='listing icon' >
                    </div>
                    <div class='request-datetime'>
                        <p> ". $record["date_created"] ." </p>
                    </div>
                    <div class='request-name'>
                        <p> ". $record["listing_title"] ."</p>
                    </div>
                    <div class='request-details'>
                        <p> ". $record["listing_title"] ." | ₱". $record["rent_fee"] ." | ". $record["movein_start"] ."</p>
                    </div>
                    <div class='request-status'>
                        <p><div class='dot'></div><em>Pending</em></p>
                    </div>
                </div>
                </a>";
            }
        }
    }

    function getPendingListingReqsAsc() {
        global $db;
        $query = 'SELECT * FROM user u, listing l WHERE (u.user_id = l.user_id AND l.is_verified IS FALSE) ORDER BY l.date_created ASC';
        $result = mysqli_query($db, $query);

        while( $record = mysqli_fetch_assoc( $result ) )
        {
            if($record["is_verified"] == 0) {
                echo "<a href='verification-report-listing.php?id={$record['listing_id']}'>
                <div class='request-card'>
                    <div class='verification-icon'>
                        <img src='images/dormie-verification-listing-icon.png' alt='listing icon' >
                    </div>
                    <div class='request-datetime'>
                        <p> ". $record["date_created"] ." </p>
                    </div>
                    <div class='request-name'>
                        <p> ". $record["listing_title"] ."</p>
                    </div>
                    <div class='request-details'>
                        <p> ". $record["listing_title"] ." | ₱". $record["rent_fee"] ." | ". $record["movein_start"] ."</p>
                    </div>
                    <div class='request-status'>
                        <p><div class='dot'></div><em>Pending</em></p>
                    </div>
                </div>
                </a>";
            }
        }
    }

    function getVerifiedListingReqsDesc() {
        global $db;
        $query = 'SELECT * FROM user u, listing l WHERE (u.user_id = l.user_id AND l.is_verified IS TRUE) ORDER BY l.date_created DESC';
        $result = mysqli_query($db, $query);

        while( $record = mysqli_fetch_assoc( $result ) )
        {
            if($record["is_verified"] == 1) {
                echo "<a href='verification-report-listing.php?id={$record['listing_id']}'>
                <div class='request-card'>
                    <div class='verification-icon'>
                        <img src='images/dormie-verification-listing-icon.png' alt='listing icon' >
                    </div>
                    <div class='request-datetime'>
                        <p> ". $record["date_created"] ." </p>
                    </div>
                    <div class='request-name'>
                        <p> ". $record["listing_title"] ."</p>
                    </div>
                    <div class='request-details'>
                        <p> ". $record["listing_title"] ." | ₱". $record["rent_fee"] ." | ". $record["movein_start"] ."</p>
                    </div>
                    <div class='request-status'>
                        <p><div class='dot'></div><em>Verified</em></p>
                    </div>
                </div>
                </a>";
            }
        }
    }

    function getVerifiedListingReqsAsc() {
        global $db;
        $query = 'SELECT * FROM user u, listing l WHERE (u.user_id = l.user_id AND l.is_verified IS TRUE) ORDER BY l.date_created ASC';
        $result = mysqli_query($db, $query);

        while( $record = mysqli_fetch_assoc( $result ) )
        {
            if($record["is_verified"] == 1) {
                echo "<a href='verification-report-listing.php?id={$record['listing_id']}'>
                <div class='request-card'>
                    <div class='verification-icon'>
                        <img src='images/dormie-verification-listing-icon.png' alt='listing icon' >
                    </div>
                    <div class='request-datetime'>
                        <p> ". $record["date_created"] ." </p>
                    </div>
                    <div class='request-name'>
                        <p> ". $record["listing_title"] ."</p>
                    </div>
                    <div class='request-details'>
                        <p> ". $record["listing_title"] ." | ₱". $record["rent_fee"] ." | ". $record["movein_start"] ."</p>
                    </div>
                    <div class='request-status'>
                        <p><div class='dot'></div><em>Verified</em></p>
                    </div>
                </div>
                </a>";
            }
        }
    }

    function getPendingProfileReqsDesc() {
        global $db;
        $query = 'SELECT * FROM user u, profile p WHERE (u.user_id = p.user_id AND p.is_verified IS FALSE) ORDER BY p.date_created DESC';
        $result = mysqli_query($db, $query);

        while( $record = mysqli_fetch_assoc( $result ) )
        {
            if($record["is_verified"] == 0) {
                echo "<a href='verification-report-profile.php?id={$record['user_id']}'>
                <div class='request-card'>
                    <div class='verification-icon'>
                        <img src='images/dormie-verification-user-icon.png' alt='User icon' >
                    </div>
                    <div class='request-datetime'>
                        <p>". $record["date_created"] ."</p>
                    </div>
                    <div class='request-name'>
                        <p> ". $record["first_name"] . " " . $record["last_name"] ." </p>
                    </div>
                    <div class='request-details'>
                        <p>". $record["username"] ." | ₱". $record["budget"] ." | ". $record["target_movein"] ."</p>
                    </div>
                    <div class='request-status'>
                        <p><div class='dot'></div><em>Pending</em></p>
                    </div>
                </div>
                </a>";
            }
        }
    }

    function getPendingProfileReqsAsc() {
        global $db;
        $query = 'SELECT * FROM user u, profile p WHERE (u.user_id = p.user_id AND p.is_verified IS FALSE) ORDER BY p.date_created ASC';
        $result = mysqli_query($db, $query);

        while( $record = mysqli_fetch_assoc( $result ) )
        {
            if($record["is_verified"] == 0) {
                echo "<a href='verification-report-profile.php?id={$record['user_id']}'>
                <div class='request-card'>
                    <div class='verification-icon'>
                        <img src='images/dormie-verification-user-icon.png' alt='User icon' >
                    </div>
                    <div class='request-datetime'>
                        <p>". $record["date_created"] ."</p>
                    </div>
                    <div class='request-name'>
                        <p> ". $record["first_name"] . " " . $record["last_name"] ." </p>
                    </div>
                    <div class='request-details'>
                        <p>". $record["username"] ." | ₱". $record["budget"] ." | ". $record["target_movein"] ."</p>
                    </div>
                    <div class='request-status'>
                        <p><div class='dot'></div><em>Pending</em></p>
                    </div>
                </div>
                </a>";
            }
        }
    }

    function getVerifiedProfileReqsDesc() {
        global $db;
        $query = 'SELECT * FROM user u, profile p WHERE (u.user_id = p.user_id AND p.is_verified IS TRUE) ORDER BY p.date_created DESC';
        $result = mysqli_query($db, $query);

        while( $record = mysqli_fetch_assoc( $result ) )
        {
            if($record["is_verified"] == 1) {
                echo "<a href='verification-report-profile.php?id={$record['user_id']}'>
                <div class='request-card'>
                    <div class='verification-icon'>
                        <img src='images/dormie-verification-user-icon.png' alt='User icon' >
                    </div>
                    <div class='request-datetime'>
                        <p>". $record["date_created"] ."</p>
                    </div>
                    <div class='request-name'>
                        <p> ". $record["first_name"] . " " . $record["last_name"] ." </p>
                    </div>
                    <div class='request-details'>
                        <p>". $record["username"] ." | ₱". $record["budget"] ." | ". $record["target_movein"] ."</p>
                    </div>
                    <div class='request-status'>
                        <p><div class='dot'></div><em>Verified</em></p>
                    </div>
                </div>
                </a>";
            }
        }
    }

    function getVerifiedProfileReqsAsc() {
        global $db;
        $query = 'SELECT * FROM user u, profile p WHERE (u.user_id = p.user_id AND p.is_verified IS TRUE) ORDER BY p.date_created ASC';
        $result = mysqli_query($db, $query);

        while( $record = mysqli_fetch_assoc( $result ) )
        {
            if($record["is_verified"] == 0) {
                echo "<a href='verification-report-profile.php?id={$record['user_id']}'>
                <div class='request-card'>
                    <div class='verification-icon'>
                        <img src='images/dormie-verification-user-icon.png' alt='User icon' >
                    </div>
                    <div class='request-datetime'>
                        <p>". $record["date_created"] ."</p>
                    </div>
                    <div class='request-name'>
                        <p> ". $record["first_name"] . " " . $record["last_name"] ." </p>
                    </div>
                    <div class='request-details'>
                        <p>". $record["username"] ." | ₱". $record["budget"] ." | ". $record["target_movein"] ."</p>
                    </div>
                    <div class='request-status'>
                        <p><div class='dot'></div><em>Verified</em></p>
                    </div>
                </div>
                </a>";
            }
        }
    }

    function getAllRequests(){
        global $db;
        $query = 'SELECT * FROM user u, listing l, profile p WHERE (u.user_id = p.user_id AND p.is_verified IS FALSE) OR (u.user_id = l.user_id AND l.is_verified IS FALSE)';
        $result = mysqli_query($db, $query);
        while( $record = mysqli_fetch_assoc( $result ) )
        {
            $date = strtotime($record["target_movein"]);

            $imageData = $record['profile_picture'];

            if($record["l.listing_id"] != NULL) {
                if($record["l.is_verified"] == 0) {
                    echo "<a href='verification-report-listing.php?id={$record['username']}'>
                    <div class='request-card'>
                        <div class='verification-icon'>
                            <img src='images/dormie-verification-listing-icon.png' alt='listing icon' >
                        </div>
                        <div class='request-datetime'>
                            <p> ". $record["date_created"] ." </p>
                        </div>
                        <div class='request-name'>
                            <p> ". $record["listing_title"] ."</p>
                        </div>
                        <div class='request-details'>
                            <p>@jdelacruz | July 12, 2002 | Male</p>
                        </div>
                        <div class='request-status'>
                            <p><div class='dot'></div><em>Pending</em></p>
                        </div>
                    </div>
                    </a>";
                }
            } else {
                echo "<a href='verification-report-listing.php?id={$record['username']}'>
                <div class='request-card'>
                    <div class='verification-icon'>
                        <img src='images/dormie-verification-user-icon.png' alt='User icon' >
                    </div>
                    <div class='request-datetime'>
                        <p>March 30, 2023 14:29</p>
                    </div>
                    <div class='request-name'>
                        <p> ". $record["listing_title"] ." </p>
                    </div>
                    <div class='request-details'>
                        <p>". $record["street"] ." | ". $record["rent_fee"] ." | ". $record["movein_start"] ."</p>
                    </div>
                    <div class='request-status'>
                        <p><div class='dot'></div><em>Pending</em></p>
                    </div>
                </div>
                </a>";
            }
        }
    }

    function filterRequests() {
        global $db;

        $queryListing = 'SELECT * FROM user u, listing l WHERE (u.user_id = l.user_id)';
        $resultListing = mysqli_query($db, $queryListing);

        $queryProfile = 'SELECT * FROM user u, profile p WHERE (u.user_id = p.user_id)';
        $resultProfile = mysqli_query($db, $queryProfile);

        $rejectedListing = 'SELECT listing_id FROM listing_verification_report WHERE result = "rejected"';
        $resultRejectedListing = mysqli_query($db, $rejectedListing);

        $rejectedProfile = 'SELECT profile_id FROM profile_verification_report WHERE result = "rejected"';
        $resultRejectedProfile = mysqli_query($db, $rejectedProfile);

        $filterPending = '';
        $filterApproved = '';
        $filterRejected = '';
        $searchType = '';
        $sortType = 'desc';

        if(isset($_POST['pending'])) {
            if(isset($_POST['type'])) {
                $searchType = $_POST['type'];
                $searchType = preg_replace("#[^0-9a-z]#i","",$searchType);
                $subqueryListing = $queryListing;
                $subqueryProfile = $queryProfile;

                //$query = "SELECT * FROM ($subquery) AS b WHERE status = '$searchStatus'";
                //$result = mysqli_query($db, $query);

                if ($searchType == 'listing') {
                    //$query = "SELECT * FROM ($subqueryListing) as b";
                    //$resultListing = mysqli_query($db, $query);
                    getAllPendingListings();
                }
                else if ($searchType == 'profile') {
                    //$query = "SELECT * FROM ($subqueryProfile) as b";
                    //$resultProfile = mysqli_query($db, $query);
                    getAllPendingProfiles();
                }
                else {
                    $searchType = NULL;
                }
            } else {
                getAllPendingListings();
                getAllPendingProfiles();
            }
        } elseif(isset($_POST['type']))  {
            $searchType = $_POST['type'];
            $searchType = preg_replace("#[^0-9a-z]#i","",$searchType);
            $subqueryListing = $queryListing;
            $subqueryProfile = $queryProfile;
            if ($searchType == 'listing') {
                //$query = "SELECT * FROM ($subqueryListing) as b";
                //$resultListing = mysqli_query($db, $query);
                getAllPendingListings();
            }
            else if ($searchType == 'profile') {
                //$query = "SELECT * FROM ($subqueryProfile) as b";
                //$resultProfile = mysqli_query($db, $query);
                getAllPendingProfiles();
            }
            else {
                $searchType = NULL;
            }
        }

        /*
        if(isset($_POST['pending'])) {
            $filterPending = $_POST['pending'];
            $filterPending = preg_replace("#[^0-9a-z]#i","",$filterPending);
            $subqueryListing = $queryListing;
            $subqueryProfile = $queryProfile;

            $lquery = "SELECT * FROM ($subqueryListing) AS b WHERE is_verified IS FALSE";
            $resultListing = mysqli_query($db, $query);
            $pquery = "SELECT * FROM ($subqueryProfile) AS b WHERE is_verified IS FALSE";
            $resultProfile = mysqli_query($db, $query);

            while( $record = mysqli_fetch_assoc( $resultProfile ) )
            {
                echo "<a href='verification-report-profile.php?id={$record['user_id']}'>
                <div class='request-card'>
                    <div class='verification-icon'>
                        <img src='images/dormie-verification-user-icon.png' alt='User icon' >
                    </div>
                    <div class='request-datetime'>
                        <p>". $record["date_created"] ."</p>
                    </div>
                    <div class='request-name'>
                        <p> ". $record["first_name"] . " " . $record["last_name"] ." </p>
                    </div>
                    <div class='request-details'>
                        <p>". $record["username"] ." | ₱". $record["budget"] ." | ". $record["target_movein"] ."</p>
                    </div>
                    <div class='request-status'>
                        <p><div class='dot'></div><em>Pending</em></p>
                    </div>
                </div>
                </a>";
            }

            while( $record = mysqli_fetch_assoc( $result ) )
            {
                echo "<a href='verification-report-listing.php?id={$record['listing_id']}'>
                <div class='request-card'>
                    <div class='verification-icon'>
                        <img src='images/dormie-verification-listing-icon.png' alt='listing icon' >
                    </div>
                    <div class='request-datetime'>
                        <p> ". $record["date_created"] ." </p>
                    </div>
                    <div class='request-name'>
                        <p> ". $record["listing_title"] ."</p>
                    </div>
                    <div class='request-details'>
                        <p> ". $record["listing_title"] ." | ₱". $record["rent_fee"] ." | ". $record["movein_start"] ."</p>
                    </div>
                    <div class='request-status'>
                        <p><div class='dot'></div><em>Pending</em></p>
                    </div>
                </div>
                </a>";
            }
        } else {
            $filterPending = NULL;
        }

        if(isset($_POST['approved'])) {
            $filterApproved = $_POST['verified'];
            $filterApproved = preg_replace("#[^0-9a-z]#i","",$filterApproved);
            $subqueryListing = $queryListing;
            $subqueryProfile = $queryProfile;

            $lquery = "SELECT * FROM ($subqueryListing) AS b WHERE is_verified IS TRUE";
            $resultListing = mysqli_query($db, $query);
            $pquery = "SELECT * FROM ($subqueryProfile) AS b WHERE is_verified IS TRUE";
            $resultProfile = mysqli_query($db, $query);

            while( $record = mysqli_fetch_assoc( $resultProfile ) )
            {
                echo "<a href='verification-report-profile.php?id={$record['user_id']}'>
                <div class='request-card'>
                    <div class='verification-icon'>
                        <img src='images/dormie-verification-user-icon.png' alt='User icon' >
                    </div>
                    <div class='request-datetime'>
                        <p>". $record["date_created"] ."</p>
                    </div>
                    <div class='request-name'>
                        <p> ". $record["first_name"] . " " . $record["last_name"] ." </p>
                    </div>
                    <div class='request-details'>
                        <p>". $record["username"] ." | ₱". $record["budget"] ." | ". $record["target_movein"] ."</p>
                    </div>
                    <div class='request-status'>
                        <p><div class='dot'></div><em>Approved</em></p>
                    </div>
                </div>
                </a>";
            }

            while( $record = mysqli_fetch_assoc( $result ) )
            {
                echo "<a href='verification-report-listing.php?id={$record['listing_id']}'>
                <div class='request-card'>
                    <div class='verification-icon'>
                        <img src='images/dormie-verification-listing-icon.png' alt='listing icon' >
                    </div>
                    <div class='request-datetime'>
                        <p> ". $record["date_created"] ." </p>
                    </div>
                    <div class='request-name'>
                        <p> ". $record["listing_title"] ."</p>
                    </div>
                    <div class='request-details'>
                        <p> ". $record["listing_title"] ." | ₱". $record["rent_fee"] ." | ". $record["movein_start"] ."</p>
                    </div>
                    <div class='request-status'>
                        <p><div class='dot'></div><em>Approved</em></p>
                    </div>
                </div>
                </a>";
            }
        } else {
            $filterApproved = NULL;
        }

        if(isset($_POST['rejected'])) {
            $filterRejected = $_POST['pending'];
            $filterRejected = preg_replace("#[^0-9a-z]#i","",$filterRejected);
            $subqueryListing = $queryListing;
            $subqueryProfile = $queryProfile;

            while ($record = mysqli_fetch_assoc($resultRejectedListing)) {
                // idk what this is $subqueryListing = $subqueryListing . " AND listing_id != " . $record['listing_id'];
                $rejectedQuery = "SELECT * FROM ($subqueryListing) AS subquery WHERE listing_id NOT IN ('" . $record['listing_id'] . "')";
                $rejectedResult = mysqli_query($db, $rejectedQuery);

                while( $record = mysqli_fetch_assoc( $rejectedResult ) )
                {
                    echo "<a href='verification-report-listing.php?id={$record['listing_id']}'>
                    <div class='request-card'>
                        <div class='verification-icon'>
                            <img src='images/dormie-verification-listing-icon.png' alt='listing icon' >
                        </div>
                        <div class='request-datetime'>
                            <p> ". $record["date_created"] ." </p>
                        </div>
                        <div class='request-name'>
                            <p> ". $record["listing_title"] ."</p>
                        </div>
                        <div class='request-details'>
                            <p> ". $record["listing_title"] ." | ₱". $record["rent_fee"] ." | ". $record["movein_start"] ."</p>
                        </div>
                        <div class='request-status'>
                            <p><div class='dot'></div><em>Rejected</em></p>
                        </div>
                    </div>
                    </a>";
                }
            }

            while ($record = mysqli_fetch_assoc($resultRejectedProfile)) {
                // idk what this is $subqueryProfile = $subqueryProfile . " AND profile_id != " . $record['profile_id'];
                $rejectedQuery = "SELECT * FROM ($subqueryProfile) AS subquery WHERE listing_id NOT IN ('" . $record['profile_id'] . "')";
                $rejectedResult = mysqli_query($db, $rejectedQuery);

                while ($record = mysqli_fetch(assoc($rejectedResult))) {
                    echo "<a href='verification-report-profile.php?id={$record['user_id']}'>
                    <div class='request-card'>
                        <div class='verification-icon'>
                            <img src='images/dormie-verification-user-icon.png' alt='User icon' >
                        </div>
                        <div class='request-datetime'>
                            <p>". $record["date_created"] ."</p>
                        </div>
                        <div class='request-name'>
                            <p> ". $record["first_name"] . " " . $record["last_name"] ." </p>
                        </div>
                        <div class='request-details'>
                            <p>". $record["username"] ." | ₱". $record["budget"] ." | ". $record["target_movein"] ."</p>
                        </div>
                        <div class='request-status'>
                            <p><div class='dot'></div><em>Rejected</em></p>
                        </div>
                    </div>
                    </a>";
                }
            }
        } else {
            $filterRejected = NULL;
        }

        if(isset($_POST['type'])) {
            if($_POST['type'] == 'listing') {
                // echo
            }
            if($_POST['type'] == 'profile') {
                while( $record = mysqli_fetch_assoc( $resultProfile ) )
                {
                    echo "<a href='verification-report-profile.php?id={$record['user_id']}'>
                    <div class='request-card'>
                        <div class='verification-icon'>
                            <img src='images/dormie-verification-user-icon.png' alt='User icon' >
                        </div>
                        <div class='request-datetime'>
                            <p>". $record["date_created"] ."</p>
                        </div>
                        <div class='request-name'>
                            <p> ". $record["first_name"] . " " . $record["last_name"] ." </p>
                        </div>
                        <div class='request-details'>
                            <p>". $record["username"] ." | ₱". $record["budget"] ." | ". $record["target_movein"] ."</p>
                        </div>
                        <div class='request-status'>
                            <p><div class='dot'></div><em>Pending</em></p>
                        </div>
                    </div>
                    </a>";
                }
            }
        }
        */
    }

    function getAllRejected() {
        // $rejected = select listing_id from listing_verification_reports where status = 'rejected';
        // select listing from listing where listing_id is in $rejected; 
    }

    function getAllPendingProfiles($sortOrder = 'DESC') {
        global $db;
        $query = 'SELECT * FROM user u, profile p WHERE (u.user_id = p.user_id) ORDER BY p.date_created ' . $sortOrder;
        $result = mysqli_query($db, $query);

        while( $record = mysqli_fetch_assoc( $result ) )
        {
            if($record["is_verified"] == 0) {
                echo "<a href='verification-report-profile.php?id={$record['user_id']}'>
                <div class='request-card'>
                    <div class='verification-icon'>
                        <img src='images/dormie-verification-user-icon.png' alt='User icon' >
                    </div>
                    <div class='request-datetime'>
                        <p>". $record["date_created"] ."</p>
                    </div>
                    <div class='request-name'>
                        <p> ". $record["first_name"] . " " . $record["last_name"] ." </p>
                    </div>
                    <div class='request-details'>
                        <p>". $record["username"] ." | ₱". $record["budget"] ." | ". $record["target_movein"] ."</p>
                    </div>
                    <div class='request-status'>
                        <p><div class='dot'></div><em>Pending</em></p>
                    </div>
                </div>
                </a>";
            }
        }
    }

    function getAllPendingListings($sortOrder = 'DESC') {
        global $db;
        $query = 'SELECT * FROM user u, listing l WHERE (u.user_id = l.user_id) ORDER BY l.date_created ' . $sortOrder;
        $result = mysqli_query($db, $query);

        while( $record = mysqli_fetch_assoc( $result ) )
        {
            if($record["is_verified"] == 0) {
                echo "<a href='verification-report-listing.php?id={$record['listing_id']}'>
                <div class='request-card'>
                    <div class='verification-icon'>
                        <img src='images/dormie-verification-listing-icon.png' alt='listing icon' >
                    </div>
                    <div class='request-datetime'>
                        <p> ". $record["date_created"] ." </p>
                    </div>
                    <div class='request-name'>
                        <p> ". $record["listing_title"] ."</p>
                    </div>
                    <div class='request-details'>
                        <p> ". $record["listing_title"] ." | ₱". $record["rent_fee"] ." | ". $record["movein_start"] ."</p>
                    </div>
                    <div class='request-status'>
                        <p><div class='dot'></div><em>Pending</em></p>
                    </div>
                </div>
                </a>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Requests Overview | Dormie</title>
    
    <link rel="stylesheet" href="styles/verification-requests.css">
    
    <!-- Google Fonts stylesheets -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scripts for Navbar and Footer Import -->
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script>
    $(function(){
    $("#nav-placeholder").load("nav.html");
    $("#footer-placeholder").load("footer.html");
    });

    function changeIcon(x) {
        if (x.classList.contains("fa-sort-numeric-asc")) {
            // Ascending icon is currently displayed
            x.classList.remove("fa-sort-numeric-asc");
            x.classList.add("fa-sort-numeric-desc");
            // Send a request to the server indicating sorting by descending
            sendSortingRequest("desc");
        } else {
            // Descending icon is currently displayed
            x.classList.remove("fa-sort-numeric-desc");
            x.classList.add("fa-sort-numeric-asc");
            // Send a request to the server indicating sorting by ascending
            sendSortingRequest("asc");
        }
    }

    function sendSortingRequest(sortOrder) {
        // Perform an AJAX request or submit a form to send the sorting information to the server
        // You can include the sortOrder parameter in the request data
        $.ajax({
            url: 'verification-requests.php',
            type: 'POST',
            data: {
                sortOrder: sortOrder,
                functionName: 'setSort',
                setSortParameter: sortOrder
            },
            success: function(response) {
                // Handle the response from the server
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(error);
            }
        });
    }

    /* Old function
    function changeIcon(x) {
        x.classList.toggle("fa-sort-numeric-desc");
        $.ajax({
        url: 'verification-requests.php',
        type: 'POST',
        data: {
            functionName: 'setDesc',
            // Add any additional parameters if required
        },
        success: function(response) {
            // Handle the response from the PHP function
            console.log(response);
        },
        error: function(xhr, status, error) {
            // Handle errors
            console.error(error);
        }
        });
    }
    */

    </script>
</head>

<body>
    <div id="maingrid">
        <div id="header">
            <nav><?php include_once ("nav.php") ?></div></nav>
        </div>

        <div id="content">
            <div class="dormie-grid">
                <h1>Verification Requests</h1>
                <div class="filters">
                    <form method="post" id="filters">
                        <input type="checkbox" id="pending" name="pending" value="pending">
                        <label for="pending">Pending</label><br>
                        <input type="checkbox" id="verified" name="verified" value="verified">
                        <label for="verified">Verified</label><br>
                        <input type="checkbox" id="rejected" name="rejected" value="rejected">
                        <label for="rejected">Rejected</label><br>

                        <input type="radio" id="profile" name="type" value="profile">
                        <label for="user">Just Users</label><br>
                        <input type="radio" id="listing" name="type" value="listing">
                        <label for="listing">Just Listings</label><br>
                        <!--<i class="fa fa-sort-numeric-asc" id="sort" value="asc" name="asc"></i>
                        <i class="fa fa-sort-numeric-desc" id="sort" value="desc" name="desc"></i>
                        -->

                        <input type="submit" class="filter-btn" id="apply" name="apply" value ="Apply" onclick="submit();"></input>
                    </form>
                    <i onclick=changeIcon(this) class="fa fa-sort-numeric-asc" id="sort" value="desc" name="desc"></i>
                </div>

                <?php
                function setSort($sortOrder) {
                    if ($sortOrder == 'desc') {
                        getPendingListingReqsDesc();
                        getPendingProfileReqsDesc();
                    } else {
                        getPendingListingReqsAsc();
                        getPendingProfileReqsAsc();
                    }
                }

                if(array_key_exists('apply', $_POST)) {
                    filterRequests();
                } elseif (isset($_POST['functionName'])) {
                    echo "nagana ba";
                    $sortOrder = $_POST['sortOrderParameter'];
                    setSort($sortOrder);
                } else {
                    getPendingListingReqsAsc();
                    getPendingProfileReqsAsc();
                }
                
                ?>
            </div>
        </div>

        <div id="footer">
            <div id="footer-placeholder"></div>
        </div>
    </div>
    
</body>
</html>