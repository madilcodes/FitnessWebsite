<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<div class="container mt-5">
<?php
 if (isset($_GET['id'])) {
        $post_id = intval($_GET['id']);
        $query = "SELECT * FROM posts WHERE id = $post_id";
        $result = mysqli_query($conn, $query);
	if ($row = mysqli_fetch_assoc($result)) {
	?>
	<h1 class="mb-3"><?php echo $row['title']; ?></h1>
	<div class="d-flex overflow-auto">
	<?php
	$images = explode(',', $row['image']);
	foreach ($images as $img) {
	$img = trim($img);
	if ($img) {
        echo '<img src="uploads/posts/' . $img . '" class="img-fluid mb-2 me-2" style="max-width: 200px;" alt="Post Image">';
    }
}
?>
</div>

<p class="text-muted">Published on <?php echo date('F d, Y', strtotime($row['created_at'])); ?></p>

<div class="content">
    <?php echo nl2br($row['content']); ?>

    <?php
    if ($row['category'] == 'Travel' && !empty($row['location'])) {
        echo "<p class='text-bold'>Location 📍: <a href='" . $row['location'] . "' target='_blank'>" . $row['location'] . "</a></p>";
    }
    ?>

    <br>
<?php
$liked = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM post_likes WHERE post_id = {$row['id']} AND user_ip = '{$_SERVER['REMOTE_ADDR']}'"));
$like_count = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM post_likes WHERE post_id = {$row['id']}"));
$comment_count = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM post_comments WHERE comment!='' AND name!='' AND post_id = {$row['id']}"));
$comments = mysqli_query($conn, "SELECT * FROM post_comments WHERE comment!='' AND name!='' AND post_id = {$row['id']} AND parent_id IS NULL ORDER BY created_at DESC");

?>
    <br>
    <form method="post" action="engage.php" onsubmit="return handleSubmit(this)">
    <input type="hidden" name="post_id" value="<?= $row['id'] ?>">

    <!-- Like Button -->
    <button title='Like' type="submit" name="action" value="like" class="btn btn-outline-<?= $liked ? 'danger' : 'secondary' ?>">
        ❤️ <?= $liked ? '' : '' ?>
    </button>

    <!-- Comment Toggle Button -->
    <button title='Comment' type="button" class="btn btn-outline-primary" onclick="toggleCommentBox()">💬 </button>

    <!-- Share Toggle Button -->
    <button title='Share' type="button" class="btn btn-outline-success" onclick="toggleShare()">↗️</button>

    <!-- Like Count -->
    <br><small class='text-muted'>❤️ <?= $like_count ?></small>

    &nbsp;&nbsp;<small class='text-muted'>💬 <?= $comment_count ?></small>
    <!-- Dropdown Comment Box (Initially hidden) -->
    <div id="commentBox" style="display:none;" class="mt-3">
    <!-- Existing Comments -->
 <input type="text" name="new_name" id="comment-name" placeholder="Your Name"  class="form-control mb-2">
        <textarea name="new_comment" id="comment-text"  placeholder="Your comment..." class="form-control mb-2" ></textarea>
        <button type="submit" title="Post Comment" name="action" value="new_comment" class="btn btn-primary">⬆️ </button>
    <?php while ($c = mysqli_fetch_assoc($comments)): ?>
    <div class='border p-2 mb-2 bg-primary text-light'>
        <strong><?= strtoupper(htmlspecialchars($c['name'])) ?></strong><br>
        <?= nl2br(htmlspecialchars($c['comment'])) ?><br>
        <small class='text-muted-light'><?= $c['created_at'] ?></small> | 
        <!-- Upvote button -->
        <a href="engage.php?action=upvote&comment_id=<?= $c['id'] ?>&post_id=<?= $row['id'] ?>" class="text-light">👍 <?= $c['upvotes'] ?></a> | 
        <!-- Reply button (shows reply form) -->
        <a href="#" onclick="document.getElementById('reply-form-<?= $c['id'] ?>').style.display='block'; return false;">💬 Reply</a>

        <!-- Reply form -->
        <div id="reply-form-<?= $c['id'] ?>" style="display:none;" class="mt-2">
            <form action="engage.php" method="POST">
                <input type="hidden" name="post_id" value="<?= $row['id'] ?>">
                <input type="hidden" name="parent_id" value="<?= $c['id'] ?>">
                <input type="text" name="name" placeholder="Your Name" class="form-control mb-1">
                <textarea name="comment" placeholder="Your Reply" class="form-control mb-1"></textarea>
                <button type="submit" name="action" value="comment" class="btn btn-sm btn-light">Reply</button>
            </form>
        </div>

        <!-- Fetch and show replies -->
        <?php
        $replies = mysqli_query($conn, "SELECT * FROM post_comments WHERE parent_id = {$c['id']} ORDER BY created_at ASC");
        while ($r = mysqli_fetch_assoc($replies)): ?>
            <div class='border p-2 mt-2 ml-4 bg-light text-dark'>
                <strong><?= strtoupper(htmlspecialchars($r['name'])) ?></strong><br>
                <?= nl2br(htmlspecialchars($r['comment'])) ?><br>
                <small class='text-muted'><?= $r['created_at'] ?></small> |
                <a href="engage.php?action=upvote&comment_id=<?= $r['id'] ?>&post_id=<?= $row['id'] ?>" class="text-light">👍 <?= $r['upvotes'] ?></a>
            </div>
        <?php endwhile; ?>
    </div>
<?php endwhile; ?>

</div>
    <!-- Dropdown Share Box -->
    <div id="shareBox" style="display:none;" class="mt-3">
 <a style='margin-right: 0.5cm;' href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode("https://yourdomain.com/post.php?id={$row['id']}") ?>" 
     target="_blank" class="btn btn-outline-primary btn-sm rounded-circle shadow-sm" title="Share on Facebook">
    <i class="fab fa-facebook-f"></i>
  </a>
  
  <a style='margin-right: 0.5cm;' href="https://twitter.com/intent/tweet?url=<?= urlencode("https://yourdomain.com/post.php?id={$row['id']}") ?>" 
     target="_blank" class="btn btn-outline-info btn-sm rounded-circle shadow-sm" title="Share on Twitter">
    <i class="fab fa-twitter"></i>
  </a>
  
  <a style='margin-right: 0.5cm;' href="https://api.whatsapp.com/send?text=<?= urlencode("Check this out: https://yourdomain.com/post.php?id={$row['id']}") ?>" 
     target="_blank" class="btn btn-outline-success btn-sm rounded-circle shadow-sm" title="Share on WhatsApp">
    <i class="fab fa-whatsapp"></i>
  </a>
  
  <a style='margin-right: 0.5cm;' href="https://www.instagram.com/" target="_blank" 
     class="btn btn-outline-danger btn-sm rounded-circle shadow-sm" title="Instagram (manual)">
    <i class="fab fa-instagram"></i>
  </a>    
</div>
</form>

</div>
 <?php } else { ?>
 <p class="text-danger">Post not found.</p>
  <?php }
  } else {
  echo "<p class='text-danger'>Invalid post ID.</p>";
   }
   ?>
