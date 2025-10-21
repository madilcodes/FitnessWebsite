<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<div class="container mt-5">
    <?php
    if (isset($_GET['cat'])) {
        $category = mysqli_real_escape_string($conn, $_GET['cat']);
        echo "<h2 class='mb-4'>$category</h2>";
$current_time = date('Y-m-d H:i:s');
$query = "SELECT * FROM posts  WHERE category = '$category' AND (scheduled_at IS NULL OR scheduled_at <= '$current_time')";
$query .= " ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="row">';
            while ($row = mysqli_fetch_assoc($result)) {
$images = explode(',', $row['image']);
$first_image = trim($images[0]);
$like_count = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM post_likes WHERE post_id = {$row['id']}"));
$comment_count = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM post_comments WHERE comment!='' AND name!='' AND post_id = {$row['id']}"));

                ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="uploads/posts/<?php echo $first_image; ?>" class="card-img-top" alt="...">
<div class="card-body">
    <h5 class="card-title"><?php echo $row['title']; ?></h5>
    <p class="card-text"><?php echo substr($row['content'], 0, 100); ?>...</p>

    <div class="d-flex justify-content-between align-items-center">
        <a href="post.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Read More</a>
        <div>
            <small class='text-muted'>❤️ <?= $like_count ?></small>
            &nbsp;&nbsp;
            <small class='text-muted'>💬 <?= $comment_count ?></small>
        </div>
    </div>
</div>
                    </div>
                </div>
                <?php
            }
            echo '</div>';
        } else {
            echo "<p>No posts found in this category.</p>";
        }
    } else {
        echo "<p class='text-danger'>No category selected.</p>";
    }
    ?>
<button onclick="scrollToTop()" id="scrollTopBtn" title="Go to top"
    class="btn btn-primary position-fixed bottom-0 end-0 m-3 rounded-circle shadow"
    style="z-index: 1030; display: none; width: 45px; height: 45px;">
    ⬆️
</button>

</div>

<?php include 'includes/footer.php'; ?>
<script>
  // Show button after scrolling down 200px
  window.onscroll = function () {
    const btn = document.getElementById("scrollTopBtn");
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
      btn.style.display = "block";
    } else {
      btn.style.display = "none";
    }
  };

  // Scroll to top function
  function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
</script>

