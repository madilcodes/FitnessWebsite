<?php
// admin/index.php
include '../includes/db.php';
include '../includes/config.php';
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// You can later secure this with login authentication
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - <?php echo $site_name; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome to Admin Dashboard</h2>
        <ul class="list-group mt-4">
            <li class="list-group-item"><a href="add-post.php">Add New Post</a></li>
            <li class="list-group-item"><a href="manage-posts.php">Manage Posts</a></li>
            <li class="list-group-item"><a href="motivation-qoutes.php">Add Motivational Qoutes</a></li>
            <li class="list-group-item"><a href="view-messages.php">View Contact Messages</a></li>
        </ul>
    </div>
</body>
</html>

