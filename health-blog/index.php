<!-- index.php -->
<?php 
include 'includes/header.php'; 
include 'includes/db.php'; 
?>
<head>
<style>
#motivation-text {
    font-family: 'Comic Sans MS', cursive, sans-serif; 
    font-size: 1.3rem; 
    font-weight: bold;
    color: #2c3e50;
    transition: opacity 1s ease-in-out;
}
</style>
</head>
<body>
<div class="container mt-5">
<h1 class="text-center mb-4">Welcome -Eat Better, Move More, Live Happier! 🌍❤️</h1>
<div class="card shadow p-3 mb-4 bg-light" id="motivation-box">
  <h5 class="card-title text-primary">🌟 Daily Motivation</h5>
  <p class="card-text" id="motivation-text">Loading motivation...</p>
</div>

    <div class="row">
        <?php
	$current_time = date('Y-m-d H:i:s');
	$result = mysqli_query($conn, "SELECT * FROM posts WHERE (scheduled_at IS NULL OR scheduled_at <= '$current_time') ORDER BY created_at DESC LIMIT 6");
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
        <?php } ?>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const motivationBox = document.getElementById("motivation-text");
  let quotes = [];
  let index = 0;

  // Fetch quotes from PHP
  fetch("get_quotes.php")
    .then(res => res.json())
    .then(data => {
      if (data.length > 0) {
        quotes = data;
        showQuote();
        setInterval(showQuote, 10000); // change every 10 sec
      } else {
        motivationBox.textContent = "Stay strong, stay positive! 🌟";
      }
    });

  function showQuote() {
    motivationBox.style.opacity = 0;
    setTimeout(() => {
      motivationBox.textContent = quotes[index];
      motivationBox.style.opacity = 1;
      index = (index + 1) % quotes.length;
    }, 500);
  }
});
</script>
</body>
<?php include 'includes/footer.php'; ?>

