// assets/js/nutrition.js

// Minimal in-browser DB (per 100g)
const FOOD_DB = [
  // category, name, calories, protein, carbs, fat (per 100g)
  { cat: "Fruit",      name: "Apple (raw)",            cal: 52,  p: 0.3,  c: 14,  f: 0.2 },
  { cat: "Fruit",      name: "Banana (raw)",           cal: 89,  p: 1.1,  c: 23,  f: 0.3 },
  { cat: "Fruit",      name: "Orange (raw)",           cal: 47,  p: 0.9,  c: 12,  f: 0.1 },
  { cat: "Fruit",      name: "Berries (mixed)",        cal: 57,  p: 0.8,  c: 14,  f: 0.3 },

  { cat: "Vegetable",  name: "Broccoli (raw)",         cal: 34,  p: 2.8,  c: 7,   f: 0.4 },
  { cat: "Vegetable",  name: "Spinach (raw)",          cal: 23,  p: 2.9,  c: 3.6, f: 0.4 },
  { cat: "Vegetable",  name: "Carrot (raw)",           cal: 41,  p: 0.9,  c: 10,  f: 0.2 },
  { cat: "Vegetable",  name: "Sweet Potato (boiled)",  cal: 86,  p: 1.6,  c: 20,  f: 0.1 },

  { cat: "Protein",    name: "Chicken Breast (cooked)",cal: 165, p: 31,   c: 0,   f: 3.6 },
  { cat: "Protein",    name: "Egg (boiled)",           cal: 155, p: 13,   c: 1.1, f: 11 },
  { cat: "Protein",    name: "Paneer (cottage cheese)",cal: 265, p: 18,   c: 3.4, f: 20.8 },
  { cat: "Protein",    name: "Tofu (firm)",            cal: 76,  p: 8,    c: 1.9, f: 4.8 },
  { cat: "Protein",    name: "Chickpeas (boiled)",     cal: 164, p: 9,    c: 27,  f: 2.6 },
  { cat: "Protein",    name: "Lentils (boiled)",       cal: 116, p: 9,    c: 20,  f: 0.4 },

  { cat: "Grain",      name: "Rice (cooked, white)",   cal: 130, p: 2.7,  c: 28,  f: 0.3 },
  { cat: "Grain",      name: "Rice (cooked, brown)",   cal: 123, p: 2.7,  c: 25.6,f: 1 },
  { cat: "Grain",      name: "Quinoa (cooked)",        cal: 120, p: 4.4,  c: 21,  f: 1.9 },
  { cat: "Grain",      name: "Oats (dry)",             cal: 389, p: 16.9, c: 66,  f: 6.9 },

  { cat: "Dairy",      name: "Milk (cow, 3.25%)",      cal: 61,  p: 3.2,  c: 4.8, f: 3.3 },
  { cat: "Dairy",      name: "Yogurt (plain)",         cal: 59,  p: 10,   c: 3.6, f: 0.4 },

  { cat: "Snack",      name: "Almonds (raw)",          cal: 579, p: 21,   c: 22,  f: 50 },
  { cat: "Snack",      name: "Peanuts (roasted)",      cal: 585, p: 24,   c: 21,  f: 49 },
  { cat: "Snack",      name: "Dark Chocolate (70%)",   cal: 600, p: 7.8,  c: 46,  f: 43 },

  { cat: "Indian",     name: "Idli (steamed)",         cal: 58,  p: 2,    c: 12,  f: 0.4 },
  { cat: "Indian",     name: "Dosa (plain)",           cal: 168, p: 4,    c: 30,  f: 3.7 },
  { cat: "Indian",     name: "Chapati (whole wheat)",  cal: 110, p: 3.1,  c: 20,  f: 1.7 },
  { cat: "Indian",     name: "Poha",                   cal: 130, p: 2.7,  c: 27,  f: 1.6 },
];

// DOM elements
const foodSelect   = document.getElementById('food-select');
const gramsInput   = document.getElementById('food-grams');
const addBtn       = document.getElementById('add-item');
const clearBtn     = document.getElementById('clear-meal');
const mealTableTBody = document.querySelector('#meal-table tbody');

const totals = {
  grams: document.getElementById('total-grams'),
  cal: document.getElementById('total-cal'),
  p: document.getElementById('total-protein'),
  c: document.getElementById('total-carbs'),
  f: document.getElementById('total-fat'),
};
const sums = {
  cal: document.getElementById('sum-cal'),
  p:   document.getElementById('sum-protein'),
  c:   document.getElementById('sum-carbs'),
  f:   document.getElementById('sum-fat'),
};

const suggestionsBox = document.getElementById('suggestions');
const suggestBtn     = document.getElementById('suggest-btn');

