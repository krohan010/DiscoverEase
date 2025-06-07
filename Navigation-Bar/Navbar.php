<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiscoverEase</title>

    <!-- CSS File -->
    <link rel="stylesheet" href="/DiscoverEase/Navigation-Bar/Navbar.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@400;600&family=Lobster&display=swap" rel="stylesheet">
</head>

<body>
    <div class="nav-container">
        <div class="logo">
            <img src="/DiscoverEase/Navigation-Bar/logo.png" alt="DiscoverEase Logo">
        </div>
        <nav>
            <div class="title">DiscoverEase: Your Gateway to Seamless Exploration</div>
            <ul id="navigation-bar">
                <li><a href="/DiscoverEase/BookAnVehicle/vehicle.php">Book A Vehicle</a></li>
                <li><a href="/DiscoverEase">Home</a></li>
                <li><a href="/DiscoverEase/About/about.php">About</a></li>
                <li id="explore">
                    <a href="/DiscoverEase/Explore/explore.php">Explore</a>
                    <ul id="explore-areas" class="innerUL">
                        <li><a href="/DiscoverEase">Delhi</a></li>
                        <li><a href="/DiscoverEase">Gurugram</a></li>
                        <li><a href="/DiscoverEase">Noida</a></li>
                    </ul>
                </li>
                <li><a href="/DiscoverEase/Feedback/feedback.php">Feedback</a></li>
                <li><a href="/DiscoverEase/ContactForm/contactUs.php">Contact Us</a></li>
                <li id="login">
                    <?php
                    session_start();
                    if (isset($_SESSION['userid']) && $_SESSION['loggedin'] == true) {
                        echo "<a href='/DiscoverEase/Dashboard/Dashboard.php'>" . htmlspecialchars($_SESSION['username']) . "</a>";
                        echo '<ul id="logout" class="innerUL">
                                <li><a href="/DiscoverEase/loginSystem/logout.php">Logout</a></li>
                              </ul>';
                    } else {
                        echo '<a href="/DiscoverEase/loginSystem/login.php">Login</a>';
                    }
                    ?>
                </li>
            </ul>
        </nav>
    </div>

    <!-- JavaScript for Sticky Navbar -->
    <script>
        window.addEventListener('scroll', function() {
            let nav = document.querySelector('.nav-container');
            nav.classList.toggle('sticky', window.scrollY > 0);
        });
    </script>
</body>

</html>