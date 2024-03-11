
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
    <link rel='icon' href="asset/sp.ico">
    <link rel='stylesheet' href='styles.css'>
    <title>Student Profile Form</title>
  </head>

  <body>
    <div class='links'>
      <nav>
        <a class='home_bt' href="home1.html">Home</a>
        <a class='s_bt' href="Scheme1.php">Schemes</a>
        <a class='about_bt' href="about.html">About Us</a>
        <a class='out_bt' href="index.php">Log Out</a>
      </nav>
    </div>
    <?php

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        // Function to check if the user is logged in
        function isUserLoggedIn() {
          return isset($_SESSION['user_id']);
        }

        function isUserAllowed($userId) {
        return isUserLoggedIn() && $_SESSION['user_id'] == $userId;
        }
        if(isset($_POST['edit'])){
          header("Location: Student2.php"); 
          exit();
        }

        if(isset($_POST['delete'])){
          header('location: DAccount.php');
        }

       
    
    ?>
    <h1>Student Profile</h1>

      
        
    <?php

        if (isUserLoggedIn()) {
          // Display user details or allow access to their own details
          $userId = $_SESSION['user_id'];
          if (isUserAllowed($userId)) {
              ?><h4 class='wc'>You are viewing the Profile of User-ID:  <?php echo "" . $userId . "";?>.</h4><?php
              // Display or process user details here
          } else {
              // Redirect to an unauthorized access page or display an error message
              ?><h4 class='nwc'>Unauthorized access</h4><?php
              // Redirect or display error message
              exit();
          }
        } else {
          // Redirect to the login page if the user is not logged in
          header('Location: login.php');
          exit();
        }

        if($conn){
        $we="SELECT * FROM Student WHERE StudentID = '$userId'";
        $wq=$conn->query($we);
        if ($wq->num_rows > 0) {
          while($row=$wq->fetch_assoc()){
    ?>  
          
    <form action="Student1.php" method="post">
          <div>
          <label for="studentid" class='large'>Student ID </label>
          <input type="number" id="studentid" name="studentid" value="<?php echo "" . $row["StudentID"] . ""; ?>"  readonly>
          </div>
          
        
        
        <div>
        <label for="name" class='large'>Name </label>
        <input class='name' type="text" id="name" name="name" value="<?php echo "" . $row["Name"] . ""; ?>" readonly>
        </div>
        
        <div>  
        <label for="dob" class='large'>D_O_B  </label>
        <input class='dob' type="date" id="dob" name="dob" value="<?php echo "" . $row["DOB"] . ""; ?>" readonly>
        </div>

        <div>  
        <label for="age" class='large'>AGE  </label>
        <input class='dob' type="text" id="age" name="age" value="<?php echo "" . $row["Age"] . ""; ?>" readonly>
        </div>
        
        <div>
        <label for="gender" class='large'>Gender </label>
        <input class='gender' type="text" id="gender" name="gender" value="<?php echo "" . $row["Gender"] . ""; ?>" readonly>
        
        </div>
        
        <div>
        <label for="emailid" class='large'>Email_ID </label>
        <input class='e_id' type="text" id="emailid" name="emailid" value="<?php echo "" . $row["Email_ID"] . ""; ?>" readonly >
        </div>

        <div>
        <label for="contactNo" class='large'>Contact No. </label>
        <input type="tel" id="contactNo" name="contactNo" value="<?php echo "" . $row["ContactNo"] . ""; ?>" readonly>
        </div>

        <div>
        <label for="caste" class='large'>Caste-Category </label>
        <input class='e_id' type="text" id="caste" name="caste" value="<?php echo "" . $row["Caste"] . ""; ?>" readonly >
        </div>

        <div>
        <label for="std" class='large'>Standard </label>
        <input class='e_id' type="text" id="std" name="std" value="<?php echo "" . $row["STD"] . ""; ?>" readonly >
        </div>

        <div>
        <label for="domicile" class='large'>Domicile </label>
        <input class='e_id' type="text" id="domicile" name="domicile" value="<?php echo "" . $row["Domicile"] . ""; ?>" readonly >
        </div>

        <div>
        <label for="education" class='large'>Education </label>
        <input class='e_id' type="text" id="education" name="education" value="<?php echo "" . $row["Education"] . ""; ?>" readonly >
        </div>

        <div>
        <label for="performance" class='large'>Academic Performance </label>
        <input class='e_id' type="text" id="performance" name="performance" value="<?php echo "" . $row["Prev_Performance"] . ""; ?>" readonly >
        </div>

        <div>
        <label for="siblings" class='large'>Siblings </label>
        <input class='e_id' type="text" id="siblings" name="siblings" value="<?php echo "" . $row["Siblings"] . ""; ?>" readonly >
        </div>
        
        <div>
        <label for="fincome" class='large'>Family Income </label>
        <input class='e_id' type="text" id="fincome" name="fincome" value="<?php echo "" . $row["Family_Income"] . ""; ?>" readonly >
        </div>

        <div class='f_w'>
        <label for="address" class='large'>Address </label>
        <textarea id="address" name="address"  readonly>
        <?php echo "" . $row["Address"] . ""; ?>
        </textarea>
        </div>

        <?php
          }
          }}else{
            echo "Not connected ";
          }
        ?>

        <div class='f_w1'>
        <input class='submit' name='edit' type="submit" value="Edit">
        </div> 

        <div class='f_w1'>
        <input class='submit' name='delete' type="submit" value="Delete Account">
        </div>
    </form>
     

  </body>

</html>



