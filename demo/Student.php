
<?php 

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);
$s_id=$_SESSION['user_id'];

$ur="SELECT * FROM Student where StudentID = '$s_id'";
$re = $conn->query($ur);
        
        if ($re->num_rows > 0) {
            $row = $re->fetch_assoc();
            
            
            if ($s_id == $row['StudentID'] ) {
                
                $_SESSION['user_id'] = $s_id;
                header("Location: Student1.php"); 
                exit();
            }
          }

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
    <style>
      .error::after {
          content: attr(data-error);
      }
    </style>
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


        if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $address= $_POST['address'];
        $contactNo = $_POST['contactNo'];
        $emailid = $_POST['emailid'];
        $caste = $_POST['caste'];
        $domicile = $_POST['domicile'];
        $education = $_POST['education'];
        $performance = $_POST['performance'];
        $siblings = $_POST['siblings'];
        $income = $_POST['fincome'];
        $std = $_POST['std'];

        $userID=$_SESSION['user_id'];
        $sql = "INSERT INTO student VALUES ('$name', '$dob', '$gender', '$address',  '$contactNo', '$emailid', '$userID','$caste','$domicile',
                                            '$education','$performance','$siblings','$income','$std','')";

        if ($conn->query($sql) === TRUE) {
          header("Location: student1.php");
          exit();
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }

        }

    
    ?>
    <h1>Student Profile</h1>

      
        
    <?php

        if (isUserLoggedIn()) {
          // Display user details or allow access to their own details
          $userId = $_SESSION['user_id'];
          if (isUserAllowed($userId)) {
              ?><h4 class='wc'>Welcome, User <?php echo "" . $userId . "";?>!</h4><?php
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
        $we="SELECT User_ID,ContactNO FROM registration WHERE user_id = '$userId'";
        $wq=$conn->query($we);
        if ($wq->num_rows > 0) {
          while($row=$wq->fetch_assoc()){
    ?>  
          
    <form id='ftu' action="Student.php" method="post">
          <p><span id="usernameError" class="error"></span><p>
          <div>
          <label for="studentid" class='large'>Student ID  </label>
          <input type="number" id="studentid" name="studentid" value="<?php echo "" . $row["User_ID"] . ""; ?>"  readonly>
          </div>
          
        
        
        <div>
        <label for="name" class='large'>Name </label>
        <input class='name' type="text" id="name" name="name" placeholder='First or Full Name' required>
        </div>
        
        <div>  
        <label for="dob" class='large'>D_O_B  </label>
        <input class='dob' type="date" id="dob" name="dob" required>
        </div>
        
        <div>
        <label for="gender" class='large'>Gender </label>
        <select class='gender' id="gender" name="gender" >
          <option value="M">Male</option>
          <option value="F">Female</option>
          <option value="Other">Other</option>
        </select>
        </div>
        
        <div>
        <label for="emailid" class='large'>Email_ID </label>
        <input class='e_id' type="text" id="emailid" name="emailid" data-error='' placeholder='abc@abc.com' required >
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('ftu').addEventListener('submit', function(event) {
        var email = document.getElementById('emailid').value;
        var usernameError = document.getElementById('usernameError');

        if (!/^[a-zA-Z0-9]+@[a-zA-Z]+\.[a-zA-Z]{2,4}$/.test(email)) {
            usernameError.textContent = 'Email ID should be of format abc0-9@abc.com';
            event.preventDefault(); 
        } else {
            usernameError.textContent = ''; 
        }
         });
        });
        </script>

        <div>
        <label for="contactNo" class='large'>Contact No. </label>
        <input type="tel" id="contactNo" name="contactNo" value="<?php echo "" . $row["ContactNO"] . ""; ?>"  readonly>
        </div>
        
        <?php
          }
          }}else{
            echo "Not connected ";
          }
        ?>

        <div>
        <label for="caste" class='large'>Caste-Category </label>
        <select class='gender' id="caste" name="caste" >
          <option value="gen">General</option>
          <option value="obc">OBC</option>
          <option value="sc">Scheduled Caste</option>
          <option value="st">Scheduled Tribe</option>
        </select>
        </div>

        <div>
        <label for="std" class='large'>Standard </label>
        <select class='gender' id="std" name="std" >
          <option value="LKG-UKG">LKG-UKG</option>
          <option value="1-8">STD 1 - STD 8</option>
          <option value="9">STD 9</option>
          <option value="10">STD 10</option>
          <option value="Completed Schooling">Completed Schooling</option>
        </select>
        </div>

        <div>
        <label for="domicile" class='large'>Domicile </label>
        <input class='e_id' type="text" id="domicile" name="domicile" placeholder='Write State Name' required >
        </div>

        <div>
        <label for="education" class='large'>Education </label>
        <select class='gender' id="education" name="education" >
          <option value="Pre-Primary">Pre-Primary</option>
          <option value="Primary">Primary</option>
          <option value="Secondary">Secondary</option>
          <option value="PUC">Higher Secondary/PUC</option>
          <option value="UG">Under Graduate</option>
          <option value='PG'>Post Graduate</option>
        </select>
        </div>

        <div>
        <label for="performance" class='large'>Academic Performance </label>
        <input class='e_id' type="text" id="performance" name="performance" placeholder='Last Academic Marks in %' required >
        </div>

        <div>
        <label for="siblings" class='large'>Siblings </label>
        <select class='gender' id="siblings" name="siblings" >
          <option value="no">No</option>
          <option value="yes">Yes</option>
        </select>
        </div>

        <div>
        <label for="fincome" class='large'>Family Income </label>
        <select class='gender' id="fincome" name="fincome" >
          <option value="190000">Upto RS. 200000 </option>
          <option value="290000">Rs. 200000-300000</option>
          <option value="790000">Rs. 300000-800000</option>
          <option value="1200000">More Than Rs.800000</option>
        </select>
        </div>



        <div class='f_w'>
        <label for="address" class='large'>Address  </label>
        <textarea id="address" name="address"  placeholder="Write your Address here...." required>  
        </textarea>
        </div>

        <div class='f_w1'>
        <input class='submit' name ='submit' type="submit" value="Submit">
        <input class='reset' type="reset" value="Reset">
        </div>  
    </form>
     

  </body>

</html>



