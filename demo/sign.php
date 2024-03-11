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
    <link rel="stylesheet" href="styleup.css">
    <title>User Registration</title>
</head>
<body>
    <div class='home1'>
    <a class='home_bt' href="index.php">Home</a>
    </div>
    <h1>User Registration</h1>

    <?php
        if(isset($_POST["submit"])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $contact = $_POST['contactno'];
        $sqlCheck1 = "SELECT * FROM registration WHERE username = '$username'";
        $sqlcheck2 = "SELECT * FROM registration WHERE contactno = '$contact'";
        
        
        $resultCheck = $conn->query($sqlCheck1);
        $resultCheck1 = $conn->query($sqlcheck2);

        if($username==NULL || $contact==NULL){
                echo "<p> Please Enter the Mandatory Fields </p>";
            }
        elseif ($resultCheck->num_rows > 0) {
        
            echo "<p> User already exists. Please try signing up with a different username.</p>";
         } 

        elseif ($resultCheck1->num_rows > 0){
            echo "<p> User already exists. Please try signing up with a different contact no. </p>";
        }
        
        else {
            
            $sqlInsert = "INSERT INTO registration VALUES ('','$username', '$password','$contact')";

            if ($conn->query($sqlInsert) === TRUE) {
                echo "<p> Registration successful! Welcome, $username!</p>";
                $userid = "SELECT User_ID FROM registration WHERE username = '$username'";
                $bbsd = $conn->query($userid);
                $row = $bbsd->fetch_assoc();
                 ?> 
                 <p class='php'>Your User_ID : "<?php echo " ". $row["User_ID"] . " ";?> ". Please note it down for future sign in.</p>
                 <?php
            } else {
                echo "Error: " . $sqlInsert . "<br>" . $conn->error;
            }
        }
        
        }


    ?>

    <form id='usernameForm' action="sign.php" method="post">
        <div>
        <label class='large' for="username">Username </label>
        <p><input type="text" id="username" name="username" required></p>
        <p><span id="usernameError" class="error"></span><p><br>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('usernameForm').addEventListener('submit', function(event) {
        var username = document.getElementById('username').value;
        var usernameError = document.getElementById('usernameError');

        if (!/^[a-zA-Z][a-zA-Z0-9]*$/.test(username)) {
            usernameError.textContent = 'Username should start with a letter and can contain letters and numbers only';
            event.preventDefault(); 
        } else {
            usernameError.textContent = ''; 
        }
         });
        });
        </script>

        <div>
            <label class='large' for="contactno">Contact No. </label>
            <p><input type="tel" id="contactno" name="contactno"  maxlength='10' minlength='10' required></p>
        </div>

        <div class='f_w'>
        <label class='large' for="password">Password </label>
        <p><input type="password" id="password" name="password" required></p>
        </div>
        
        <div class='f_w'>
          <p>
            <input class="submit" name='submit' type="submit" value="Submit">
            <input class="reset" type="reset" value="Reset">
          </p>
        </div>
       
        
    </form>
    <br>
    <br>


           <p>Already Signed up, than just sign in.</p> 
            <p><a class='in_bt' href="login.php">Sign In</a></p>
           <br>
           

</body>
</html>

