<?php
include 'includes/db.php';

// Fetch all quotes
$result = mysqli_query($conn, "SELECT quote FROM motivational_quotes ORDER BY RAND() LIMIT 5");

$quotes = [];
while ($row = mysqli_fetch_assoc($result)) {
    $quotes[] = $row['quote'];
}

// Return as JSON
echo json_encode($quotes);
