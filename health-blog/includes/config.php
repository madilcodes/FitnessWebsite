<?php
// config.php - Global Configuration File

// Site Settings
$site_name = "FitFoodJourney";
$site_url  = "http://localhost/fitfoodjourney"; // Change this to your actual domain when live

// Timezone
date_default_timezone_set("Asia/Kolkata");

// Error Reporting (Turn off in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Other constants
$upload_dir = "uploads/posts/";
?>

