<?php
session_start();
include 'includes/db.php';

// Mock user id (replace with session user later)
$user_id = 1;

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action === "add_question") {
    $q = mysqli_real_escape_string($conn, $_POST['question']);
    mysqli_query($conn, "INSERT INTO questions(user_id, question, created_at) VALUES($user_id, '$q', NOW())");
    exit;
}

if ($action === "add_answer") {
    $qid = (int) $_POST['qid'];
    $ans = mysqli_real_escape_string($conn, $_POST['answer']);
    mysqli_query($conn, "INSERT INTO answers(question_id, user_id, answer, created_at) VALUES($qid, $user_id, '$ans', NOW())");
    exit;
}

if ($action === "like_answer") {
    $aid = (int) $_POST['aid'];
    mysqli_query($conn, "UPDATE answers SET likes = likes + 1 WHERE id = $aid");
    exit;
}

if ($action === "best_answer") {
    $aid = (int) $_POST['aid'];
    $qid = (int) $_POST['qid'];
    mysqli_query($conn, "UPDATE answers SET is_best = 0 WHERE question_id = $qid");
    mysqli_query($conn, "UPDATE answers SET is_best = 1 WHERE id = $aid");
    exit;
}

if ($action === "fetch") {
    $questions = mysqli_query($conn, "SELECT * FROM questions ORDER BY created_at DESC");
    while ($q = mysqli_fetch_assoc($questions)) {
        echo "<div class='card mb-3 shadow-sm'>
                <div class='card-body'>
                  <h5><i class='fa fa-question-circle text-success'></i> " . htmlspecialchars($q['question']) . "</h5>
                  <small class='text-muted'>Asked on {$q['created_at']}</small>";

        // Answer form
        echo "<form class='answerForm mt-2' data-qid='{$q['id']}'>
                <textarea class='form-control mb-2' placeholder='Write your answer...' required></textarea>
                <button class='btn btn-primary btn-sm'>Post Answer</button>
              </form>";

        // Fetch answers
        $answers = mysqli_query($conn, "SELECT * FROM answers WHERE question_id={$q['id']} ORDER BY is_best DESC, likes DESC");
        while ($a = mysqli_fetch_assoc($answers)) {
            $badges = "";
            if ($a['is_expert']) $badges .= " <span class='badge bg-info'><i class='fa fa-check-circle'></i> Expert</span>";
            if ($a['is_best']) $badges .= " <span class='badge bg-success'><i class='fa fa-star'></i> Best Answer</span>";

            echo "<div class='border rounded p-2 mb-2 ".($a['is_best'] ? "bg-light border-success" : "")."'>
                    <p>{$a['answer']}</p>
                    <div class='d-flex justify-content-between'>
                      <small class='text-muted'>{$a['created_at']} $badges</small>
                      <div>
                        <button type='button' class='btn btn-outline-secondary btn-sm like-answer' data-id='{$a['id']}'>
                          <i class='fa fa-thumbs-up'></i> {$a['likes']}
                        </button>
                        <button type='button' class='btn btn-outline-success btn-sm best-answer' data-id='{$a['id']}' data-qid='{$q['id']}'>
                          <i class='fa fa-crown'></i>
                        </button>
                      </div>
                    </div>
                  </div>";
        }

        echo "</div></div>";
    }
}

