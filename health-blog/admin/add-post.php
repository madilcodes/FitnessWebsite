<?php
include '../includes/db.php';
include '../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $tags = mysqli_real_escape_string($conn, $_POST['tags']);
    $images = $_FILES['image'];
    $image_names = [];

    for ($i = 0; $i < count($images['name']); $i++) {
    $image_name = $images['name'][$i];
    $image_tmp = $images['tmp_name'][$i];
    $image_path = $upload_dir . basename($image_name);

    if (move_uploaded_file($image_tmp, '../' . $image_path)) {
        $image_names[] = $image_name;
    }
}

if (!empty($image_names)) {
	$all_images = implode(',', $image_names);
	$scheduled_at = !empty($_POST['scheduled_at']) ? "'{$_POST['scheduled_at']}'" : "NULL";

    $sql = "INSERT INTO posts (title, content, location, category, image,scheduled_at,tags) 
            VALUES ('$title', '$content', '$location', '$category', '$all_images','$scheduled_at','$tags')";

    if (mysqli_query($conn, $sql)) {
        $success = "Post added successfully!";
    } else {
        $error = "Error inserting post.";
    }
} else {
    $error = "Image upload failed.";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Post - <?php echo $site_name; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<style>
body{
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}

#emailInputContainer{
  border: solid 1px;
  background-color: #fff;
  border: 1px solid #ccc;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  display: inline-block;
  padding: 4px 6px;
  color: #555;
  vertical-align: middle;
  border-radius: 4px;
  line-height: 22px;
  cursor: text;
  width: 100%;
  height: 1.8em;
}

.tag{
  padding: 2px 5px;
  margin-right: 5px;
  background: #5bc0de;
  color: white;
  display: inline;
  padding: .2em .6em .3em;
  font-size: 75%;
  font-weight: 700;
  line-height: 1;
  color: #fff;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: .25em;
}

.tempinput{
  border: none;
  outline: none;
}

.tag > .remove{
  margin-left: 8px;
  cursor: pointer;
}

.tag > .remove::after{
  content: "x";
  padding: 0px 0px;
}

</style>
<script>
function otherSelect() {
            var other = document.getElementById("otherBox");
            if (document.forms[0].category.options[document.forms[0].category.selectedIndex].value == "Travel") {
                other.style.visibility = "visible";
            }
            else {
                other.style.visibility = "hidden";
            }
        }
</script>
</head>
<body>
<div class="container mt-5">
    <h2>Add New Blog Post</h2>

    <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" rows="6" class="form-control" required></textarea>
        </div>
<div class="mb-3">
    <label for="image" class="form-label">Post Images</label>
    <input type="file" name="image[]" id="image" class="form-control" multiple required>
</div>
<div class="mb-3">
    <label for="scheduled_at" class="form-label">Schedule Date & Time</label>
    <input type="datetime-local" name="scheduled_at" id="scheduled_at" class="form-control">
</div>
<div class="mb-3">
    <label for="tags" class="form-label">Related Tags</label>
  <div  id="emailInputContainer" tabindex="0"></div>
        <input type="hidden" name="tags" id="emailsInput" class="form-control" required>
</div>
<div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category" id="category"   onchange="otherSelect();"class="form-control" required>
                <option value="Health">Health</option>
                <option value="Travel">Travel</option>
                <option value="Recipes">Recipes</option>
            </select>
        </div>
<div class="mb-3" id="otherBox" style="visibility: hidden;">
            <label for="title" class="form-label">Location</label>
            <input type="text" name="location"  id="location" class="form-control" >
        </div>

        <button type="submit" class="btn btn-primary">Publish</button>
    </form>
</div>
<script>
    const emailInput = document.getElementById('emailInputContainer');
    const emails = [];

    function createTag(text) {
        const tag = document.createElement('span');
        tag.classList.add('tag');
        tag.innerText = text;

        const remove = document.createElement('span');
        remove.classList.add('remove');
        tag.append(remove);

        remove.addEventListener('click', (event) => {
            const index = emails.indexOf(text);
            if (index !== -1) {
                emails.splice(index, 1);
            }
            event.currentTarget.parentElement.remove();
            updateEmailsInput();
        });

        return tag;
    }

    function createNewInput() {
        const newInput = document.createElement('input');
        newInput.classList.add('tempinput');
        newInput.addEventListener('focusout', (event) => {
            const target = event.currentTarget;
            if (target.value.trim().length > 0) {
                const email = target.value.trim();
                emails.push(email);
                const tag = createTag(email);
                target.parentElement.append(tag);
                updateEmailsInput();
            }
            target.remove();
        });

        return newInput;
    }

    emailInput.addEventListener('click', (event) => {
        const target = event.currentTarget;
        const newInput = createNewInput();
        target.append(newInput);
        newInput.focus();
    });

    function updateEmailsInput() {
        const emailsInput = document.getElementById('emailsInput');
        emailsInput.value = emails.join(',');
    }
</script>

</body>
</html>
