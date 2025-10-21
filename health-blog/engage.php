<?php
require 'includes/db.php';

$post_id = (int)($_POST['post_id'] ?? $_GET['post_id']);
$action = $_REQUEST['action'] ?? '';
$user_ip = $_SERVER['REMOTE_ADDR'];

if ($_POST['action'] === 'like') {
    $check = mysqli_query($conn, "SELECT * FROM post_likes WHERE post_id = $post_id AND user_ip = '$user_ip'");
    if (mysqli_num_rows($check) == 0) {
        mysqli_query($conn, "INSERT INTO post_likes (post_id, user_ip) VALUES ($post_id, '$user_ip')");
    } else {
        mysqli_query($conn, "DELETE FROM post_likes WHERE post_id = $post_id AND user_ip = '$user_ip'");
    }
}
if ($_POST['action'] === 'new_comment') {
    $new_name = mysqli_real_escape_string($conn, $_POST['new_name']);
    $new_comment = mysqli_real_escape_string($conn, $_POST['new_comment']);
    mysqli_query($conn, "INSERT INTO post_comments (post_id, name, comment) VALUES ($post_id, '$new_name', '$new_comment')");
}

if ($action === 'comment') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $parent_id = isset($_POST['parent_id']) ? (int)$_POST['parent_id'] : 'NULL';
    mysqli_query($conn, "INSERT INTO post_comments (post_id, name, comment, parent_id) VALUES ($post_id, '$name', '$comment', $parent_id)");
}

if ($action === 'upvote') {
    $comment_id = (int)$_GET['comment_id'];
    mysqli_query($conn, "UPDATE post_comments SET upvotes = upvotes + 1 WHERE id = $comment_id");
}


header("Location: post.php?id=$post_id");
exit;

