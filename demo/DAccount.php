<?php 

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="asset/signin.ico">
    <link rel="stylesheet" href="styleup.css">
    <title>Account Deletion</title>
    
</head>
<body>
    <div class='home1'>
    <a class='home_bt' href="home1.html">Home</a>
    </div>

    <h1>Account Deletion</h1>
    <form action="DAccount.php" method="post">
       <div>
        <label class='large' for="password">Enter Password </label>
        <p><input type="text" id="password" name="password" required></p>
       </div>  

       <div>
        <label class='large' for="rpassword">Re-Enter Password </label>
        <p><input type="password" id="rpassword" name="rpassword" required></p>
       </div>

       <div class='f_w'>
        <p>
        <input class='submit' name='delete' type="submit" value="Delete Account">
        </p>
       </div>
    
    <?php
       if(isset($_POST['delete'])){
        $password=$_POST['password'];
        $rpassword=$_POST['rpassword'];

        if($password==$rpassword){
        $userid=$_SESSION['user_id'];
        $sql = "SELECT * FROM registration WHERE user_id = '$userid'";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    
                    
                    if ($password == $row['Password'] ) {
                        $sql1="DELETE from registration where user_id='$userid'";
                        $sql2="DELETE from questionare where qid='$userid'";
                        $sql3="DELETE from student where studentid='$userid'";
                        if($conn->query($sql1) && $conn->query($sql2) && $conn->query($sql3)){
                        header("Location: index.php"); 
                        exit();
                        }
                    } else {
                    
                        ?><p class='log'>Invalid password. Please try again.</p><?php
                    }
                }
            }
        else{
            ?><p>Passwords are different in fields.</p><?php
        }
    }

       ?>
    </form>
    <br>
    <br>

    </body>
</html>