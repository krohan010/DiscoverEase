<?php include('../Navigation-Bar/Navbar.php'); ?>
<?php 
    include("../Mysql_Query/DBConnect.php");
    // session_start();
    if(isset($_SESSION['username']) && $_SESSION['loggedin'] == true){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $source = $_POST['source'];
            $destination = $_POST['destination'];
            // $startDate = $_POST['startDate'];
            $startDate = date('y-m-d H:i:s', strtotime($_POST['startDate']));
            // $endDate = $_POST['endDate'];
            $endDate = date('y-m-d H:i:s', strtotime($_POST['endDate']));
            $countTraveller = $_POST['traveller'];
            $tripType = $_POST['trip_type'];
            $userid = $_SESSION['userid'];

            if(isset($tripType)){
                $sql = "insert into bookVehicle
                    (sourcePlace, destinationPlace, startDate, endDate, countTravellers, tripType, u_email) 
                    values('$source', '$destination', '$startDate', '$endDate', '$countTraveller', '$tripType', '$userid');";
            }
            else{
                $sql = "insert into bookVehicle
                    (source, destination, startDate, endDate, countTravellers, email) 
                    values('$sourcePlace', '$destinationPlace', '$startDate', '$endDate', '$countTraveller', '$userid');";
            }
            $result = mysqli_query($conn, $sql);
            if($result){
                echo"<script>
                alert('Booking Successful!')
                window.location.href='/DiscoverEase/index.php';
                </script>";
            }
            else{
                echo("Insertion Error - ". mysqli_error($conn));
            }
        }
?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>DiscoverEase - Book An Vehicle</title>
        <link rel='shortcut icon' href='../Navigation-Bar/logo.png' type='image/x-icon'>
        <link rel='stylesheet' href='vehicle.css'>
        <link href='https://fonts.googleapis.com/css2?family=Lobster&display=swap' rel='stylesheet'>
    </head>
    <body>

    <div id='vehicle'>
        <div class='tittle'><p>Book Vehcile Now!</p></div>
        <form action="vehicle.php" method="POST" name="vehicle" onsubmit="return vehicleValidateForm()">
            <fieldset>
                <legend>&#128516;Make your Trip Easy&#128515;</legend>
                <label for='source'>Source Place <sup>*</sup></label>
                <input type='text' id='source' name='source'>
                <label for='destination'>Destination Place <sup>*</sup></label>
                <input type='text' id='destination' name='destination'>
                <label for='startDate'>Trip Start Date <sup>*</sup></label>
                <input type='datetime-local' id='startDate' name='startDate'>
                <label for='endDate'>Trip End Date <sup>*</sup></label>
                <input type='datetime-local' id='endDate' name='endDate'>
                <label for='pasenger'>Total Number of Person <sup>*</sup></label>
                <input type='text' id='pasenger' name='traveller'>
                <label for='trip_type'>Type of Trip <sup>Optional</sup></label>
                <select name='trip_type' id='trip_type'>
                    <option value='none'>--select--</option>
                    <option value='Family Trip'>Family Trip</option>
                    <option value='Friends Trip'>Friends Trip</option>
                    <option value='Office Trip'>Office Trip</option>
                    <option value='Industrial Visit'>Industrial Visit</option>
                    <option value='others'>Others</option>
                </select>
                <input type='submit' value='submit'>
            </fieldset>
        </form>
    </div>
    <script src="vehicle.js"></script>
</body>
</html> ";
<?php 
}
else{
    echo "<script>
    alert('Login is must require to book an vehicle')
    window.open('../index.php', '_self');
    </script>";
}
?>