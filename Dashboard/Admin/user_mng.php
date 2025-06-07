<?php
require("../../Mysql_Query/DBConnect.php");

$sql = "SELECT * FROM user";
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
    <title>Admin - User Management</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../../Navigation-Bar/logo.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.css"> -->

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" i -->

</head>
<body>
    <?php 
    include "../Dash_navbar.php";
    ?>
<div class="container">
    <div class="inner-container">
<table class="tb_user table-hover">
    <thead>
        <tr class="headers rows">
           
             <!-- Fetch column names
             while ($col = mysqli_fetch_field($result)) {
                echo "<th>" . htmlspecialchars($col->name) . "</th>";
             } -->
            
            <th>User Id</th>
            <th>Name</th>
            <th>Eamil Id</th>
            <th>Phone No</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Nationality</th>
            <th>Address</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        // Reset result pointer
        mysqli_data_seek($result, 0);

        // Fetch rows
        while ($user = mysqli_fetch_assoc($result)) {
            echo "<tr class='rows'>";
            foreach ($user as $key => $value) {
                if($key == 'password'){
                    continue;
                }
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
</div>
</div>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script>
    let table = new DataTable('.tb_user');
</script>
</body>
</html>