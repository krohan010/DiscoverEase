<?php
  if($_SERVER["REQUEST_METHOD"]==="POST"){
      // Inlclude file where Database Connection Establishment done...
      include 'C:\xampp\htdocs\DiscoverEase\Mysql_Query/DBConnect.php';
      $email = $_POST['userid'];
      $password = $_POST['password'];
      $loginAs = $_POST['loginAs'];

      if($loginAs === 'user'){
        $sql = "Select * from $loginAs where u_email = '$email'";
      }
      elseif($loginAs === 'agent'){
        $sql = "Select * from $loginAs where ag_email = '$email'";
      }
      elseif($loginAs === 'admin'){
        $sql = "Select * from $loginAs where email = '$email'";
      }
      else{
        echo "LoginAs has null value";
      }
      
      $result = mysqli_query($conn, $sql);

      // Number of records after fetching the details from account table...
      $num = mysqli_num_rows($result);
      if($num > 0){
        while($row = mysqli_fetch_assoc($result)){
          // check if user password is equalent to database password
          if(password_verify($password, $row['password'])){
            echo("<script>alert('You have Successfully login into your account')</script>");
            $name = $row['name'];
            
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['userid'] = $email; 
            $_SESSION['username'] = $name;
            $_SESSION['loginAs'] = $loginAs;
            // redirect to other location after login completed by the user..
            // header("location:/DiscoverEase/index.php");
            echo"<script>window.location.href='/DiscoverEase/index.php'</script>";
            exit();
          }
          else{
            echo "<script>window.alert('Invalid Password')</script>";
          }
        }
      }
      else{
        echo "<script>window.alert('Invalid Credentials - username and password')</script>";
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="login-signup.css" />
  </head>
  <body style="background-color: url(/Images/demo.jpg);">
  <div class="mssgbox">
        <p class="mssg"></p>
    </div>
    <div class="container" id="login">
      <p>Login Form</p>
      <form action="login.php" method="POST" name="loginForm" onSubmit="return validateForm()">
        <div class="inputs" id="username">
          <input type="text" name="userid"  placeholder="User-Name/Eamil-ID" />
        </div>
        <div class="inputs" id="password-sec">
          <input type="password" name="password" id="password" placeholder="Password" />
          <img src="eye-on-icon.png" alt="show-passwrod" id="visibility">
        </div>
        <div id="who" class="inputs">
          <label for="loginAs">Login As</label>
          <select name="loginAs" id="loginAs">
            <option value="null">---Select---</option>
            <option value="user">User</option>
            <option value="agent">Agent</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <div class="inputs" id="submit">
          <input type="submit" value="LogIn to Your Account"/>
        </div>
      </form>
      <div class="inputs" id="register">
        <p>Don't have an Account</p>
        <a href="signUp.php">Register Now!</a>
      </div>
    </div>
    <script src="login.js"></script>
  </body>
</html>