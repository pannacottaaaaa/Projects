<?php

if (empty($_POST["password"])) {
    die("Password is required");
}

if (! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

$mysqli = require __DIR__ . "/index-db.php";