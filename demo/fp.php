<?php
session_start();

$servername = "localhost";
$user = "root";
$pass = "";
$dbname = "project";

$conn = new mysqli($servername, $user, $pass, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_POST['otp'])){
        $userid=$_POST['user_id'];

        $sql = "SELECT user_id FROM registration WHERE user_id = '$userid'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            
            if ($userid == $row['user_id'] ) {
                
                $_SESSION['user_id'] = $userid;
                header('location: question.php'); 
                exit();
            } 
        } else {
           
            ?><p class='log'>User Not Found. Please check your User_ID.</p><?php
        }
        
    }

       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="asset/signin.ico">
    <link rel="stylesheet" href="styleup.css">
    <title>Password Recovery</title>
    
</head>
<body>
    <div class='home1'>
    <a class='home_bt' href="index.php">Home</a>
    </div>

    <h1>Forgot Password</h1>

    
    
    <form action="fp.php" method="post">
       <div>
        <label class='large' for="user_id">User_ID  </label>
    
        <p><input type="text" id="user_id" name="user_id" required></p>
       </div>    

       <div class='f_w'>
        <p>
        <input class='submit' name='otp' type="submit" value="Proceed">
        </p>
       </div>

       <a href=fp.php><p>Forgot your User-ID or Username?</p></a>
    </form>
    <br>
    <br>
               

</body>
</html>
