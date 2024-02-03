<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="asset/scheme.ico">
  <title>Government Schemes</title>
</head>
<body>


<h1>Government Schemes</h1>


<nav>
  <ul>
    <li><a href="home1.html">Home</a></li>
    <li><a href="Student.php">Student Profile</a></li>
    <li><a href="about_us.php">About Us</a></li>
    <li><a href="home.php">Log Out</a></li>
    
  </ul>
</nav>


<div>
  <h2>Latest Government Schemes</h2>

  <?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "project";

  $conn = new mysqli($servername, $username, $password, $dbname);

  
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

 
  $sql = "SELECT * FROM governmentscheme";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      
      echo "<table border='1'>
              <tr>
                
                <th>Scheme Name</th>
                <th>Description</th>
                <th>E_Criteria</th>
                <th>State</th>
              </tr>";

      while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  
                  <td>" . $row["Schemename"] . "</td>
                  <td>" . $row["Description"] . "</td>
                  <td>" . $row["E_Criteria"] . "</td>
                  <td>" . $row["State"] . "</td>
                </tr>";
      }

      echo "</table>";
  } else {
      echo "No schemes available.";
  }

  
  
  ?>
</div>

</body>
</html>
