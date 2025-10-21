<?php
include 'includes/db.php';

$result = mysqli_query($conn, "SELECT id, title, datetime FROM meal_plans ORDER BY created_at DESC LIMIT 5");
$meals = [];
while ($row = mysqli_fetch_assoc($result)) {
    $meals[] = $row;
}
echo json_encode($meals);
?>

