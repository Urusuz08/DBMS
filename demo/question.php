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
        
        $sql="SELECT * FROM Questionare where qid='$userid'";
        $wq=$conn->query($sql);

        $row=$wq->fetch_assoc();

        $q1=$_POST['q1'];
        $q2=$_POST['q2'];
        $q3=$_POST['q3'];

        if($q1==$row['q1'] && $q2==$row['q2'] && $q3==$row['q3']){
            header('location: pupdate.php');
        }
        else{
            ?><p>Invalid Answers given to Security Questions.</p><?php
        }
    }
    ?>
    
    <form action="question.php" method="post">
       <div>
        <label class='large'>What is Your Pet Name?  </label>
        <p><input type="text" id="q1" name="q1" required></p>
       </div>    
       <div>
        <label class='large'>What is name of Your Birth Place? </label>
        <p><input type="text" id="q2" name="q2" required></p>
       </div>
       <div>
        <label class='large'>What is your Best-Friend's name? </label>
        <p><input type="text" id="q3" name="q3" required></p>
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
