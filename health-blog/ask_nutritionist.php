<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ask a Nutritionist 🥼 | FitFoodJourney</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body class="bg-light">
<div class="container py-4">
  <h1 class="text-center mb-4">🥦 Ask a Nutritionist</h1>

  <!-- Ask a Question -->
  <div class="card mb-4 shadow-sm">
    <div class="card-body">
      <h5 class="card-title">Have a question?</h5>
      <form id="questionForm">
        <textarea name="question" id="question" class="form-control mb-2" placeholder="Type your nutrition or fitness question..." required></textarea>
        <button class="btn btn-success" type="submit">Ask Question</button>
      </form>
    </div>
  </div>

  <!-- Questions + Answers -->
  <div id="qa-container"></div>
</div>

<script>
function loadQA() {
  $.get("qa_actions.php", { action: "fetch" }, function(data) {
    $("#qa-container").html(data);
  });
}

$(document).ready(function(){
  loadQA();

  // Add question
  $("#questionForm").on("submit", function(e){
    e.preventDefault();
    $.post("qa_actions.php", { action: "add_question", question: $("#question").val() }, function(){
      $("#question").val("");
      loadQA();
    });
  });

  // Delegate for dynamic buttons
  $(document).on("submit", ".answerForm", function(e){
    e.preventDefault();
    const qid = $(this).data("qid");
    const ans = $(this).find("textarea").val();
    $.post("qa_actions.php", { action: "add_answer", qid: qid, answer: ans }, function(){
      loadQA();
    });
  });

  $(document).on("click", ".like-answer", function(){
    const aid = $(this).data("id");
    $.post("qa_actions.php", { action: "like_answer", aid: aid }, function(){
      loadQA();
    });
  });

  $(document).on("click", ".best-answer", function(){
    const aid = $(this).data("id");
    const qid = $(this).data("qid");
    $.post("qa_actions.php", { action: "best_answer", aid: aid, qid: qid }, function(){
      loadQA();
    });
  });
});
</script>
</body>
</html>
<?php include 'includes/footer.php'; ?>
