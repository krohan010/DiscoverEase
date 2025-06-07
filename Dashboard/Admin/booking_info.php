<?php
    include("../Dash_navbar.php");
    require("../../Mysql_Query/DBConnect.php");

    $sql = "select bv.b_id,  u.name as user_name, a.name as agent_name, bv.sourcePlace, bv.destinationPlace, 
            bv.startDate, bv.endDate, bv.countTravellers, bv.tripType from
            bookvehicle as bv join user as u
            on bv.u_email = u.u_email
            left join agent as a 
            on bv.ag_email = a.ag_email; ";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Record Fetching Error - " . mysqli_error($conn));
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Booking Details and Information</title>
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="../../Navigation-Bar/logo.png" type="image/x-icon">
    </head>
    <body>
    <div class="container booking-info">
            <!-- <div class="head">Booking Details</div> -->
            <div class="inner-container">
                <table class="tb_user">
                    <thead>
                        <tr>
                            <th>booking Id</th>
                            <th>Booked By</th>
                            <th>Assign To</th>
                            <th>Source Place</th>
                            <th>Destination Place</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>No. of Travellers</th>
                            <th>Trip Type</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Fetch rows
                        while ($trip = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                            <td>" .htmlspecialchars($trip['b_id']). "</td>
                            <td>" .htmlspecialchars($trip['user_name']). "</td>
                            <td>" .htmlspecialchars($trip['agent_name']). "</td>
                            <td>" .htmlspecialchars($trip['sourcePlace']). "</td>
                            <td>" .htmlspecialchars($trip['destinationPlace']). "</td>
                            <td>" .htmlspecialchars($trip['startDate']). "</td>
                            <td>" .htmlspecialchars($trip['endDate']). "</td>
                            <td>" .htmlspecialchars($trip['countTravellers']). "</td>
                            <td>" .htmlspecialchars($trip['tripType']). "</td>
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