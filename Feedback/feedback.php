<?php
session_start();
require("../Mysql_Query/DBConnect.php"); // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $user_type = htmlspecialchars(trim($_POST['user_type']));
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $feedback = htmlspecialchars(trim($_POST['feedback']));

    // Ensure all fields are filled
    if (empty($user_type) || empty($name) || empty($email) || empty($feedback)) {
        die("Error: All fields are required.");
    }

    // Insert feedback into the database
    $sql = "INSERT INTO feedback (user_or_agent, name, email, feedback) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Preparation Error: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ssss", $user_type, $name, $email, $feedback);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Thank you for your feedback!'); window.location.href='feedback_form.php';</script>";
    } else {
        die("Insertion Error: " . mysqli_error($conn));
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form - DiscoverEase</title>
    <link rel="stylesheet" href="feedback.css">
</head>
<body>
    <div class="container">
        <h1>Feedback Form</h1>
        <p>We value your feedback! Please share your experience with us.</p>
        <form action="feedback.php" method="POST">
            <label for="user_type">Are you a:</label>
            <select name="user_type" id="user_type" required>
                <option value="user">User</option>
                <option value="agent">Agent</option>
            </select>

            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="feedback">Your Feedback:</label>
            <textarea id="feedback" name="feedback" rows="5" placeholder="Write your feedback here..." required></textarea>

            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</body>
</html>