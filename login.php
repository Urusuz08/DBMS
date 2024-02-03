<?php

session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if($_SERVER['REQUEST_METHOD']=='POST'){
$userid = $_POST['user_id'];
$password = $_POST['password'];


$sql = "SELECT * FROM registration WHERE user_id = '$userid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    
    if ($password == $row['Password'] ) {
        
        $_SESSION['user_id'] = $userid;
        header("Location: home1.html"); 
        exit();
    } else {
       
        echo "Invalid password. Please try again.";
    }
} else {
   
    echo "User not found. Please check your User_ID.";
}
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="asset/signin.ico">
    <title>User Login</title>
</head>
<body>

    <h2>User Login</h2>

    <form action="login.php" method="post">
        <label for="user_id">User_ID:</label>
        <input type="text" id="user_id" name="user_id" required>
        <br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>

        <input type="submit" value="Login">
    </form>
    <br>
    <br>
           <h5>If you are new to site, than consider registering yourself.</h5> 
            <a href="sign.php">Sign Up</a>
           <br>
           <br>
           <h5>Browse Home Page using below link.</h5>
            <a href="home.php">Home</a>

</body>
</html>
