<?php
include_once 'config.php';

$servername = "localhost";
$username = "root";
$password = "convox32";
$dbname = "fitfoodjourney";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

