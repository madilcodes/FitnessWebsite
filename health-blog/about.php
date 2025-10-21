<?php
include 'includes/header.php';
include 'includes/db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        $query = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
        if (mysqli_query($conn, $query)) {
            echo "<div class='alert alert-success'>Thank you! Your message has been sent.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error sending message. Please try again.</div>";
        }
    }
    ?>


<div class="container mt-5">
    <h2 class="mb-4">About FitFoodJourney</h2>
    <p>Welcome to <strong>FitFoodJourney</strong>, your trusted destination for health, travel, and recipe inspiration. Our mission is to help people live better lives through mindful eating, healthy living, and adventurous journeys.</p>

    <h4 class="mt-4">What We Offer:</h4>
    <ul>
        <li><strong>Health Tips:</strong> Expert advice, wellness hacks, and mental health guidance.</li>
        <li><strong>Delicious Recipes:</strong> Nutritious and easy-to-make recipes for every occasion.</li>
        <li><strong>Travel Inspiration:</strong> Explore beautiful destinations with our travel stories and guides.</li>
    </ul>

    <h4 class="mt-4">Our Vision</h4>
    <p>We aim to build a community that values self-care, exploration, and the joy of good food. Whether you're looking to start a healthy lifestyle, plan your next trip, or try a new dish, we're here to guide you.</p>

    <p class="mt-4">Thank you for being part of our journey! 🌱</p>

    <h2 class="mb-4">Contact Us</h2>

        <form action="" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea name="message" id="message" rows="5" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>

