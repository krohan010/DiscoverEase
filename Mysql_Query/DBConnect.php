<?php
$sname = "localhost";
$uname = "root";
$pswd = "Rohan@2k1";
$dbname = "discoverease";

$conn = mysqli_connect($sname, $uname, $pswd, $dbname);
if(!$conn){
    die("Error - " .mysqli_connect_error());
}
?>