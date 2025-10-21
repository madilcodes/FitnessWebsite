<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Fun & Gamification - Wheel of Health & Mood Suggestions</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Wheel Styling */
    .wheel-container {
      position: relative;
      width: 300px;
      height: 300px;
      margin: auto;
    }
    .wheel {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      border: 8px solid #198754;
      transition: transform 4s cubic-bezier(0.33, 1, 0.68, 1);
      background: conic-gradient(
        #f8d7da 0% 20%, 
        #d1e7dd 20% 40%, 
        #cff4fc 40% 60%, 
        #fff3cd 60% 80%, 
        #e2e3e5 80% 100%
      );
    }
    .pointer {
      position: absolute;
      top: -20px;
      left: 50%;
      transform: translateX(-50%);
      width: 0;
      height: 0;
      border-left: 20px solid transparent;
      border-right: 20px solid transparent;
      border-bottom: 30px solid #dc3545;
    }
  </style>
</head>
<body class="bg-light">
<div class="container py-5">
  <h1 class="text-center mb-4">🎮 Fun & Gamification</h1>
  <div class="row g-4">
    
    <!-- Wheel of Health -->
    <div class="col-12 col-lg-6">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <h4 class="mb-3">🎡 Wheel of Health</h4>
          <div class="wheel-container">
            <div class="pointer"></div>
            <div class="wheel" id="wheel"></div>
          </div>
          <button class="btn btn-success mt-3" id="spinBtn">Spin the Wheel</button>
          <div class="mt-3 alert alert-info d-none" id="wheelResult"></div>
        </div>
      </div>
    </div>

    <!-- Mood-based Suggestions -->
    <div class="col-12 col-lg-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="mb-3">😊 Mood-based Suggestions</h4>
          <select id="moodSelect" class="form-select mb-3">
            <option value="">-- Select Your Mood --</option>
            <option value="tired">😴 Tired</option>
            <option value="stressed">😡 Stressed</option>
            <option value="happy">😊 Happy</option>
            <option value="sad">😢 Sad</option>
            <option value="focused">🤓 Need Focus</option>
          </select>
          <button class="btn btn-primary w-100" id="moodBtn">Get Suggestions</button>
          <div class="mt-3" id="moodResult"></div>
        </div>
      </div>
      <div class="card shadow-sm">
        <div class="card-body">

 <h4 class="mb-3">AI Recipe Personalizer 🤖</h4>
<p class='text-danger'><b> This Feature in Under Development </b> </p>

</div>
      </div>
    </div>


    </div>
  </div>
</div>

<script>
// 🎡 Wheel of Health Tips
const tips = [
  "💧 Drink 8 glasses of water today!",
  "🥗 Add 2 servings of vegetables to your meals.",
  "🏃 Do a quick 15-minute walk.",
  "😴 Get at least 7 hours of sleep.",
  "🧘 Try 5 minutes of meditation.",
];
const wheel = document.getElementById('wheel');
const wheelResult = document.getElementById('wheelResult');
document.getElementById('spinBtn').addEventListener('click', () => {
  const randomIndex = Math.floor(Math.random() * tips.length);
  const spins = 3 + Math.random() * 2; // random spin count
  const angle = 360 * spins + (randomIndex * (360 / tips.length));
  wheel.style.transform = `rotate(${angle}deg)`;
  setTimeout(() => {
    wheelResult.textContent = tips[randomIndex];
    wheelResult.classList.remove('d-none');
  }, 4000);
});

// 😊 Mood-based Suggestions
const moodFoods = {
  tired: ["🍌 Banana (quick energy)", "🥜 Nuts (protein + energy)", "☕ Green tea (gentle caffeine)"],
  stressed: ["🍵 Herbal tea (calming)", "🥑 Avocado (healthy fats)", "🐟 Salmon (omega-3 for stress)"],
  happy: ["🍓 Strawberries (antioxidants)", "🍫 Dark Chocolate (endorphins)", "🥕 Crunchy carrots (fun & healthy)"],
  sad: ["🍊 Oranges (vitamin C)", "🥛 Warm milk (comfort)", "🍌 Banana (mood booster)"],
  focused: ["🥚 Eggs (choline for brain)", "🥦 Broccoli (brain fuel)", "🍵 Matcha (focus energy)"]
};
document.getElementById('moodBtn').addEventListener('click', () => {
  const mood = document.getElementById('moodSelect').value;
  const result = document.getElementById('moodResult');
  if (!mood) {
    result.innerHTML = `<div class="alert alert-warning">⚠️ Please select a mood.</div>`;
    return;
  }
  const foods = moodFoods[mood];
  result.innerHTML = `
    <div class="alert alert-success">
      <h6>Suggestions for your mood:</h6>
      <ul>${foods.map(f => `<li>${f}</li>`).join("")}</ul>
    </div>`;
});
</script>
</body>
</html>
<?php include 'includes/footer.php'; ?>
