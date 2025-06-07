<?php 
include("../Mysql_Query/DBConnect.php");
if(session_status()===PHP_SESSION_NONE){
    session_start();
}

// Check if user is logged in
if (isset($_SESSION['username']) && $_SESSION['loggedin'] === true) {
    $loginAs = $_SESSION['loginAs'];
    $userid = $_SESSION['userid'];

    // Fetch user data
    if($loginAs === 'user'){
        $sql = "SELECT * FROM $loginAs WHERE u_email = '$userid'";
    }
    elseif($loginAs === 'agent'){
        $sql = "SELECT * FROM $loginAs WHERE ag_email = '$userid'";
    }
    elseif($loginAs === 'admin'){
        $sql = "SELECT * FROM $loginAs WHERE email = '$userid'";
    }
    else{
    }
    
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query Error - " . mysqli_error($conn));
    }

    $user = mysqli_fetch_assoc($result);
    $username = $user['name']; 
    if($loginAs === 'user'){
        $email = $user['u_email'];
    }
    elseif($loginAs === 'agent'){
        $email = $user['ag_email'];
    }
    elseif($loginAs === 'admin'){
        $email = $user['email'];
    }
   
    $userphone_no = $user['phone_no'];
    $usergender = $user['gender'];
    $userage = $user['age'];
    $usernationality = $user['nationality'];
    $useraddress = $user['addr'];

    // Handle form submission And Insertion...
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
        $phone_no = $_POST['phone'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $nationality = $_POST['nationality']; 
        $addr = $_POST['addr'];

        if($_SESSION['loginAs'] === 'user'){
            $updateQuery = "UPDATE $loginAs 
                            SET phone_no = '$phone_no', gender = '$gender', age = $age, nationality = '$nationality', addr = '$addr' 
                            WHERE u_email = '$email'";
        }
        elseif($_SESSION['loginAs'] === 'agent'){
            $updateQuery = "UPDATE $loginAs 
                            SET phone_no = '$phone_no', gender = '$gender', age = $age, nationality = '$nationality', addr = '$addr' 
                            WHERE ag_email = '$email'";
        }
        else{
            $updateQuery = "UPDATE $loginAs 
                            SET phone_no = '$phone_no', gender = '$gender', age = $age, nationality = '$nationality', addr = '$addr' 
                            WHERE email = '$email'";
        }

        if (mysqli_query($conn, $updateQuery)) {
            echo "<script>alert('Your Details are updated Successfully!');</script>";
        } else {
            die("Updation Error - " . mysqli_error($conn));
        }
    }

    // Handle Account Deletion...
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])){
        $del = "Delete from $loginAs where u_email = '$userid';";
        if(mysqli_query($conn, $del)){
            session_destroy();
            echo"
            <script>
            alert('Your Account has been deleted successfully!');
            window.location.href='/DiscoverEase/LoginSystem/login.php';
            </script>";
            
        }
        else{
            die("Deletion Error - ". mysqli_error($conn));
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard : User</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="shortcut icon" href="../Navigation-Bar/logo.png" type="image/x-icon">
</head>
<body>
    <!-- Side panel - Navigator -->
    <?php 
        include "Dash_navbar.php";
    ?>
    <div class="dashboard" id="dashboard">
        <!-- Main page content -->
        <div class="main-page">
            <div class="user-info">
                <div class="profile-photo">
                    <img src="/DiscoverEase/upload/profile.png" alt="Profile Photo">
                </div>
                <div class="profile-info">
                    <div id="name"><?= htmlspecialchars($username) ?></div>
                    <div id="email"><?= htmlspecialchars($email) ?></div>
                </div>
            </div>
            <div class="addi-info">
                <div id="phone">Phone Number: <?= htmlspecialchars($userphone_no) ?></div>
                <div id="gender">Gender: <?= htmlspecialchars($usergender) ?></div>
                <div id="age">Age: <?= htmlspecialchars($userage) ?></div>
                <div class="nationality">Nationality: <?= htmlspecialchars($usernationality) ?></div>
                <div id="addr">Address: <?= htmlspecialchars($useraddress) ?></div>
                <div class="btns">
                    <button class="btn" id="btnUpdate">Update Profile</button>
                    <form id="deleteForm" method="POST">
                        <input type="hidden" name="delete" value="1">
                        <button type="button" class="btn" id="btnDelete" onclick="confirmDelete()">Delete my Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update form -->
    <div class="update" id="updateForm">
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" name="updateForm">
            <h2>Update your Profile</h2>
            <span id="cross">&#10006;</span>
            <label for="phone">Phone NO</label>
            <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($userphone_no) ?>" required>
            
            <div class="gender">
                <label>Gender</label>
                <input type="radio" name="gender" id="male" value="Male" <?= $usergender === 'Male' ? 'checked' : '' ?>>
                <label for="male">Male</label>
                <input type="radio" name="gender" id="female" value="Female" <?= $usergender === 'Female' ? 'checked' : '' ?>>
                <label for="female">Female</label>
                <input type="radio" name="gender" id="others" value="Others" <?= $usergender === 'Others' ? 'checked' : '' ?>>
                <label for="others">Others</label>
            </div>
            
            <label for="age">Age</label>
            <input type="number" name="age" id="age" value="<?= htmlspecialchars($userage) ?>" required>

            <label for="nationality">Nationality</label>
            <select name="nationality" id="nationality" required>
                <option value="none">---Select---</option>
                <option value="Indian" <?= $usernationality === 'Indian' ? 'selected' : '' ?>>Indian</option>
                <option value="American" <?= $usernationality === 'American' ? 'selected' : '' ?>>American</option>
                <option value="Other" <?= $usernationality === 'Other' ? 'selected' : '' ?>>Other</option>
            </select>

            <label for="addr">Address</label>
            <textarea name="addr" id="addr" rows="3" required><?= htmlspecialchars($useraddress) ?></textarea>
            
            <input type="submit" value="Update Now!" name="update" class="btn">
        </form>
    </div>

    <script src="Dashboard.js"></script>
</body>
</html>
<?php 
} else {
    echo "<script>alert('Login is Required');</script>";
    header('Location: /DiscoverEase/LoginSystem/login.php'); // Redirect to login page
    exit();
}
?>