// Populate select (grouped by category)
(function populateSelect() {
  const groups = {};
  FOOD_DB.forEach(item => {
    if (!groups[item.cat]) groups[item.cat] = [];
    groups[item.cat].push(item);
  });

  Object.keys(groups).sort().forEach(cat => {
    const optgroup = document.createElement('optgroup');
    optgroup.label = cat;
    groups[cat].sort((a,b) => a.name.localeCompare(b.name)).forEach(item => {
      const opt = document.createElement('option');
      opt.value = item.name;
      opt.textContent = `${item.name} (${item.cal} cal/100g)`;
      optgroup.appendChild(opt);
    });
    foodSelect.appendChild(optgroup);
  });
})();

function findFoodByName(name) {
  return FOOD_DB.find(f => f.name === name);
}

function rowHTML(item, grams, cal, p, c, f) {
  return `
    <tr data-name="${item.name}" data-grams="${grams}">
      <td>${item.name}</td>
      <td class="text-end">${grams}</td>
      <td class="text-end">${cal.toFixed(0)}</td>
      <td class="text-end">${p.toFixed(1)}</td>
      <td class="text-end">${c.toFixed(1)}</td>
      <td class="text-end">${f.toFixed(1)}</td>
      <td class="text-end">
        <button class="btn btn-sm btn-outline-secondary me-1 edit-row fa fa-edit"></button>
        <button class="btn btn-sm btn-outline-danger delete-row fa fa-trash"></button>
      </td>
    </tr>
  `;
}

function recalcTotals() {
  let tGrams = 0, tCal = 0, tP = 0, tC = 0, tF = 0;
  mealTableTBody.querySelectorAll('tr').forEach(tr => {
    const tds = tr.querySelectorAll('td');
    const grams = parseFloat(tds[1].textContent) || 0;
    const cal   = parseFloat(tds[2].textContent) || 0;
    const p     = parseFloat(tds[3].textContent) || 0;
    const c     = parseFloat(tds[4].textContent) || 0;
    const f     = parseFloat(tds[5].textContent) || 0;

    tGrams += grams; tCal += cal; tP += p; tC += c; tF += f;
  });

  totals.grams.textContent   = tGrams.toFixed(0);
  totals.cal.textContent     = tCal.toFixed(0);
  totals.p.textContent       = tP.toFixed(1);
  totals.c.textContent       = tC.toFixed(1);
  totals.f.textContent       = tF.toFixed(1);

  sums.cal.textContent   = tCal.toFixed(0);
  sums.p.textContent     = `${tP.toFixed(1)} g`;
  sums.c.textContent     = `${tC.toFixed(1)} g`;
  sums.f.textContent     = `${tF.toFixed(1)} g`;
}

addBtn.addEventListener('click', () => {
  const selectedName = foodSelect.value;
  const grams = Math.max(1, parseFloat(gramsInput.value || '0'));
  const item = findFoodByName(selectedName);
  if (!item) return;

  const factor = grams / 100.0;
  const cal = item.cal * factor;
  const p   = item.p   * factor;
  const c   = item.c   * factor;
  const f   = item.f   * factor;

  mealTableTBody.insertAdjacentHTML('beforeend', rowHTML(item, grams, cal, p, c, f));
  recalcTotals();
});

// Edit / Delete row actions
mealTableTBody.addEventListener('click', (e) => {
  const tr = e.target.closest('tr');
  if (!tr) return;

  if (e.target.classList.contains('delete-row')) {
    tr.remove();
    recalcTotals();
  }

  if (e.target.classList.contains('edit-row')) {
    const currentGrams = parseFloat(tr.querySelectorAll('td')[1].textContent) || 100;
    const newGrams = parseFloat(prompt('Enter quantity in grams:', currentGrams)) || currentGrams;

    const name = tr.dataset.name;
    const item = findFoodByName(name);
    const factor = newGrams / 100.0;
    const cal = item.cal * factor;
    const p   = item.p   * factor;
    const c   = item.c   * factor;
    const f   = item.f   * factor;

    const tds = tr.querySelectorAll('td');
    tds[1].textContent = newGrams.toFixed(0);
    tds[2].textContent = cal.toFixed(0);
    tds[3].textContent = p.toFixed(1);
    tds[4].textContent = c.toFixed(1);
    tds[5].textContent = f.toFixed(1);

    recalcTotals();
  }
});

clearBtn.addEventListener('click', () => {
  mealTableTBody.innerHTML = '';
  recalcTotals();
  suggestionsBox.innerHTML = `<p class="text-muted mb-0">Meal cleared. Add foods to get suggestions.</p>`;
});

