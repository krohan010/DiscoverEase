<?php
if(session_status()===PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Navbar</title>
    <link rel="stylesheet" href="/DiscoverEase/Dashboard/Dash_navbar.css">
</head>
<body>
    <!-- Side panel - Navigater -->
    <div class="head tittle"><?= strtoupper($_SESSION['loginAs']) ?> Dashboard</div>
    <div class='navigator'>
            <ul>
                <li id='logo'>
                    <img src='\DiscoverEase\Navigation-Bar/removedlogo.png' alt='logo'>
                </li>
                <li><a class="nav" href='/DiscoverEase/Dashboard/Dashboard.php'>Profile</a></li>
                <?php 
                // session_start();
                if($_SESSION['loginAs'] === 'admin'){
                    echo "<li><a class='nav' href='/DiscoverEase/Dashboard/Admin/user_mng.php'>User Management</a></li>";
                    echo "<li><a class='nav' href='/DiscoverEase/Dashboard/Admin/agent_mng.php'>Agent Management</a></li>";
                    echo "<li><a class='nav' href='/DiscoverEase/Dashboard/Admin/booking_info.php'>Booking Details</a></li>";
                }
                else if($_SESSION['loginAs'] === 'agent'){
                    echo "<li><a class='nav' href='/DiscoverEase/Dashboard/Agent/addVehicle.php'>Add Vehicle</a></li>";
                    echo "<li><a class='nav' href='/DiscoverEase/Dashboard/Agent/getYourVehicle.php'>Vehicle Details</a></li>";
                }
                else{
                    echo "<li><a class='nav' href='/DiscoverEase/BookAnVehicle/vehicle.php'>Book An Vehicle</a></li>";
                    echo "<li><a class='nav' href='/DiscoverEase/Dashboard/user/booking_info.php'>Booking History</a></li>";
                    echo "<li><a class='nav' href='/DiscoverEase/Report/report.php'>Report Agent</a></li>";
                }
                ?>
                <li><a class='nav' href='/DiscoverEase/LoginSystem/logout.php'>Logout</a></li>
            </ul>
        </div>

        <script src="Dash_navbar.js"></script>
    </body>
</html>