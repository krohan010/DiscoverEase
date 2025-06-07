<?php
require("../Mysql_Query/DBConnect.php"); // Database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $u_id = intval($_POST['u_id']);
    $ag_id = intval($_POST['ag_id']);
    $reason = trim($_POST['reason']);

    // Validation
    if (empty($u_id) || empty($ag_id) || empty($reason)) {
        die("All fields are required.");
    }

    // Insert report into database
    $sql = "INSERT INTO reports (u_id, ag_id, reason) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iis", $u_id, $ag_id, $reason);
        $execute_result = mysqli_stmt_execute($stmt);

        if ($execute_result) {
            echo "<script>alert('Report submitted successfully!');</script>";
        } else {
            echo "<script>alert('Error submitting the report: " . mysqli_error($conn) . "');</script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing the statement: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Agent</title>
    <link rel="stylesheet" href="report.css">
</head>
<body>
    <div class="container">
        <h2>Report an Agent</h2>
        <form action="/DiscoverEase/Report/report.php" method="POST">
            <label for="u_id">Your User ID:</label>
            <input type="number" name="u_id" id="u_id" required>
            
            <label for="ag_id">Agent ID:</label>
            <input type="number" name="ag_id" id="ag_id" required>
            
            <label for="reason">Reason for Reporting:</label>
            <textarea name="reason" id="reason" rows="5" required></textarea>
            
            <button type="submit">Submit Report</button>
        </form>
    </div>
</body>
</html>
