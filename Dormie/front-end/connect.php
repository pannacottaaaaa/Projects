<?php
function connect($dbHost, $dbName, $dbUsername, $dbPassword, $dbPort) {
    $db = new mysqli(
        $dbHost,
        $dbUsername,
        $dbPassword,
        $dbName,
        $dbPort
    );
    if($db->connect_error){
        die("Cannot connect to database: \n"
            . $db->connect_error . "\n"
            . $db->connect_errno
        );
    }
    return $db;
}
?>