<script>
function toggleCommentBox() {
    const box = document.getElementById('commentBox');
    box.style.display = box.style.display === 'none' ? 'block' : 'none';
}

function toggleShare() {
    const box = document.getElementById('shareBox');
    box.style.display = box.style.display === 'none' ? 'block' : 'none';
}
</script>
<!-- Related Posts Section -->
<hr>
<div class="mt-4">
    <h4>🔗 Related Posts</h4>
    <div class="row">
        <?php
        // Fetch related posts by category excluding current post
        $category = $row['category'];
        $related_query = "SELECT * FROM posts WHERE category = '$category' AND id != $post_id ORDER BY created_at DESC ";
        $related_result = mysqli_query($conn, $related_query);

        while ($related = mysqli_fetch_assoc($related_result)) {
            // Get first image from comma-separated string
            $related_images = explode(',', $related['image']);
            $first_image = trim($related_images[0]);
$like_count = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM post_likes WHERE post_id = {$related['id']}"));
$comment_count = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM post_comments WHERE comment!='' AND name!='' AND post_id = {$related['id']}"));

            ?>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="uploads/posts/<?php echo $first_image; ?>" class="card-img-top" alt="Related Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $related['title']; ?></h5>
                        <p class="card-text"><?php echo substr($related['content'], 0, 80); ?>...</p>
<div class="d-flex justify-content-between align-items-center">
                        <a href="post.php?id=<?php echo $related['id']; ?>" class="btn btn-sm btn-primary">Read More</a>
<div>
<small class='text-muted'>❤️ <?= $like_count ?></small>&nbsp;&nbsp;<small class='text-muted'>💬 <?= $comment_count ?></small>
</div>
</div>
 </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

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

