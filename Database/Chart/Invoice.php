<?php
  // declare database variables
  // change to the information relevant
  // to your database
  header('Content-Type: application/json');
  include '../connection.php';
 
  $sql = "SELECT MONTHNAME(Invoice_Date) AS Invoice_Date, SUM(Total_Sales) AS Total_Sales
  FROM     invoice
  GROUP BY MONTHNAME(Invoice_Date)";

  $result = $dbc->query($sql);
  
  if ($result->num_rows > 0) {
  
      $data[0][0] = 'Invoice_Date';
      $data[0][1] = 'Total_Sales';
      $x = 1;
      // output data of each row
      while($row = $result->fetch_assoc()) {
          $data[$x][0] = $row["Invoice_Date"];
          $data[$x][1] = (float)$row["Total_Sales"];
          $x++;
      }
  } else {
      die("No records");
  }
  
  echo(json_encode($data));