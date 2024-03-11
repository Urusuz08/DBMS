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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="asset/signin.ico">
    <link rel="stylesheet" href="styleup.css">
    <title>User Login</title>
    
</head>
<body>
    <div class='home1'>
    <a class='home_bt' href="index.php">Home</a>
    </div>

    <h1>User Login</h1>

    <?php
    if(isset($_POST['login'])){
        $userid = $_POST['user_id'];
        $password = $_POST['password'];
        
        
        $sql = "SELECT * FROM registration WHERE user_id = '$userid' or username = '$userid'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            
            if ($password == $row['Password'] ) {
                
                $_SESSION['user_id'] = $row['User_ID'];
                header("Location: qsetup.php"); 
                exit();
            } else {
               
                ?><p class='log'>Invalid password. Please try again.</p><?php
            }
        } else {
           
            ?><p class='log'>User Not Found. Please check your User_ID.</p><?php
        }}
    ?>
    
    <form action="login.php" method="post">
       <div>
        <label class='large' for="user_id">User_ID or Username </label>
    
        <p><input type="text" id="user_id" name="user_id" placeholder='Anyone One of these.' required></p>
       </div>    
       <div>
        <label class='large' for="password">Password </label>

        <p><input type="password" id="password" name="password" required></p>
       </div>
       <div class='f_w'>
        <p>
        <input class='submit' name='login' type="submit" value="Login">
        <input class='reset' type='reset' value='Reset'>
        </p>
       </div>

       <a href=fp.php><p>Forgot your Password?</p></a>
    </form>
    <br>
    <br>

    
    
           <p>New to Site, than SIGN_UP</p> 
            <p><a class='in_bt' href="sign.php">Sign Up</a></p>
           <br>
           <br>
           
            

</body>
</html>
