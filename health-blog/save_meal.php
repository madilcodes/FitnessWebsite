<?php
include 'includes/db.php';

$data = json_decode(file_get_contents("php://input"), true);

$title = mysqli_real_escape_string($conn, $data['title']);
$datetime = mysqli_real_escape_string($conn, $data['datetime']);
$details = mysqli_real_escape_string($conn, json_encode($data['details']));

$sql = "INSERT INTO meal_plans (title, datetime, details) VALUES ('$title', '$datetime', '$details')";
if (mysqli_query($conn, $sql)) {
    echo json_encode(["status" => "success", "message" => "✅ Meal saved successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "❌ Failed to save meal"]);
}
?>

