<?php
session_start();
include '../includes/db.php';
include '../includes/config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);

 $sql = "INSERT INTO motivational_quotes (quote) VALUES ('$username')";

    if (mysqli_query($conn, $sql)) {
        $success = "Qoute added successfully!";
    } else {
        $error = "Error inserting Qoute.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - <?php echo $site_name; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width: 400px;">
    <h2 class="mb-4 text-center">Add Motivational Qoutes</h2>
    <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Write Qoutes here </label>
<textarea name="username" id="username" class="form-control" rows="4" required></textarea>
        
</div>
                <button type="submit" class="btn btn-primary w-100">Add Qoute</button>
    </form>
</div>
<div class="container mt-5">
    <h2>List of Motivational Quotes</h2>
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>sno</th>
                <th>Qoute</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
$qoutes="select * from motivational_quotes order by sno";
$result=mysqli_query($conn,$qoutes);
 while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['sno']; ?></td>
                    <td><?php echo htmlspecialchars($row['quote']); ?></td>
                    <td><?php echo htmlspecialchars($row['entry_date']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>

