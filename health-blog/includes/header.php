<?php
include 'db.php';
$tagsResult = mysqli_query($conn, "SELECT tags FROM posts WHERE tags != ''");

$allTags = [];
while ($row = mysqli_fetch_assoc($tagsResult)) {
    $rowTags = explode(',', $row['tags']);
    foreach ($rowTags as $tag) {
        $tag = trim($tag);
        if ($tag !== "" && !in_array($tag, $allTags)) {
            $allTags[] = $tag; 
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FitFoodJourney - Health & Wellness Blog</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">
    <link rel="stylesheet" href="assets/plugins/bootstrap/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
.moving-brand {
  display: inline-block;
  position: relative;
  animation: moveText 6s linear infinite alternate;
  font-weight: bold;
  font-size: 1.4rem;
  white-space: nowrap;
}

@keyframes moveText {
  0%   { transform: translateX(0); }
  100% { transform: translateX(120px); } /* adjust distance */
}

</style>
</head>
    <body>
<audio id="bgMusic" loop>
  <!--  <source src="../health-blog/assets/audios/the-cutest-bunny.mp3" type="audio/mpeg">-->
</audio>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
    <button id="toggle-dark" title="Dark Mode" class="btn btn-sm btn-dark ms-2">🌙</button>
        <a class="navbar-brand moving-brand" href="index.php">FitFoodJourney</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <form class="d-flex ms-3 position-relative" role="search" id="search-form">
            <input class="form-control me-2" type="search"  id="search-input" autocomplete="off">
            <div id="search-results" class="list-group position-absolute w-100 shadow z-3"
     style="margin-top: 3.2rem; max-height: 400px; overflow-y: auto; display: none;"></div>

<button type="button" 
              id="voice-btn" 
              class="btn btn-dark me-2" 
              title="Voice Search">
        🎤
      </button>
        </form>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto" style='flex-wrap: nowrap; white-space: nowrap;'>
                <!--<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>-->
                <li class="nav-item"><a class="nav-link" href="category.php?cat=Health">Health 🏋️</a></li>
                <li class="nav-item"><a class="nav-link" href="category.php?cat=Recipes">Recipes 🥗</a></li>
                <li class="nav-item"><a class="nav-link" href="category.php?cat=Travel">Travel✈️</a></li>
                <li class="nav-item"><a class="nav-link" title="Nutrition ,Fitness & Calorie Calculator" href="nutrition.php">Tools🎮</a></li>
                <li class="nav-item"><a class="nav-link" title="New Foods with AI & Fun games" href="fun_tools.php">AI & Games🤖</a></li>
                <li class="nav-item"><a class="nav-link" title="Q & A Community" href="ask_nutritionist.php">Community🥼</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About-Us📞</a></li>
                <!--<li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>-->
            </ul>
        </div>
    </div>
</nav>
<script src="/assets/js/main.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input');
    const resultsBox = document.getElementById('search-results');
    const body = document.body;
    const toggle = document.getElementById('toggle-dark');

    searchInput.addEventListener('input', function () {
        const query = this.value.trim();

        if (query.length < 2) {
            resultsBox.style.display = 'none';
            resultsBox.innerHTML = '';
            return;
        }

        fetch(`includes/live-search.php?q=` + encodeURIComponent(query))
            .then(res => res.json())
            .then(data => {
                if (data.length > 0) {
                    resultsBox.innerHTML = data.map(post =>
                        `<a href="post.php?id=${post.id}" class="list-group-item list-group-item-action">${post.title}</a>`
                    ).join('');
                    resultsBox.style.display = 'block';
                }else {
                   resultsBox.innerHTML = `<div class="list-group-item">No results found </div>`;
                    resultsBox.style.display = 'block';
               }
            });
    });

    document.addEventListener('click', function (e) {
        if (!searchInput.contains(e.target) && !resultsBox.contains(e.target)) {
            resultsBox.style.display = 'none';
        }
    });

    if (localStorage.getItem('dark-mode') === 'enabled') {
        body.classList.add('dark-mode');
    }

    toggle?.addEventListener('click', function () {
        body.classList.toggle('dark-mode');
        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('dark-mode', 'enabled');
        } else {
            localStorage.setItem('dark-mode', 'disabled');
        }
    });
 const music = document.getElementById("bgMusic");
    music.volume = 0.5; // Set volume to 50%

    music.play().catch(() => {
        // If autoplay blocked, play after first click
        document.body.addEventListener("click", () => {
            music.play();
        }, { once: true });
    });

});

const suggestions = <?php echo json_encode(array_values($allTags)); ?>;
let index = 0;

function changePlaceholder() {
    const searchInput = document.getElementById("search-input");
    if (suggestions.length > 0) {
        searchInput.placeholder = `🔎  ${suggestions[index]}`;
        index = (index + 1) % suggestions.length;
    }
}
setInterval(changePlaceholder, 2000);
changePlaceholder();

const voiceBtn = document.getElementById("voice-btn");
const searchInput = document.getElementById("search-input");

if ('webkitSpeechRecognition' in window) {
  const recognition = new webkitSpeechRecognition();
  recognition.lang = "en-US";
  recognition.interimResults = false;
  recognition.continuous = false;

  voiceBtn.addEventListener("click", () => {
    recognition.start();
    voiceBtn.innerHTML = "🎙️ Listening...";
  });

  recognition.onresult = (event) => {
    const transcript = event.results[0][0].transcript;
    searchInput.value = transcript;
    voiceBtn.innerHTML = "🎤"; // reset icon
    // 🔥 trigger input event to auto-run live search
    searchInput.dispatchEvent(new Event("input"));
  };

  recognition.onerror = (event) => {
    console.error("Voice search error:", event.error);
    voiceBtn.innerHTML = "🎤";
  };

  recognition.onend = () => {
    voiceBtn.innerHTML = "🎤";
  };
} else {
  voiceBtn.style.display = "none"; // hide mic if not supported
}

</script>

</body>
