<?php  
    include('../Dash_Navbar.php');
    require("../../Mysql_Query/DBConnect.php");
    $sql = "select * from bookVehicle where u_email = '$_SESSION[userid]';";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        die ("Selection Error - " . mysqli_error($conn));
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Booking Information</title>
    <link rel="stylesheet" href="../Admin/style.css">
    <link rel="shortcut icon" href="../../Navigation-Bar/logo.png" type="image/x-icon">
</head>
<body>
    <div class="container vehicle-info">
        <div class="head">Vehicle Booking Information</div>
        <div class="body inner-container">
            <table>
                <thead>
                    <tr>
                        <th>Booking Id</th>
                        <th>Source Name</th>
                        <th>Destination Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>No of Travellers</th>
                        <th>Trip Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($vehicle = mysqli_fetch_assoc($result)){
                        echo
                        "<tr>
                        <td>$vehicle[b_id]</td>
                        <td>$vehicle[sourcePlace]</td>
                        <td>$vehicle[destinationPlace]</td>
                        <td>$vehicle[startDate]</td>
                        <td>$vehicle[endDate]</td>
                        <td>$vehicle[countTravellers]</td>
                        <td>$vehicle[tripType]</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script>
    let table = new DataTable('.tb_user');
</script>
</body>
</html>