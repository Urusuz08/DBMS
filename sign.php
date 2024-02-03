<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}







?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="asset/signup.ico">
    <title>User Registration</title>
</head>
<body>
    <?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
$sqlCheck = "SELECT * FROM registration WHERE username = '$username'";

$resultCheck = $conn->query($sqlCheck);

if ($resultCheck->num_rows > 0) {
   
    echo "User already exists. Please try signing up with a different username.";
} else {
    
    $sqlInsert = "INSERT INTO registration VALUES ('','$username', '$password')";

    if ($conn->query($sqlInsert) === TRUE) {
        echo "Registration successful! Welcome, $username!";
        $userid = "SELECT User_ID FROM registration WHERE username = '$username'";
        $bbsd = $conn->query($userid);
        $row = $bbsd->fetch_assoc();
        echo " Your User_ID : ". $row["User_ID"] . ". Please note it down for future sign in.";
    } else {
        echo "Error: " . $sqlInsert . "<br>" . $conn->error;
    }
}
}
    ?>
    <h2>User Registration</h2>

    <form action="sign.php" method="post">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username" required>
        <br>
        <br>

        <label for="password">Password: </label>
        <input type="password" id="password" name="password" required>
        <br>
        <br>

        <input type="submit" value="Submit">
        <br>
        <br>

        <input type="reset" value="Reset">
    </form>
    <br>
    <br>


           <h5>If you already Signed up than just sign in.</h5> 
            <a href="login.php">Sign In</a>
           <br>
           <br>
           <h5>Browse Home Page using below link.</h5>
            <a href="home.php">Home</a>
            
        
    

</body>
</html>

