<?php
    include("../Dash_navbar.php");
    require("../../Mysql_Query/DBConnect.php");

    $sql = "select * from feedback";
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
        <title>feedback Details</title>
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="../../Navigation-Bar/logo.png" type="image/x-icon">
    </head>
    <body>
    <div class="container booking-info">
            <div class="inner-container">
                <table class="tb_user">
                    <thead>
                        <tr>
                            <th>feedback Id</th>
                            <th>User / Agent</th>
                            <th>Name</th>
                            <th>Email ID</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Fetch rows
                        while ($feedback = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                            <td>" .htmlspecialchars($feedback['feedback_id']). "</td>
                            <td>" .htmlspecialchars($feedback['user_or_agent']). "</td>
                            <td>" .htmlspecialchars($feedback['name']). "</td>
                            <td>" .htmlspecialchars($feedback['email']). "</td>
                            <td>" .htmlspecialchars($feedback['mssg']). "</td>
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