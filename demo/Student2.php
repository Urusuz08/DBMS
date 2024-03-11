
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


        if(isset($_POST['SC'])){
            
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

              
    
            $userId=$_SESSION['user_id'];

            $sql4="SELECT ContactNO from registration";

            $result4=$conn->query($sql4);
            $t=0;
            if($result4->num_rows >0)
            
            while($equ=$result4->fetch_assoc()){
            $tempcon = $equ['ContactNO'];
              
              if($contactNo==$tempcon){
                $t++;
              }
            }
            if($t==0){
                $sql = "UPDATE student SET Name='$name' , DOB ='$dob', Gender='$gender', Address='$address',
                Email_ID='$emailid', Caste='$caste', Domicile='$domicile', Education='$education', Prev_Performance='$performance',ContactNo='$contactNo',
                Siblings='$siblings',Family_Income='$income',STD='$std' WHERE StudentID='$userId'";

                $sql1="UPDATE registration SET ContactNO='$contactNo' where User_ID='$userId'";
                if ($conn->query($sql) === TRUE) {
                  header('location: student1.php');
                  exit();
                } else {
                  echo "Error: " . $sql . "<br>" . $conn->error;
                }
              }

            

            $sql = "UPDATE student SET Name='$name' , DOB ='$dob', Gender='$gender', Address='$address',
                     Email_ID='$emailid', Caste='$caste', Domicile='$domicile', Education='$education', Prev_Performance='$performance',
                     Siblings='$siblings',Family_Income='$income',STD='$std' WHERE StudentID='$userId'";


            if ($conn->query($sql) === TRUE) {
              header('location: student1.php');
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
              ?><h4 class='wc'>You are editing the Profile of User-ID:  <?php echo "" . $userId . "";?>.</h4><?php
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
          
    <form id='ftu' action="Student2.php" method="post">
          <p><span id="usernameError" class="error"></span><p>
          <div>
          <label for="studentid" class='large'>Student ID </label>
          <input type="number" id="studentid" name="studentid" value="<?php echo "" . $row["StudentID"] . ""; ?>"  readonly>
          </div>
          
        
        
        <div>
        <label for="name" class='large'>Name </label>
        <input class='name' type="text" id="name" name="name" value="<?php echo "" . $row["Name"] . ""; ?>" >
        </div>
        
        <div>  
        <label for="dob" class='large'>D_O_B  </label>
        <input class='dob' type="date" id="dob" name="dob" value="<?php echo "" . $row["DOB"] . ""; ?>" >
        </div>
        

        <div>
        <label for="gender" class='large'>Gender </label>
        <select class='gender' id="gender" name="gender" >
          <option value="M"<?php if($row["Gender"]=='M'){?> selected<?php }?>>Male</option>
          <option value="F"<?php if($row["Gender"]=='F'){?> selected<?php }?>>Female</option>
          <option value="Other"<?php if($row["Gender"]=='Other'){?> selected<?php }?>>Other</option>
        </select>
        </div>

        <div>
        <label for="emailid" class='large'>Email_ID </label>
        <input class='e_id' type="text" id="emailid" name="emailid" value="<?php echo "" . $row["Email_ID"] . ""; ?>"  >
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
        <input type="tel" id="contactNo" name="contactNo" value="<?php echo "" . $row["ContactNo"] . ""; ?>"  maxlength='10' minlength='10'>
        </div>

        <div>
        <label for="caste" class='large'>Caste-Category </label>
        <select class='gender' id="caste" name="caste" >
          <option value="gen"<?php if($row["Caste"]=='gen'){?> selected<?php }?>>General</option>
          <option value="obc"<?php if($row["Caste"]=='obc'){?> selected<?php }?>>OBC</option>
          <option value="sc"<?php if($row["Caste"]=='sc'){?> selected<?php }?>>Scheduled Caste</option>
          <option value="st"<?php if($row["Caste"]=='st'){?> selected<?php }?>>Scheduled Tribe</option>
        </select>
        </div>

        <div>
        <label for="std" class='large'>Standard </label>
        <select class='gender' id="std" name="std" >
          <option value="LKG-UKG"<?php if($row["STD"]=='LKG-UKG'){?> selected<?php }?>>LKG-UKG</option>
          <option value="1-8"<?php if($row["STD"]=='1-8'){?> selected<?php }?>>STD 1 - STD 8</option>
          <option value="9"<?php if($row["STD"]=='9'){?> selected<?php }?>>STD 9</option>
          <option value="10"<?php if($row["STD"]=='10'){?> selected<?php }?>>STD 10</option>
          <option value="Completed Schooling"<?php if($row["STD"]=='Completed Schooling'){?> selected<?php }?>>Completed Schooling</option>
        </select>
        </div>

        <div>
        <label for="domicile" class='large'>Domicile </label>
        <input class='e_id' type="text" id="domicile" name="domicile" value="<?php echo "" . $row["Domicile"] . ""; ?>" >
        </div>

        <div>
        <label for="education" class='large'>Education </label>
        <select class='gender' id="education" name="education" >
          <option value="Pre-Primary"<?php if($row["Education"]=='Pre-Primary'){?> selected<?php }?>>Pre-Primary</option>
          <option value="Primary"<?php if($row["Education"]=='Primary'){?> selected<?php }?>>Primary</option>
          <option value="Secondary"<?php if($row["Education"]=='Secondary'){?> selected<?php }?>>Secondary</option>
          <option value="PUC"<?php if($row["Education"]=='PUC'){?> selected<?php }?>>Higher Secondary/PUC</option>
          <option value="UG"<?php if($row["Education"]=='UG'){?> selected<?php }?>>Under Graduate</option>
          <option value='PG'<?php if($row["Education"]=='PG'){?> selected<?php }?>>Post Graduate</option>
        </select>
        </div>

        <div>
        <label for="performance" class='large'>Academic Performance </label>
        <input class='e_id' type="text" id="performance" name="performance" value="<?php echo "" . $row["Prev_Performance"] . ""; ?>">
        </div>
         
        <div>
        <label for="siblings" class='large'>Siblings </label>
        <select class='gender' id="siblings" name="siblings" >
          <option value="no"<?php if($row["Siblings"]=='no'){?> selected<?php }?>>No</option>
          <option value="yes"<?php if($row["Siblings"]=='yes'){?> selected<?php }?>>Yes</option>
        </select>
        </div>
        
        <div>
        <label for="fincome" class='large'>Family Income </label>
        <select class='gender' id="fincome" name="fincome" >
          <option value="190000"<?php if($row["Family_Income"]=='190000'){?> selected<?php }?>>Upto RS. 200000 </option>
          <option value="290000"<?php if($row["Family_Income"]=='290000'){?> selected<?php }?>>Rs. 200000-300000</option>
          <option value="790000"<?php if($row["Family_Income"]=='790000'){?> selected<?php }?>>Rs. 300000-800000</option>
          <option value="1200000"<?php if($row["Family_Income"]=='1200000'){?> selected<?php }?>>More Than Rs.800000</option>
        </select>
        </div>

        <div class='f_w'>
        <label for="address" class='large'>Address </label>
        <textarea id="address" name="address"  >
        <?php echo "" . $row["Address"] . ""; ?>
        </textarea>
        </div>

        

        <div class='f_w1'>
        <input class='submit' name='SC' type="submit" value="Save Changes">
        </div>  
    </form>
    <?php
          }
          }}else{
            echo "Not connected ";
          }
        ?>
     

  </body>

</html>



