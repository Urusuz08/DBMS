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
        <a class='home_bt' href="home1.html">Home</a>
        <a class='about_bt'href="about.html">About Us</a>
        <a class='in_bt' href="Scheme1.php">Schemes</a>
      </nav>
    </div>

      <h1>Government Schemes</h1>
      <br>
      <h2>Process To Apply for Government Schemes</h2>
      
    <div class='table'>
      
      
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

      $userid = $_SESSION['user_id'];

      $sql1 = "SELECT g.SchemeID, g.Schemename, g.Description, g.State 
      FROM governmentscheme g, form f, student s 
      WHERE StudentID='$userid' 
      AND (f.Caste LIKE CONCAT('%', s.Caste, '%') OR f.Caste IS NULL) 
      AND (f.Domicile = s.Domicile OR f.Domicile IS NULL) 
      AND (f.STD >= s.STD OR f.STD IS NULL) 
      AND (f.Prev_Performance <= s.Prev_Performance) 
      AND g.SchemeID = f.SchemeId 
      AND (f.family_income >= s.Family_Income) 
      AND (f.gender LIKE CONCAT('%', s.Gender, '%')) 
      AND (f.siblings LIKE CONCAT('%', s.Siblings, '%')) 
      AND (f.education_level LIKE CONCAT('%', s.Education, '%') OR f.education_level IS NULL) 
      UNION 
      SELECT g.SchemeID, g.Schemename, g.Description, g.State 
      FROM governmentscheme g, form f, student s 
      WHERE StudentID='$userid' 
      AND (f.Caste IS NULL) 
      AND (f.Domicile = s.Domicile OR f.Domicile IS NULL) 
      AND (f.STD >= s.STD OR f.STD IS NULL) 
      AND (f.Prev_Performance <= s.Prev_Performance) 
      AND g.SchemeID = f.SchemeId 
      AND (f.family_income >= s.Family_Income) 
      AND (f.gender LIKE CONCAT('%', s.Gender, '%')) 
      AND (f.siblings LIKE CONCAT('%', s.Siblings, '%')) 
      AND (f.education_level LIKE CONCAT('%', s.Education, '%') OR f.education_level IS NULL) 
      UNION 
      SELECT g.SchemeID, g.schemename, g.Description, g.State 
      FROM governmentscheme g, form f, student s 
      WHERE StudentID='$userid' 
      AND (f.Caste LIKE CONCAT('%', s.Caste, '%') OR f.Caste IS NULL) 
      AND (f.Domicile IS NULL) 
      AND (f.STD >= s.STD OR f.STD IS NULL) 
      AND (f.Prev_Performance <= s.Prev_Performance) 
      AND g.SchemeID = f.SchemeId 
      AND (f.family_income >= s.Family_Income) 
      AND (f.gender LIKE CONCAT('%', s.Gender, '%')) 
      AND (f.siblings LIKE CONCAT('%', s.Siblings, '%')) 
      AND (f.education_level LIKE CONCAT('%', s.Education, '%') OR f.education_level IS NULL)";

      $result1= $conn->query($sql1);
      if ($result1->num_rows > 0) {

        echo "<table border=none>
                  <tr>
                    <th>Scheme ID</th>
                    <th>How To Apply</th>
                    <th>Links</th>
                  </tr>";

        while ($row1 = $result1->fetch_assoc()) {
            $scheme=$row1["SchemeID"];
            $sql = "SELECT * FROM process where SchemeId='$scheme' ";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>" . $row["SchemeId"] . "</td>
                      <td>" . $row["How_to_Apply"] . "</td>
                      <td>" . $row["links"] . "</td>
                    </tr>";
          }
        }
        }
          echo "</table>";
      } else {
          echo "No schemes available.";
      }

      
      
      ?>
    </div>

  </body>
</html>
