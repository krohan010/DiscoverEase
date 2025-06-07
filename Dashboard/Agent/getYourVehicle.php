
<?php
include("../Dash_navbar.php");

    require("../../Mysql_Query/DBConnect.php");

    if(isset($_SESSION['userid'])){
        $agentid = $_SESSION['userid'];
    }
    else{
        die("Agent Email is not set or agent not login yet");
    }

    $sql = "SELECT * from vehicles where email = '$agentid'";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        die("Fetching Error - " . mysqli_error($conn));
    }

    $noofvehicle = mysqli_num_rows($result);
    

    if (!$result) {
        die("Record Fetching Error - " . mysqli_error($conn));
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agent : Get your Vehicle information</title>
        <link rel="shortcut icon" href="../../Navigation-Bar/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="getYourVehicle.css">
    </head>
    <body>
        <div class="container getVehicle">
            <div class="head">Get Your Vehicle Information</div>
        
        <div class="noofvehicle">Number of Vehicles : <?=$noofvehicle?></div>
        <div class="inner-container">
            <?php
                while($vehicle = mysqli_fetch_assoc($result)){
                    echo"<div class='vehicle-info'>
                        <img src='$vehicle[image_path]' alt='Vehicle Image'>
                        <div class='specification'>
                            <div class='v_id'>Vehicle ID : $vehicle[v_id]</div>
                            <div class='name'>Vehicle Name : $vehicle[vehicle_name]</div>
                            <div class='model'>Vehicle Model : $vehicle[model]</div>
                            <div class='seats'>Number Of Seats : $vehicle[seats]</div>
                        </div>
                    </div>";
                }
            ?>
        </div>
        </div>
    </body>
</html>