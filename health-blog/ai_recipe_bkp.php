<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ingredients = trim($_POST['ingredients']);
    $allergies = trim($_POST['allergies']);
    $goal = trim($_POST['goal']);

    $prompt = "You are a professional chef and nutritionist.
    The user has: $ingredients.
    Avoid: $allergies.
    Goal: $goal.
    Suggest 3 recipes with:
    - Name
    - Ingredients list with quantities
    - Step-by-step cooking instructions
    - Approximate nutritional breakdown.";

    $apiKey = "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"; // free key from openrouter.ai

    $data = [
        "model" => "mistralai/mistral-7b-instruct", // free model
        "messages" => [
            ["role" => "system", "content" => "You are an expert recipe creator."],
            ["role" => "user", "content" => $prompt]
        ]
    ];

$ch   = curl_init("https://openrouter.ai/api/v1/chat/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // temporarily disable SSL check
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $apiKey"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "<pre>cURL Error: " . curl_error($ch) . "</pre>";
}

curl_close($ch);

// Show the full API raw output
echo "<pre>RAW RESPONSE:\n" . htmlspecialchars($response) . "</pre>";

$result = json_decode($response, true);

if (isset($result['error'])) {
    echo "<pre>API Error:\n" . htmlspecialchars(json_encode($result['error'], JSON_PRETTY_PRINT)) . "</pre>";
}

$output = $result['choices'][0]['message']['content'] ?? "No response from AI.";
 

    echo "<h4>Personalized Recipes</h4>";
    echo "<div style='white-space: pre-wrap;'>" . htmlspecialchars($output) . "</div>";
}
?>

<h3>AI Recipe Personalizer 🤖</h3>
<form method="post">
    <label>Available Ingredients:</label>
    <input type="text" name="ingredients" placeholder="e.g. chicken, tomato, onion" required>

    <label>Allergies / Restrictions:</label>
    <input type="text" name="allergies" placeholder="e.g. nuts, dairy">

    <label>Health Goal:</label>
    <select name="goal">
        <option value="weight loss">Weight Loss</option>
        <option value="muscle gain">Muscle Gain</option>
        <option value="balanced diet">Balanced Diet</option>
    </select>

    <button type="submit">Get Recipes</button>
</form>


<?php include 'includes/footer.php'; ?>

