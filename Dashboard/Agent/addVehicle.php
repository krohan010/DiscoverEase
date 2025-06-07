<?php
    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }
    require("../../Mysql_Query/DBConnect.php");
    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate and sanitize inputs
        $vehicle_name = htmlspecialchars(trim($_POST['vehicle_name']));
        $model = htmlspecialchars(trim($_POST['model']));
        $seats = intval($_POST['seats']);
    
        // Get agent ID (from session)
        $email = $_SESSION['userid']; // Ensure the session is set
    
        // Handle image upload
        $upload_dir = "upload_vehicle/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
    
        if(isset($_FILES['image'])){
            $image_name = basename($_FILES['image']['name']);
            $image_path = $upload_dir . uniqid() . "_" . $image_name;
            
            // Check file type
            $file_type = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));
            if (!in_array($file_type, ['jpg', 'jpeg', 'png', 'gif'])) {
                die("Invalid file type. Please upload an image (jpg, jpeg, png, gif).");
            }
        }
        else{
            die( "Image Files not set");
        }
    
        // Move the uploaded file
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            die("Error uploading file.");
        }
    
        // Insert into database
        $sql = "INSERT INTO vehicles (email, vehicle_name, model, seats, image_path) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssiis", $email, $vehicle_name, $model, $seats, $image_path);
    
        if (mysqli_stmt_execute($stmt)) {
            echo "<script> alert('Vehicle added successfully!')</script>";
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
    <title>Agent : Add Your Vehicle</title>
    <link rel="shortcut icon" href="../../Navigation-Bar/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="addVehicle.css">
</head>
<body>
    <div class="container">
        <h1>Add Vehicle Information</h1>
        <form id="vehicleForm" action="addVehicle.php" method="POST" enctype="multipart/form-data">
            <label for="vehicle_name">Vehicle Name:</label>
            <input type="text" id="vehicle_name" name="vehicle_name" placeholder="Enter vehicle name" required>

            <label for="model">Model:</label>
            <input type="text" id="model" name="model" placeholder="Enter model" required>

            <label for="seats">Number of Seats:</label>
            <input type="number" id="seats" name="seats" placeholder="Enter number of seats" required>

            <label for="image">Vehicle Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <button type="submit">Submit</button>
        </form>
    </div>

    <script src="addVehicle.js"></script>
</body>
</html>
