
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
// Function to check if the user is logged in
function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isUserAllowed($userId) {
  return isUserLoggedIn() && $_SESSION['user_id'] == $userId;
}


if($_SERVER['REQUEST_METHOD']=='POST'){
$name = $_POST['name'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$address= $_POST['address'];
$contactNo = $_POST['contactNo'];
$emailid = $_POST['emailid'];



$sql = "INSERT INTO student VALUES ('$name', '$dob', '$gender', '$address',  '$contactNo', '$emailid', '$userId')";

if ($conn->query($sql) === TRUE) {
    echo "Record added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='icon' href="asset/sp.ico">
  <title>Student Profile Form</title>
</head>

  <body>
      <?php
      if (isUserLoggedIn()) {
        // Display user details or allow access to their own details
        $userId = $_SESSION['user_id'];
        if (isUserAllowed($userId)) {
            echo "Welcome, User $userId!";
            // Display or process user details here
        } else {
            // Redirect to an unauthorized access page or display an error message
            echo "Unauthorized access";
            // Redirect or display error message
            exit();
        }
      } else {
        // Redirect to the login page if the user is not logged in
        header('Location: login.php');
        exit();
      }
      ?>
      <h1>Student Profile</h1>

      <nav>
        <ul>
          <li><a href="home1.html">Home</a></li>
          <li><a href="Scheme1.php">Schemes</a></li>
          <li><a href="about_us.php">About Us</a></li>
          <li><a href="home.php">Log Out</a></li>
        </ul>
      </nav>


      <form action="Student.php" method="post">
        
        <?php
      
        if($conn){
        $we="SELECT User_ID FROM registration WHERE user_id = '$userId'";
        $wq=$conn->query($we);
        if ($wq->num_rows > 0) {
          while($row=$wq->fetch_assoc()){
          echo '<label for="studentid">Student ID: </label>';
        echo '<input type="number" id="studentid" name="studentid" value='. $row["User_ID"] .'  readonly>';
        echo '<br>';
        }
        }}else{
          echo "Not connected ";
        }
        ?>
        <br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" >
        <br>
        <br>


        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" >
        <br>
        <br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" >
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select>
        <br>
        <br>

        <label for="emailid">Email_ID: </label>
        <input type="text" id="emailid" name="emailid" >
        <br>
        <br>

        <label for="address">Address: </label>
        <textarea id="address" name="address" rows="4" cols="50"  >
          
        </textarea>

        <br>
        <br>

        <label for="contactNo">Contact No.:</label>
        <input type="tel" id="contactNo" name="contactNo" >
        <br>
        <br>

        <input type="submit" value="Submit">
          <br>
          <br>
        <input type="reset" value="Reset">
      </form>

  </body>

</html>



