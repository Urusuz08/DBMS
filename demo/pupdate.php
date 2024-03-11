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
    <title>Password Recovery</title>
</head>
<body>
    <div class='home1'>
    <a class='home_bt' href="index.php">Home</a>
    </div>

    <h1>Change Password</h1>

    <?php
    if(isset($_POST['submit'])){
        $userid=$_SESSION['user_id'] ;
        

        $p1=$_POST['p1'];
        $p2=$_POST['p2'];
        

        if($p1==$p2){
            $sql="UPDATE registration SET Password='$p1' where user_id='$userid'";

            if($conn->query($sql)===true){
            header('location: index.php');
            }else{
                ?><p>Password Not Updated</p><?php
            }

        }
        else{
            ?><p>Type same Password in both Boxes.</p><?php
        }
    }
    ?>
    
    <form action="pupdate.php" method="post">
       <div>
        <label class='large'>Enter Password  </label>
        <p><input type="text" id="p1" name="p1" required></p>
       </div>    
       <div>
        <label class='large'>Re-Enter Password </label>
        <p><input type="password" id="p2" name="p2" required></p>
       </div>
       
       <div class='f_w'>
        <p>
        <input class='submit' name='submit' type="submit" value="Submit">
        <input class='reset' type='reset' value='Reset'>
        </p>
       </div>

    </form>
    <br>
    <br>

    
    
           
           
            

</body>
</html>