// Suggest healthier swaps
suggestBtn.addEventListener('click', () => {
  const currentFoods = Array.from(mealTableTBody.querySelectorAll('tr'))
    .map(tr => tr.dataset.name);

  if (currentFoods.length === 0) {
    suggestionsBox.innerHTML = `<p class="text-muted mb-0">Add foods first.</p>`;
    return;
  }

  // Build a set of categories involved in the meal
  const usedCats = new Set(
    currentFoods.map(n => FOOD_DB.find(f => f.name === n)?.cat).filter(Boolean)
  );

  // Score foods: prioritize lower calories and higher protein density
  const scored = FOOD_DB
    .filter(f => !currentFoods.includes(f.name)) // exclude already selected
    .filter(f => usedCats.has(f.cat))            // similar category first
    .map(f => {
      const proteinDensity = f.p / (f.cal || 1); // g protein per kcal
      const score = (proteinDensity * 2) - (f.cal / 1000); // heuristic
      return { ...f, score };
    })
    .sort((a,b) => b.score - a.score)
    .slice(0, 6);

  if (scored.length === 0) {
    suggestionsBox.innerHTML = `<p class="text-muted mb-0">No close-category swaps found. Try different items.</p>`;
    return;
  }

  const cards = scored.map(s => `
    <div class="col-12 col-md-6 col-xl-4">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h6 class="card-title mb-1">${s.name}</h6>
          <p class="mb-1"><small>${s.cat}</small></p>
          <ul class="list-unstyled small mb-2">
            <li>Calories: ${s.cal} /100g</li>
            <li>Protein: ${s.p} g</li>
            <li>Carbs: ${s.c} g</li>
            <li>Fat: ${s.f} g</li>
          </ul>
          <span class="badge bg-success">Healthier swap</span>
        </div>
      </div>
    </div>
  `).join('');

  suggestionsBox.innerHTML = `<div class="row g-3">${cards}</div>`;
});
document.getElementById("save-meal-form").addEventListener("submit", function(e) {
  e.preventDefault();

  const title = document.getElementById("meal-title").value;
  const datetime = document.getElementById("meal-datetime").value;

  // Collect meal details
  let mealData = [];
  mealTableTBody.querySelectorAll("tr").forEach(tr => {
    const tds = tr.querySelectorAll("td");
    mealData.push({
      food: tds[0].textContent,
      grams: tds[1].textContent,
      cal: tds[2].textContent,
      protein: tds[3].textContent,
      carbs: tds[4].textContent,
      fat: tds[5].textContent
    });
  });

  if (mealData.length === 0) {
    document.getElementById("save-status").textContent = "⚠️ Please add foods before saving.";
    return;
  }

  fetch("save_meal.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ title, datetime, details: mealData })
  })
  .then(res => res.json())
  .then(data => {
    document.getElementById("save-status").textContent = data.message;
  })
  .catch(err => {
    console.error(err);
    document.getElementById("save-status").textContent = "❌ Error saving meal.";
  });
});
function loadSavedMeals() {
  fetch("get_meals.php")
    .then(res => res.json())
    .then(data => {
      const list = document.getElementById("saved-meals-list");
      if (data.length === 0) {
        list.innerHTML = "<p class='text-muted'>No meals saved yet.</p>";
        return;
      }
      list.innerHTML = `
        <ul class="list-group list-group-flush">
          ${data.map(meal => `
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span>
                <strong>${meal.title}</strong><br>
                <small class="text-muted">${meal.datetime}</small>
              </span>
              <a href="meal_view.php?id=${meal.id}" class="btn btn-sm btn-outline-primary">View</a>
            </li>
          `).join("")}
        </ul>
      `;
    })
    .catch(err => console.error("Error loading meals:", err));
}

// Load meals on page load
document.addEventListener("DOMContentLoaded", loadSavedMeals);
document.getElementById("save-google").addEventListener("click", () => {
  const title = document.getElementById("meal-title").value || "My Meal Plan";
  const datetime = document.getElementById("meal-datetime").value;
  if (!datetime) {
    alert("⚠️ Please select a date & time first.");
    return;
  }

  const dt = new Date(datetime);
  const start = dt.toISOString().replace(/-|:|\.\d+/g, "");
  const end = new Date(dt.getTime() + 60*60*1000).toISOString().replace(/-|:|\.\d+/g, ""); // +1 hr

  let icsContent = `
BEGIN:VCALENDAR
VERSION:2.0
BEGIN:VEVENT
SUMMARY:${title}
DTSTART:${start}
DTEND:${end}
DESCRIPTION:Meal reminder from FitFoodJourney
END:VEVENT
END:VCALENDAR
  `.trim();

  const blob = new Blob([icsContent], { type: "text/calendar" });
  const url = URL.createObjectURL(blob);
  const a = document.createElement("a");
  a.href = url;
  a.download = "meal_plan.ics";
  a.click();
  URL.revokeObjectURL(url);
});

