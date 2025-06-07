<?php

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include 'C:\xampp\htdocs\DiscoverEase\Mysql_Query/DBConnect.php';   

        $name = htmlentities(mysqli_real_escape_string($conn, $_POST["name"]));
        $email = htmlentities(mysqli_real_escape_string($conn, $_POST["email"]));
        $password = htmlentities(mysqli_real_escape_string($conn, $_POST["password"]));
        $cpassword = htmlentities(mysqli_real_escape_string($conn, $_POST["cpassword"])); 
        $loginAs = htmlentities(mysqli_real_escape_string($conn, $_POST["loginAs"]));

        if($loginAs === 'agent'){
            $getRec = "select * from $loginAs where ag_email='$email';";
        }
        else{
            $getRec = "select * from $loginAs where u_email='$email';"; 
        }
        
        $result = mysqli_query($conn, $getRec); // returns boolean value

        if(!$result){
            die("Query Failed - ". mysqli_error($conn));
        }
        $numOfRec = mysqli_num_rows($result); // counts the number of records in the table..
    
        if($numOfRec > 0){
            echo "<script>mssgbox.classList.toggle('danger'); alert('you have Already registered. Go to Login Page')</script>";
        }
        else{
            // Condition check - Both Password must be match or User has not registered thereself before...
            if($password == $cpassword){
                $hash_pass = password_hash($password, PASSWORD_DEFAULT);
                if($loginAs === 'agent'){
                    $sql = "insert into $loginAs (name, ag_email, password) values ('$name', '$email', '$hash_pass');";
                }
                else{
                    $sql = "insert into $loginAs (name, u_email, password) values ('$name', '$email', '$hash_pass');";
                }
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo "<script>window.alert('You have successfully Registered Yourself!')</script>";
                    // echo"<script>printSuccess('You have successfully Registered Yourself!')</script>";
                    echo "<script>window.location.href='/DiscoverEase/loginSystem/login.php'</script>";
                    // exit();
                }
                else{
                    echo ("Insertion Error". mysqli_error($conn) );
                }
            }
            else{
                // echo "<script type='text/javascript'>
                //         printError("Password should be matched and you do not have regestered befor");
                //       </script>" ;
                echo "Password and Confirm Password must be matched..";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up Yourself</title>
        <link rel="stylesheet" href="login-signup.css">
    </head>
    <body style="background-image: url('/DiscoverEase/Images/mountain.jpg');">
        <!-- MessageBox for Success and Alert  -->
         <div class="mssgbox" name="mssgbox" id="mssgbox">
            <p class="mssg" name="mssg" id="mssg"></p>
         </div>
        
        <div class="container" id="signup">
            <p>Register Yourself!</p>
            <form action="signUp.php" method="POST" onSubmit="return ValidateForm()" name="signup">
                <div class="inputs">
                    <input type="text" name="name" id="name" placeholder="Name">
                </div>
                <div class="inputs">
                    <input type="email" name="email" id="email" placeholder="Email Id">
                </div>
                <div class="inputs">
                    <input type="password" name="password" id="password" placeholder="Password">
                    <img src="eye-on-icon.png" alt="show-passwrod" id="p_visibility">
                </div>
                <div class="inputs">
                    <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password">
                    <img src="eye-on-icon.png" alt="show-passwrod" id="cp_visibility">
                </div>
                <div class="inputs" id="who">
                    <label for="loginAs">Login As</label>
                    <select name="loginAs" id="loginAs">
                      <option value="">---Select---</option>
                      <option value="user">User</option>
                      <option value="agent">Agent</option>
                      <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="inputs" id="submit">
                    <input type="submit" value="Register Yourself!" name="submit">
                </div>
            </form>
        </div>
        <script src="signUp.js"></script>
    </body>
</html>