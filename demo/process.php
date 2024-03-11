<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="asset/scheme.ico">
    <link rel='stylesheet' href='stylesc.css'>
    <title>Government Schemes</title>
  </head>

  <body>
    <div class='links'>
      <nav>
        <a class='home_bt' href="index.php">Home</a>
        <a class='about_bt'href="about1.html">About Us</a>
        <a class='in_bt' href="Scheme.php">Schemes</a>
      </nav>
    </div>

      <h1>Government Schemes</h1>
      <br>
      <h2>Process To Apply for Government Schemes</h2>
      
    <div class='table'>
      
      
      <?php

      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "project";

      $conn = new mysqli($servername, $username, $password, $dbname);

      
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

    
      $sql = "SELECT * FROM process";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          
          echo "<table border=none>
                  <tr>
                    <th>Scheme ID</th>
                    <th>How To Apply</th>
                    <th>Links</th>
                  </tr>";

          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>" . $row["SchemeId"] . "</td>
                      <td>" . $row["How_to_Apply"] . "</td>
                      <td>" . $row["links"] . "</td>
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
