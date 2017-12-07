<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "4664";
$dbName = "marketplace";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
if (!$conn) {
    die('Could not connect: ' . mysqli_error());
}
