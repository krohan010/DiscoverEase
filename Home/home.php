<?php 
include 'C:\xampp\htdocs\DiscoverEase\Mysql_Query\DBConnect.php';
$sql = 'select * from images';
$result = mysqli_query($conn, $sql);
if(!$result){
    die("Error -  mysqli_error($result)");
}
$num_of_rec = mysqli_num_rows($result);
?>


<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Slider</title>
     <!-- <link rel='stylesheet' href='Home/new-home.css'>  -->
     <link rel='stylesheet' href='Home/home.css'>

     <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,200..900;1,200..900&family=Diplomata+SC&family=Gabriela&family=Lobster&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class='slideshow-container'>
        <?php  
             $slides = 10;
            for($i=1; $i<=$slides; $i++){
                $row = mysqli_fetch_assoc($result);   
                echo "
                <div class='slide'>
                    <div class='image'>
                        <img src=$row[file_path] alt='$row[img_name]'>
                    </div>
                    <div class='outer-hover'>
                        <div class='desc'>
                            <h2>$row[img_name]</h2>
                            <p>$row[img_desc]</p>
                            <address>$row[addr]</address>
                        </div>
                    </div>
                </div>";
            }
        ?>
        <!-- Next and Previous buttons -->
        <a class='prev' onclick='changeSlide(-1)'>&#10094;</a>
        <a class='next' onclick='changeSlide(1)'>&#10095;</a>

        <div style='text-align:center'>
            <span class='dot' onclick='currentSlide($row[img_id])'></span>
        </div>
    </div>
    <script src='Home/home.js'></script>
</body>
</html>