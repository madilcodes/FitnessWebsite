<?php
include 'db.php';

header('Content-Type: application/json');

$q = isset($_GET['q']) ? mysqli_real_escape_string($conn, $_GET['q']) : '';

$sql = "SELECT id, title FROM posts WHERE title LIKE '%$q%' OR tags LIKE '%$q%' OR content LIKE '%$q%' ORDER BY created_at DESC LIMIT 10";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(['error' => mysqli_error($conn)]);
    exit;
}

$posts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $posts[] = ['id' => $row['id'], 'title' => $row['title']];
}

echo json_encode($posts);
