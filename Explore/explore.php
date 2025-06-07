<?php 
include '../Mysql_Query/DBConnect.php';
$sql = "select * from images";
$result = mysqli_query($conn, $sql);
$num_of_rec = mysqli_num_rows($result);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiscoverEase - Explore Places</title>
    <link rel="shortcut icon" href="../Navigation-Bar/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="explore.css">
</head>
<body>
    
<?php include '../Navigation-Bar/Navbar.php'?>
    <div class="image-container" id="container">
        <?php 
            while($row = mysqli_fetch_assoc($result)){
                echo("<div class='slide'>
                <img src=$row[file_path] alt=$row[img_name] /> 
                </div>");
                }
        ?>
    </div>

    <?php
     include('../Footer/footer.php');
    ?>
        
        <script src="explore.js"></script>
</body>
</html>