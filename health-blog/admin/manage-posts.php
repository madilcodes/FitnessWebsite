<?php
include '../includes/db.php';
include '../includes/config.php';

// Delete post if requested
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM posts WHERE id = $delete_id");
    header("Location: manage-posts.php");
    exit;
}

// Get selected category from dropdown
$selected_category = isset($_GET['category']) ? $_GET['category'] : '';

// Fetch posts (filtered if category is selected)
if ($selected_category != '') {
    $stmt = $conn->prepare("SELECT * FROM posts WHERE category = ? ORDER BY created_at DESC");
    $stmt->bind_param("s", $selected_category);
    $stmt->execute();
    $posts = $stmt->get_result();
} else {
    $posts = mysqli_query($conn, "SELECT * FROM posts ORDER BY created_at DESC");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Posts - <?php echo $site_name; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/4.0.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Manage Posts</h2>

    <!-- Filter Form -->
    <form method="get" class="mb-3">
        <select name="category" onchange="this.form.submit()" class="form-select w-auto d-inline-block">
            <option value="">-- Select Category --</option>
            <option value="Health" <?php if($selected_category=="Health") echo "selected"; ?>>Health</option>
            <option value="Recipes" <?php if($selected_category=="Recipes") echo "selected"; ?>>Recipes</option>
            <option value="Travel" <?php if($selected_category=="Travel") echo "selected"; ?>>Travel</option>
        </select>
        <?php if($selected_category){ ?>
            <a href="manage-posts.php" class="btn btn-secondary btn-sm ms-2">Reset</a>
        <?php } ?>
    </form>

    <!-- Posts Table -->
    <table class="table table-bordered mt-4">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Created At</th>
                <th>Scheduled At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($posts) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($posts)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td><?php echo $row['scheduled_at']; ?></td>
                    <td>
                        <a href="edit-post.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning me-1 edit-row fa fa-edit"></a>
                        <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger fa fa-trash" onclick="return confirm('Are you sure?')"></a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr><td colspan="6" class="text-center">No posts found</td></tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>

