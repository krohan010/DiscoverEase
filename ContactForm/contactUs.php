<?php
require('../Mysql_Query/DBConnect.php');
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Validate inputs
    if (empty($name) || empty($email) || empty($message)) {
        echo "All fields are required!";
        exit;
    }

    $sql = "insert into contact(name, email, mssg) values ('$name', '$email', '$message');";
    $result = mysqli_query($conn, $sql);

    if($result){
      echo"<script>alert('Your Message successfully submitted')</script>";
    }
    else{
      echo"<script>alert('please try again later!')</script>";
    }

    
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="shortcut icon" href="../Navigation-Bar/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="contactus.css">
</head>
<body>
    <div class="container">
        <h2>Contact Us</h2>
        <form action="contactUs.php" method="POST">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Your Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit" name="submit">Send Message</button>
        </form>
    </div>
</body>
</html>
