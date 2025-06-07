<?php
session_start();
session_unset();
session_destroy();
echo"<script>alert('You are successfully log out!')</script>";
// Redirecting to the login page after logout is done.
echo"<script>window.location.href='login.php'</script>";
exit();
?>