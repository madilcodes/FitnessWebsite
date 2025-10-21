<?php
include 'includes/db.php';

if (!isset($_GET['id'])) {
    die("Meal not found");
}

$id = (int)$_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM meal_plans WHERE id = $id LIMIT 1");

if (mysqli_num_rows($result) == 0) {
    die("Meal not found");
}

$meal = mysqli_fetch_assoc($result);

// decode JSON details
$foods = json_decode($meal['details'], true);
if (!$foods) {
    $foods = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($meal['title']) ?> - Saved Meal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="container py-5">
  <h2><?= htmlspecialchars($meal['title']) ?></h2>
  <p><strong>Date:</strong> <?= $meal['datetime'] ?></p>

  <h4>Meal Breakdown</h4>
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>Food</th>
          <th>Grams</th>
          <th>Calories</th>
          <th>Protein (g)</th>
          <th>Carbs (g)</th>
          <th>Fat (g)</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $totalCal = $totalProtein = $totalCarbs = $totalFat = 0;
        foreach ($foods as $food) {
            $totalCal += (float)$food['cal'];
            $totalProtein += (float)$food['protein'];
            $totalCarbs += (float)$food['carbs'];
            $totalFat += (float)$food['fat'];
            ?>
            <tr>
              <td><?= htmlspecialchars($food['food']) ?></td>
              <td><?= $food['grams'] ?></td>
              <td><?= $food['cal'] ?></td>
              <td><?= $food['protein'] ?></td>
              <td><?= $food['carbs'] ?></td>
              <td><?= $food['fat'] ?></td>
            </tr>
        <?php } ?>
      </tbody>
      <tfoot class="table-secondary">
        <tr>
          <th>Total</th>
          <th>-</th>
          <th><?= $totalCal ?></th>
          <th><?= $totalProtein ?></th>
          <th><?= $totalCarbs ?></th>
          <th><?= $totalFat ?></th>
        </tr>
      </tfoot>
    </table>
  </div>

  <h4 class="mt-4">Macro Distribution</h4>
<div style="max-width: 300px; margin: auto;">
  <canvas id="macroChart" ></canvas>
</div>
  <a href="nutrition.php" class="btn btn-secondary mt-4">⬅ Back to Tools</a>

  <script>
    const ctx = document.getElementById('macroChart').getContext('2d');
    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Protein (g)', 'Carbs (g)', 'Fat (g)'],
        datasets: [{
          data: [<?= $totalProtein ?>, <?= $totalCarbs ?>, <?= $totalFat ?>],
          backgroundColor: ['#36A2EB', '#FFCE56', '#FF6384']
        }]
      }
    });
  </script>
</body>
</html>

