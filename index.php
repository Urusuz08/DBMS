<?php
// Logout page
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='icon' href="asset/logo.ico">
    <title>Home Page</title>
</head>
<body>

    <h2>DBMS Mini Project.</h2>

    
    <nav>
        <ul>
            <li><a href="sign.php">Sign Up</a></li>
            <li><a href="login.php">Sign In</a></li>
            <li><a href="Scheme.php">Schemes</a></li>
            <li><a href="aboutus.php">About Us</a></li>
        </ul>
    </nav>

    

</body>
</html>
