<?php
// nutrition.php
include 'includes/header.php';
?>
<div class="container py-5">
  <div class="row">
    <div class="col-12 col-lg-8">
      <h1 class="mb-3">Calorie & Nutrition Calculator</h1>
      <p class="text-muted">Add foods to your meal and see total calories & macros. We’ll also suggest healthier swaps.</p>

      <!-- Add Item Card -->
      <div class="card mb-4">
        <div class="card-body">
          <div class="row g-2 align-items-end">
            <div class="col-12 col-md-6">
              <label class="form-label">Food</label>
              <select id="food-select" class="form-select" aria-label="Select food"></select>
              <small class="text-muted">Per 100g values used for calculations.</small>
            </div>
            <div class="col-6 col-md-3">
              <label class="form-label">Quantity (g)</label>
              <input id="food-grams" type="number" class="form-control" min="1" step="1" value="100">
            </div>
            <div class="col-6 col-md-3 d-grid">
              <button id="add-item" class="btn btn-primary">Add to Meal</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Meal Table -->
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="fw-semibold">Your Meal</span>
          <button id="clear-meal" class="btn btn-sm btn-outline-danger">Clear</button>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped mb-0" id="meal-table">
              <thead class="table-light">
                <tr>
                  <th>Food</th>
                  <th class="text-end">Qty (g)</th>
                  <th class="text-end">Cal</th>
                  <th class="text-end">Protein (g)</th>
                  <th class="text-end">Carbs (g)</th>
                  <th class="text-end">Fat (g)</th>
                  <th class="text-end">Action</th>
                </tr>
              </thead>
              <tbody></tbody>
              <tfoot class="table-light">
                <tr>
                  <th>Total</th>
                  <th class="text-end" id="total-grams">0</th>
                  <th class="text-end" id="total-cal">0</th>
                  <th class="text-end" id="total-protein">0</th>
                  <th class="text-end" id="total-carbs">0</th>
                  <th class="text-end" id="total-fat">0</th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>

      <!-- Macros Summary -->
      <div class="card mb-4">
        <div class="card-body">
          <div class="row text-center">
            <div class="col-6 col-md-3 mb-3 mb-md-0">
              <div class="fw-semibold">Calories</div>
              <div id="sum-cal" class="fs-4">0</div>
            </div>
            <div class="col-6 col-md-3 mb-3 mb-md-0">
              <div class="fw-semibold">Protein</div>
              <div id="sum-protein" class="fs-4">0 g</div>
            </div>
            <div class="col-6 col-md-3">
              <div class="fw-semibold">Carbs</div>
              <div id="sum-carbs" class="fs-4">0 g</div>
            </div>
            <div class="col-6 col-md-3">
              <div class="fw-semibold">Fat</div>
              <div id="sum-fat" class="fs-4">0 g</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Healthy Alternatives -->
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span class="fw-semibold">Healthier Alternatives</span>
          <button id="suggest-btn" class="btn btn-sm btn-outline-success">Suggest Swaps</button>
        </div>
        <div class="card-body" id="suggestions">
          <p class="text-muted mb-0">Add some foods first, then click “Suggest Swaps”. We’ll recommend similar options with fewer calories or better protein per calorie.</p>
        </div>
      </div>
    </div>

    <!-- Right Column: Tips -->
   <div class="col-12 col-lg-4 mt-4 mt-lg-0">
  <!-- Tips Card -->
  <div class="card mb-4">
    <div class="card-body">
      <h5 class="mb-3">Tips</h5>
      <ul class="small mb-0">
        <li>Values are per 100g; adjust quantity to match your portion.</li>
        <li>Swaps prioritize lower calories or higher protein density.</li>
        <li>Consult a professional for personalized nutrition advice.</li>
      </ul>
    </div>
  </div>

  <!-- Saved Meals Card -->
  <div class="card">
    <div class="card-body">
      <h5 class="mb-3">📂 Saved Meals</h5>
      <div id="saved-meals-list" class="small">
        <p class="text-muted">No meals saved yet.</p>
      </div>
    </div>
  </div>
</div>
 
<!-- Save Meal Plan -->
<div class="col-12 col-lg-8">
 <div class="card-body">
          <div class="row g-2 align-items-end">    
<span class="fw-semibold">Save Meal Plan</span>
  </div>
  <div class="card-body">
    <form id="save-meal-form">
      <div class="mb-3">
        <label class="form-label">Meal Title</label>
        <input type="text" id="meal-title" class="form-control" placeholder="E.g., Healthy Lunch Plan" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Date & Time</label>
        <input type="datetime-local" id="meal-datetime" class="form-control" required>
      </div>
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-success">💾 Save Locally</button>
        <button type="button" id="save-google" class="btn btn-primary">📅 Save to Google Calendar</button>
      </div>
    </form>
    <div id="save-status" class="mt-3 text-muted small"></div>
  </div>
</div>
</div>

  </div>
</div>
<?php include 'includes/footer.php'; ?>

<!-- Page Script -->
<script src="assets/js/nutrition.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

