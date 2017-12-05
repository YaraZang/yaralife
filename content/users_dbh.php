<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "users";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
if (!$conn) {
    die('Could not connect: ' . mysqli_error());
}
